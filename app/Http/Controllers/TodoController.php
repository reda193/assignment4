<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the todo management page.
     */
    public function index(Request $request)
    {
        // Load TODO items from database into session if not already
        if (!$request->session()->has('todo_items')) {
            $this->loadTodoItemsToSession($request);
        }

        $todoItems = $request->session()->get('todo_items', []);
        
        return view('todo.manage', compact('todoItems'));
    }

    /**
     * Add a new todo item.
     */
    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $todoItems = $request->session()->get('todo_items', []);
        
        // Generate a temporary ID for the session item
        $tmpId = time() . rand(1000, 9999);
        
        $todoItems[] = [
            'tmp_id' => $tmpId,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
        ];
        
        $request->session()->put('todo_items', $todoItems);
        
        return redirect('manage')->with('status', 'New TODO item added.');
    }

    /**
     * Clear all todo items from session.
     */
    public function clearList(Request $request)
    {
        $request->session()->put('todo_items', []);
        
        return redirect('manage')->with('status', 'TODO list cleared.');
    }

    /**
     * Save todo items from session to database.
     */
    public function saveList(Request $request)
    {
        $todoItems = $request->session()->get('todo_items', []);
        $userId = Auth::id();
        
        // Delete all existing TODO items for the user
        TodoItem::where('user_id', $userId)->delete();
        
        // Insert new TODO items from session state
        foreach ($todoItems as $item) {
            TodoItem::create([
                'user_id' => $userId,
                'name' => $item['name'],
                'description' => $item['description'],
                'due_date' => $item['due_date'],
            ]);
        }
        
        return redirect('manage')->with('status', 'TODO list items saved to database.');
    }

    /**
     * Restore todo items from database to session.
     */
    public function restoreList(Request $request)
    {
        $this->loadTodoItemsToSession($request);
        
        return redirect('manage')->with('status', 'TODO list items restored from database.');
    }

    /**
     * Load todo items from database to session.
     */
    private function loadTodoItemsToSession(Request $request)
    {
        $userId = Auth::id();
        $todoItems = TodoItem::where('user_id', $userId)->get()->map(function ($item) {
            return [
                'tmp_id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'due_date' => $item->due_date,
            ];
        })->toArray();
        
        $request->session()->put('todo_items', $todoItems);
    }
}
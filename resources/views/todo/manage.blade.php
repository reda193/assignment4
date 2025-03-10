@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">Add New TODO Item</div>
            <div class="card-body">
                <form method="POST" action="{{ route('todo.add') }}" class="row g-3">
                    @csrf
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="datetime-local" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">New Item</button>
                        
                        <button type="button" class="btn btn-danger" onclick="document.getElementById('clear-form').submit();">Clear List</button>
                        
                        <button type="button" class="btn btn-success" onclick="document.getElementById('save-form').submit();">Save</button>
                        
                        <button type="button" class="btn btn-warning" onclick="document.getElementById('restore-form').submit();">Restore</button>
                    </div>
                </form>
                
                <!-- Hidden forms for the other actions -->
                <form id="clear-form" action="{{ route('todo.clear') }}" method="POST" class="d-none">
                    @csrf
                </form>
                
                <form id="save-form" action="{{ route('todo.save') }}" method="POST" class="d-none">
                    @csrf
                </form>
                
                <form id="restore-form" action="{{ route('todo.restore') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">Your TODO List</div>
            <div class="card-body">
                @if(count($todoItems) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todoItems as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['description'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['due_date'])->format('M d, Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center py-3">No TODO items yet. Add your first item above!</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
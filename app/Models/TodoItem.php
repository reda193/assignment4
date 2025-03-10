<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'name',
        'description',
        'priority',
        'due_date',
    ];


    protected $casts = [
        'due_date' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
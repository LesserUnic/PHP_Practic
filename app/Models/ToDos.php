<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDos extends Model
{
    use HasFactory;

    protected $fillable = ['note_id', 'description', 'is_complete'];

    protected $hidden = ["created_at", "updated_at"];
}

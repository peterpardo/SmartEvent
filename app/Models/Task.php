<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'name',
        'description',
        'list_id',
    ];

    public function list() {
        return $this->belongsTo(WorkspaceList::class, 'list_id', 'id');
    }

    public function posts() {
        return $this->hasMany(Post::class, 'task_id', 'id');
    }
}

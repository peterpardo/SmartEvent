<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkspaceList extends Model
{
    use HasFactory;

    protected $table =  'workspacelist';
    protected $fillable = [
        'name',
        'workspace_id',
    ];

    public function workspace() {
        return $this->belongsTo(Workspace::class, 'workspace_id', 'id');
    }

    public function tasks() {
        return $this->hasMany(Task::class, 'list_id', 'id');
    }
}

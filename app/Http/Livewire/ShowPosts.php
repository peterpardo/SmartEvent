<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class ShowPosts extends Component
{
    public $task;
    public $posts;
    public $comment;

    public $rules = [
        'name' => 'required'
    ];

    public function mount() {
        $this->posts = $this->task->posts()->get();
    }

    public function postComment() {
        dd('submitted');
    }
    public function yow() {
        dd('yow');
    }

    public function render()
    {
        return view('livewire.show-posts');
    }
}

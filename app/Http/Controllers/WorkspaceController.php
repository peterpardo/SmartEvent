<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Workspace;
use App\Models\WorkspaceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WorkspaceController extends Controller
{
    public function createWorkspace(Request $request) {
        $user = User::find(Auth::user()->id);

        // Create workspace for user
        $user->workspaces()->create([
            'name' => Str::title($request->name),
        ]);

        return back()->with('success', 'Workspace successfully created.');
    }

    public function openWorkspace($id) {
        $workspace = Workspace::find($id);

        $scripts = [
            asset('js/user/edit-workspace.js'),
            asset('js/user/delete-workspace.js'),
            asset('js/user/add-list.js'),
            asset('js/user/delete-list.js'),
            asset('js/user/add-task.js'),
        ];

        return view('users.workspace', [
            'workspace' => $workspace,
            'scripts' => $scripts,
        ]);
    }

    public function editWorkspace(Request $request, $id) {
        $workspace = Workspace::find($id);

        // Edit workspace name
        $workspace->name = Str::title($request->name);
        $workspace->save();

        return back()->with('success', 'Workspace successfully edited');
    }

    public function deleteWorkspace($id) {
        Workspace::destroy($id);

        return redirect()->route('home')->with('success', 'Workspace successfully deleted.');
    }

    public function createList(Request $request, $id) {
        $workspace = Workspace::find($id);

        $workspace->lists()->create([
            'name' => Str::title($request->listName),
        ]);

        return back()->with('success', 'List successfully created');
    }

    public function deleteList($id) {
        WorkspaceList::destroy($id);

        return back()->with('success', 'List successfully deleted.');
    }

    public function createTask(Request $request, $id) {
        $list = WorkspaceList::find($id);

        $list->tasks()->create([
            'name' => Str::title($request->taskName),
            'description' => Str::title($request->taskDescription),
        ]);

        return back()->with('success', 'Task successfully created.');
    }

    public function viewTask($id) {
        $task = Task::find($id);

        $scripts = [
            asset('js/user/edit-task.js'),
            asset('js/user/delete-task.js'),
            asset('js/user/add-post.js'),
            asset('js/user/move-task.js'),
        ];

        return view('users.view-task')->with([
            'task' => $task,
            'scripts' => $scripts,
        ]);
    }

    public function editTask(Request $request, $id) {
        $task = Task::find($id);

        $task->name = Str::title($request->taskName);
        $task->description = Str::ucfirst($request->taskDescription);
        $task->save();

        return back()->with('success', 'Task successfully updated.');
    }

    public function deleteTask($id) {
        $task = Task::find($id);
        $workspaceId = $task->list->workspace->id;

        Task::destroy($id);

        return redirect()->route('workspace', ['id' => $workspaceId ])->with('success', 'Task successfully deleted.');
    }

    public function createPost(Request $request, $id) {
        $task = Task::find($id);
        $task->posts()->create([
            'comment' => Str::ucfirst($request->comment),
            'user_id' => Auth::user()->id,
        ]);
        
        return back()->with('success', 'Post successfully created.');
    }

    public function moveTask(Request $request, $id) {
        $task = Task::find($id);
        $workspaceId = $task->list->workspace->id;

        // update list_id of task
        $task->list_id = $request->list;
        $task->save();

        return redirect()->route('workspace', ['id' => $workspaceId ])->with('success', 'Task successfully moved.');
    }
}

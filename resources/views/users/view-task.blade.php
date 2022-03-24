@extends('templates.main')

@section('content')
<div class="container">
  {{-- Back to workspace --}}

  <div class="border p-5 rounded my-2">
    {{-- Success alert --}}
    @if(session('success'))
    <div class="alert alert-success d-flex align-items-center alert-dismissible show" role="alert">
      <svg xmlns="http://www.w3.org/2000/svg" style="width:2rem;" class="me-2" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <div>
        {{ session('success') }}
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="mb-3">
      <a href="/your-workspace/{{ $task->list->workspace->id }}" class="text-decoration-none text-danger">
        <svg xmlns="http://www.w3.org/2000/svg" class="me-2" style="width:1rem;" viewBox="0 0 20 20"
          fill="currentColor">
          <path fill-rule="evenodd"
            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
            clip-rule="evenodd" />
        </svg>
        Back
      </a>
    </div>
    <p class="text-muted m-0">{{ $task->list->name }} list</p>
    <h2 class="fw-bold m-0">{{ $task->name }}</h2>
    <div class="d-flex justify-content-between">
      <div>
        <h2 class="fw-bold mt-5">Description</h2>
        <p class="fw-normal text-wrap">
          {{ $task->description }}
        </p>
        <div class="d-flex align-items-center mt-5 mb-3">
          <h2 class="fw-bold me-2">Members</h2>
          <button class="btn btn-primary">+ Add</button>
        </div>
        <div class="d-inline-block text-white bg-info rounded px-2 py-1 mb-1">Peter</div>
        <div class="d-inline-block text-white bg-danger rounded px-2 py-1 mb-1">Miguel</div>
        <div class="d-inline-block text-white bg-success rounded px-2 py-1 mb-1">Alena</div>
        <div class="d-inline-block text-white bg-warning rounded px-2 py-1 mb-1">Justine</div>
      </div>
      <div class="col-5 d-flex align-items-start justify-content-end">
        <div class="flex-column d-flex align-top justify-content-end w-50 w-sm-25">
          <button type="button" class="btn btn-success rounded-1 my-2" data-bs-toggle="modal"
            data-bs-target="#moveTaskModal">
            Move
          </button>
          <button type="button" class="btn btn-primary rounded-1 my-2" data-bs-toggle="modal"
            data-bs-target="#editTaskModal">
            Edit
          </button>
          <button type="button" class="btn btn-danger rounded-1 my-2" data-bs-toggle="modal"
            data-bs-target="#deleteTaskModal">
            Delete
          </button>
        </div>
      </div>
    </div>

    {{-- Create Post --}}
    <form method="POST" action="/create-post/{{ $task->id }}" id="addPostForm">
      @csrf
      <div class="d-flex flex-row mt-5 align-items-center">
        <img
          src="https://images.pexels.com/photos/9365643/pexels-photo-9365643.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
          alt="Avatar Logo" style="width: 50px; height: 50px" class="rounded-pill" />
        <h6 class="fw-bold mx-2">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h6>
      </div>
      <div class="form-floating mt-3">
        <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment"></textarea>
        <label class="text-muted" for="floatingTextarea">Write a comment</label>
        <span class="invalid-feedback" role="alert"></span>
      </div>
      <button type="submit" class="btn btn-success mt-2">Post comment</button>
    </form>

    {{-- Posts --}}
    @if($task->posts()->count() == 0)
    <div class="alert alert-secondary  text-center align-middle py-4 my-3">No Posts</div>
    @else
    @foreach($task->posts()->orderBy('updated_at', 'desc')->get() as $post)
    <div class="d-flex flex-row mt-5 align-items-center">
      <img
        src="https://images.pexels.com/photos/9365643/pexels-photo-9365643.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
        alt="Avatar Logo" style="width: 50px; height: 50px" class="rounded-pill" />
      <div class="d-flex flex-column justify-content-center">
        <h6 class="fw-bold mx-2">{{ $post->user->fname }} {{ $post->user->lname }}</h6>
        <h6 class="text-secondary mx-1">{{ $post->updated_at->diffForHumans() }}</h6>
      </div>
    </div>
    <div class="ms-5">
      <p class="fw-normal text-wrap">
        {{ $post->comment }}
      </p>
    </div>
    <div class="border"></div>
    @endforeach
    @endif
  </div>

  {{-- Edit task modal --}}
  <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="/edit-task/{{ $task->id }}" id="editTaskForm">
            @csrf
            <div class="mb-3">
              <label for="taskName" class="form-label">Task Name</label>
              <input type="text" class="form-control" id="taskName" name="taskName" value="{{ $task->name }}">
              <span class="invalid-feedback" role="alert"></span>
            </div>
            <div class="mb-3">
              <label for="taskDescription" class="form-label">Task Description</label>
              <textarea class="form-control" id="taskDescription" name="taskDescription"
                rows="3">{{ $task->description }}</textarea>
              <span class="invalid-feedback" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
          <button type="button" class="btn btn-primary" id="submitTaskFormBtn">Edit</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Delete task modal --}}
  <div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-labelledby="deleteTaskModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="/delete-task/{{ $task->id }}" id="deleteTaskForm">
            @csrf
            This will permanently delete the task. Are you sure you want to continue?
          </form>
        </div>
        <div class="modal-footer">
          <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
          <button class="btn btn-danger" id="confirmTaskDeleteBtn">Delete</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Move Task Modal --}}
  <div class="modal fade" id="moveTaskModal" tabindex="-1" aria-labelledby="moveTaskModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Move Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="/move-task/{{ $task->id }}" id="moveTaskForm">
            @csrf
            <div class="mb-3">
              <label for="taskDescription" class="form-label">Select a List</label>
              <select class="form-select" aria-label="Default select example" name="list" id="list">
                <option selected value="">Choose a list</option>
                @foreach($task->list->workspace->lists()->get() as $list)
                @if($list->id != $task->list->id)
                <option value="{{ $list->id }}">{{ $list->name }}</option>
                @endif
                @endforeach
              </select>
              <span class="invalid-feedback" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
          <button type="button" class="btn btn-success" id="moveTaskFormBtn">Move</button>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Scripts --}}
@foreach($scripts as $script)
<script src="{{ $script }}"></script>
@endforeach

@endsection
@extends('templates.main')

@section('content')
<div class="container py-3">
  <div class="row">
    {{-- Title --}}
    <div class="d-flex flex-wrap justify-content-sm-between justify-content-around my-3">
      <div class="d-flex flex-column flex-sm-row">
        <h1 class="fw-bold me-3">{{ $workspace->name }}</h1>
        <div class="my-auto d-flex flex-column flex-sm-row">
          <button type="button" class="btn btn-outline-secondary mx-2 my-2" data-bs-toggle="modal"
            data-bs-target="#createListModal">+ Create List</button>
          <button type="button" class="btn btn-outline-secondary mx-2 my-2" data-bs-toggle="modal"
            data-bs-target="#inviteModal">+ Invite People</button>
        </div>
      </div>
      <div class="d-flex flex-column flex-sm-row">
        <button class='btn btn-primary  mx-2 my-2' id="editBtn" data-bs-toggle="modal"
          data-bs-target="#editWorkspaceModal">Edit
          Name</button>
        <button class='btn btn-danger  mx-2 my-2' id="deleteBtn" data-bs-toggle="modal"
          data-bs-target="#deleteWorkspaceModal">Delete Workspace</button>
      </div>
    </div>

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

    @if($workspace->lists()->count() == 0)
    <div class="alert alert-secondary text-center align-middle py-4">List is empty</div>
    @else
    <div class="d-flex justify-content-start overflow-scroll" style="width:1400px; min-height:550px;">
      @foreach($workspace->lists()->get() as $list)
      <!-- Start lane -->
      <div class="col-12 col-lg-4 mx-2">
        <div class="card mb-3">
          <div class="position-relative d-flex align-items-center card-header bg-light">
            <h3 class="card-title h5 mb-1 me-2">
              {{ $list->name }}
            </h3>
            <div>
              <button class="btn btn-success btn-block" data-bs-toggle="modal" data-bs-target="#addTaskModal"
                data-bs-list-id="{{ $list->id }}">+ Add task</button>
            </div>
            <a href="#" class="position-absolute text-danger fs-4 text-decoration-none" style="right:8px; top:0"
              data-bs-list-id="{{ $list->id }}" data-bs-toggle="modal" data-bs-target="#deleteListModal">&times;</a>
          </div>
          <div class="card-body">
            <div class="tasks" id="backlog">
              {{-- Check if list is empty --}}
              @if($list->tasks()->get()->count() == 0)
              <div class="alert alert-secondary  text-center align-middle py-4">List is empty</div>
              @else
              @foreach($list->tasks()->get() as $task)
              <!-- Start task -->
              <a href="/view-task/{{ $task->id }}" class="card mb-3 cursor-grab text-decoration-none task-card">
                <div class="card-body">
                  <p class="mb-0 fs-5 text-black">{{ $task->name }}</p>
                  <span class="text-muted d-inline-block text-truncate" style="max-width: 350px;">
                    {{ $task->description }}
                  </span>
                </div>
              </a>
              <!-- End task -->
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
      <!-- End lane -->
      @endforeach
    </div>
    @endif



    {{-- Create list modal --}}
    <div class="modal fade" id="createListModal" tabindex="-1" aria-labelledby="createListModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/create-list/{{ $workspace->id }}" id="createListForm">
              @csrf
              <input type="text" class="form-control" name="listName" id="listName" placeholder="Ex: Todo">
              <span class="invalid-feedback" role="alert"></span>
            </form>
          </div>
          <div class="modal-footer">
            <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
            <button class="btn btn-success" id="submitListFormBtn">Create</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Invite people modal --}}
    <div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="inviteModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Invite People</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              @csrf
              <input type="email" class="form-control" name="email" id="email" placeholder="e.g. email@email.com">
              <span class="invalid-feedback" role="alert"></span>
            </form>
          </div>
          <div class="modal-footer">
            <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
            <button class="btn btn-success">Create</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Edit workspace modal --}}
    <div class="modal fade" id="editWorkspaceModal" tabindex="-1" aria-labelledby="editWorkspaceModal"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Workspace</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/edit-workspace/{{ $workspace->id }}" id="editWorkspaceForm">
              @csrf
              <input type="text" class="form-control" name="name" id="name" placeholder="Ex: Birthday Event"
                value="{{ $workspace->name }}">
              <span class="invalid-feedback" role="alert"></span>
            </form>
          </div>
          <div class="modal-footer">
            <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
            <button class="btn bg-brown" id="submitBtn">Submit</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Delete workspace modal --}}
    <div class="modal fade" id="deleteWorkspaceModal" tabindex="-1" aria-labelledby="deleteWorkspaceModal"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Workspace</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/delete-workspace/{{ $workspace->id }}" id="deleteWorkspaceForm">
              @csrf
              This will permanently delete the workspace. Are you sure you want to continue?
            </form>
          </div>
          <div class="modal-footer">
            <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
            <button class="btn btn-danger" id="confirmWorkspaceDelete">Delete</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Delete list modal --}}
    <div class="modal fade" id="deleteListModal" tabindex="-1" aria-labelledby="deleteListModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/delete-list" id="deleteListForm">
              @csrf
              This will permanently delete the list. Are you sure you want to continue?
            </form>
          </div>
          <div class="modal-footer">
            <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
            <button class="btn btn-danger" id="confirmListDeleteBtn">Delete</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Create task modal --}}
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/create-task" id="createTaskForm">
              @csrf
              <div class="mb-3">
                <label for="taskName" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="taskName" name="taskName">
                <span class="invalid-feedback" role="alert"></span>
              </div>
              <div class="mb-3">
                <label for="taskDescription" class="form-label">Task Description</label>
                <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3"></textarea>
                <span class="invalid-feedback" role="alert"></span>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
            <button class="btn btn-success" id="submitTaskFormBtn">Create</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

{{-- JS --}}
@foreach($scripts as $script)
<script src="{{ $script }}"></script>
@endforeach

@endsection
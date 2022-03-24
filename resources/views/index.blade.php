@extends('templates.main')

@section('content')
{{-- ADMIN HOMEPAGE --}}
@role('admin')
<div x-data="{ open: false }" class="container">
  <div class="mt-4 d-flex flex-row align-items-center">
    <h2 class="fw-bold mx-2">Your Users</h2>
    <a href="/add-user"
      class="btn-transparent d-inline-block text-decoration-none text-center align-middle px-2 py-2 border rounded text-black">
      + Add User
    </a>
  </div>
  <div class="mt-3 w-25">
    <input type="text" class="form-control" placeholder="Search User" />
  </div>

  {{-- Success alert --}}
  @if(session('success'))
  <div class="alert alert-success d-flex align-items-center alert-dismissible show mt-3" role="alert">
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

  <div class="m-3 d-flex justify-content-center">
    <div class="table-responsive p-3 w-100 row border border-light rounded shadow">
      <table class="table text-center">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td>
              <img
                src="https://images.pexels.com/photos/9365643/pexels-photo-9365643.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                alt="Avatar Logo" style="width: 40px; height: 40px" class="rounded-pill" />
            </td>
            <td class="align-middle">{{ $user->fname }} </td>
            <td class="align-middle">{{ $user->lname }}</td>
            <td class="align-middle">{{ $user->email }}</td>
            @foreach ($user->getRoleNames() as $role)
            <td class="align-middle">{{ $role }}</td>
            @endforeach
            <td>
              <button class="btn bg-brown dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                More
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="/view-user/{{ $user->id }}">View</a>
                </li>
                @if(!$user->hasRole('admin'))
                <li>
                  <a href="javascript();" class="dropdown-item deleteBtns" data-bs-toggle="modal"
                    data-bs-target="#deleteModal" data-user-id="{{ $user->id }}">
                    Delete
                  </a>
                </li>
                @endif
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item" href="#">Separated link</a>
                </li>
              </ul>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- DELETE USER MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
  <form method="POST" action="/delete-user" id="deleteForm">
    @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          This action will permanently delete the user. Are you sure you want to proceed?
        </div>
        <div class="modal-footer">
          <a href="javascript();" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </form>
</div>
@else
{{-- USER HOMEPAGE --}}
<div class="container">
  <div class="my-4 d-flex flex-row">
    <h2 class="fw-bold mx-2">Your Workspaces</h2>
    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">+
      Create Workspace</button>
  </div>

  {{-- Success alert --}}
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show align-middle mt-2" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" class="me-2" style="width:2rem;" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd"
        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
        clip-rule="evenodd" />
    </svg>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  {{-- Workspaces --}}
  @if($workspaces->count() != 0)
  <div class="d-flex flex-wrap justify-content-center justify-content-sm-start align-content-center mt-2">
    @foreach($workspaces as $workspace)
    <a href="/your-workspace/{{ $workspace->id }}"
      class="card text-white text-decoration-none text-center bg-brown mb-3 mx-3" style="max-width: 18rem;">
      <div class="card-header">
        {{ $workspace->name }}
      </div>
      <div class="card-body bg-white rounded text-black">
        <p class="card-text">You have a total of <span class="fw-bold">{{ $workspace->lists()->count() }}</span> list
          created here.</p>
      </div>
    </a>
    @endforeach
  </div>
  @else
  <div class="alert alert-secondary  text-center align-middle py-4 my-3">No Workspaces</div>
  @endif

  <!-- Create Workspace Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Workspace</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="/create-workspace" id="addWorkspaceForm">
            @csrf
            <input type="text" class="form-control" name="name" id="name" placeholder="Ex: Birthday Event">
            <span class="invalid-feedback" role="alert"></span>
          </form>
        </div>
        <div class="modal-footer">
          <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
          <button class="btn btn-success" id="submitBtn">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endrole

@foreach($scripts as $script)
<script src="{{ $script }}"></script>
@endforeach

@endsection
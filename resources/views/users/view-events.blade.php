@extends('templates.main')

@section('content')
<div class="container">
    <h2 class="fw-bold mt-5">Events</h2>
    <button type="button" class="btn btn-outline-secondary my-2" data-bs-toggle="modal" data-bs-target="#addEventModal" data-bs-action="add">
        + Schedule Events
    </button>

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

    @if($user->events()->count() == 0)
        <div class="bg-light text-center rounded py-4">No events scheduled</div>
    @else
        <div class="table-responsive mt-2">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">Event Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($user->events()->get() as $event)
                    <tr>
                        <th>{{ $event->name }}</th>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->date }}</td>
                        <td>
                            <button class="btn bg-brown dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                More
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addEventModal" data-bs-event-id="{{ $event->id }}" data-bs-action="update">Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteEventModal" data-bs-event-id="{{ $event->id }}">Delete</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Add event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/add-event" class="modal-body" id="addEventForm">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Event Name</label>
                    <input type="text" class="form-control" id="eventName" name="eventName">
                    <span class="invalid-feedback" role="alert"></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="eventDesc" name="eventDesc" rows="3"></textarea>
                    <span class="invalid-feedback" role="alert"></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Date</label>
                    <input type="date" class="form-control" id="eventDate" name="eventDate">
                    <span class="invalid-feedback" role="alert"></span>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addEventBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>

{{-- Delete event modal --}}
<div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST" action="/delete-event" id="deleteEventForm">
            @csrf
            This will permanently delete the event. Are you sure you want to continue?
        </form>
        </div>
        <div class="modal-footer">
            <a href="javascript();" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
            <button class="btn btn-danger" id="deleteEventBtn">Delete</button>
        </div>
    </div>
    </div>
</div>

{{-- Scripts --}}
@foreach($scripts as $script)
    <script src="{{ $script }}"></script>
@endforeach

@endsection
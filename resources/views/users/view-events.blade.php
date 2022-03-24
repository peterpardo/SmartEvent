@extends('templates.main')

@section('content')
<div class="container">
    <h2 class="fw-bold mt-5">Events</h2>
    <button type="button" class="btn btn-outline-secondary my-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Schedule Events
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Date</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1">
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Event Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Birthday Celebration</th>
                    <td>My birthday</td>
                    <td>03/21/22</td>
                    <td>
                        <button class="btn bg-brown dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            More
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end text-center">
                            <li><a class="dropdown-item" href="#">View</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Delete</a>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Deadline of planning</th>
                    <td>Including posters, videos & documents</td>
                    <td>03/25/22</td>
                    <td>
                        <button class="btn bg-brown dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            More
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end text-center">
                            <li><a class="dropdown-item" href="#">View</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Delete</a>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Sys Integ SA04</th>
                    <td>SA 04 Exam for Sys Integ</td>
                    <td>03/28/22</td>
                    <td>
                        <button class="btn bg-brown dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            More
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end text-center">
                            <li><a class="dropdown-item" href="#">View</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Delete</a>
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


</div>
@endsection
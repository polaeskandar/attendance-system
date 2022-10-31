@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createGrade">
                        Create Grade
                    </button>
                    
                    <div class="modal fade" id="createGrade" tabindex="-1" aria-labelledby="createGradeLabel" aria-hidden="true">
                        <form method="POST" action="/create-grade">
                            @csrf
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="createGradeLabel">Create a new grade.</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="grade-title" class="form-label">Grade Title</label>
                                            <input type="text" name="title" class="form-control" id="grade-title">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="sumit" class="btn btn-success">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createSession">
                        Create Session
                    </button>
                    
                    <div class="modal fade" id="createSession" tabindex="-1" aria-labelledby="createSessionLabel" aria-hidden="true">
                        <form method="POST" action="/create-session">
                            @csrf
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="createSessionLabel">Create a new session.</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="session-title" class="form-label">Session Title</label>
                                            <input type="text" name="title" class="form-control" id="session-title">
                                        </div>
                                        <label for="grade" class="form-label">Grade</label>
                                        <select class="form-select" id="grade" name="grade_id">
                                            <option selected value="0">Select a grade</option>
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="sumit" class="btn btn-success">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#collectAttendance">
                        Collect attentance
                    </button>
                    
                    <div class="modal fade" id="collectAttendance" tabindex="-1" aria-labelledby="collectAttendanceLabel" aria-hidden="true">
                        <form method="POST" action="/collect-attendance">
                            @csrf
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="collectAttendanceLabel">Collect Attendance.</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <label for="session-id" class="form-label">Session</label>
                                        <select class="form-select" id="session-id" name="session_id">
                                            <option selected value="0">Select a session</option>
                                            @foreach($sessions as $session)
                                                @if (count($session->attentances) == 0)
                                                    <option value="{{ $session->id }}">{{ $session->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        <ul class="list-group mt-3">
                                            @foreach ($users as $user)
                                            <li class="list-group-item">
                                              <input class="form-check-input me-1" name="users[]" type="checkbox" value="{{ $user->id }}" id="user-{{ $user->id }}">
                                              <label class="form-check-label" for="user-{{ $user->id }}">{{ $user->name }}</label>
                                            </li>
                                            @endforeach
                                          </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="sumit" class="btn btn-success">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="d-flex align-items-start mt-3">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                          <button class="nav-link active" id="v-pills-grades-tab" data-bs-toggle="pill" data-bs-target="#v-pills-grades" type="button" role="tab" aria-controls="v-pills-grades" aria-selected="true">Grades</button>
                          <button class="nav-link" id="v-pills-session-tab" data-bs-toggle="pill" data-bs-target="#v-pills-session" type="button" role="tab" aria-controls="v-pills-session" aria-selected="false">Sessions</button>
                          <button class="nav-link" id="v-pills-users-tab" data-bs-toggle="pill" data-bs-target="#v-pills-users" type="button" role="tab" aria-controls="v-pills-users" aria-selected="false">Users</button>
                        </div>
                        <div class="tab-content w-100" id="v-pills-tabContent">
                          <div class="tab-pane fade show active" id="v-pills-grades" role="tabpanel" aria-labelledby="v-pills-grades-tab" tabindex="0">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Grade title</th>
                                    <th scope="col">Sessions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grades as $grade)
                                        <tr>
                                            <th scope="row">{{ $grade->id }}</th>
                                            <td>{{ $grade->title }}</td>
                                            <td>
                                                @foreach($grade->sessions as $session)
                                                    {{ $session->title }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                          </div>
                          <div class="tab-pane fade" id="v-pills-session" role="tabpanel" aria-labelledby="v-pills-session-tab" tabindex="0">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Session title</th>
                                    <th scope="col">Attendances</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sessions as $session)
                                        <tr>
                                            <th scope="row">{{ $session->id }}</th>
                                            <td>{{ $session->title }}</td>
                                            <td>
                                                @foreach ($session->attentances as $attentance)
                                                    {{ $attentance->user->name }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                          
                          <div class="tab-pane fade" id="v-pills-users" role="tabpanel" aria-labelledby="v-pills-users-tab" tabindex="0">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

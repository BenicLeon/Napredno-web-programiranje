@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Dobrodošlica --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                @if (!Auth::guest())
                    @foreach($dataUsers as $user)
                        @if(Auth::user()->email == $user->email)
                            <div class="card-body">
                                <h5 class="card-title">@lang('messages.welcome1') {{ $user->name }} @lang('messages.welcome2')</h5>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- Glavni sadržaj prema ulozi --}}
    @if(!Auth::guest())
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    {{-- ADMIN --}}
                    @if(Auth::user()->role == 'Admin')
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">{{ Auth::user()->name }} @lang('messages.admin_message')</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-3 mb-3">
                                <form method="post" action="croatian">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="locale" value="hr">
                                    <button type="submit" class="btn btn-success">HR</button>
                                </form>
                                <form method="post" action="english">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="locale" value="en">
                                    <button type="submit" class="btn btn-success">EN</button>
                                </form>
                            </div>

                            <hr>

                            {{-- Promjena uloga --}}
                            @foreach($dataUsers as $user)
                                @if($user->role != 'Admin')
                                    <div class="row align-items-center mb-3">
                                        <div class="col-md-3">
                                            <strong>{{ $user->name }}</strong>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="badge bg-info text-dark">{{ $user->role }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <form method="post" action="editUser" class="d-flex gap-2">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <select required class="form-select w-auto" name="role">
                                                    <option value="Profesor">@lang('messages.profesor')</option>
                                                    <option value="Student">@lang('messages.student')</option>
                                                </select>
                                                <button type="submit" class="btn btn-outline-primary">@lang('messages.button')</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    {{-- PROFESOR --}}
                    @elseif(Auth::user()->role == 'Profesor')
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">{{ Auth::user()->name }} @lang('messages.prof_message')</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-3 mb-3">
                                <form method="post" action="croatian">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="locale" value="hr">
                                    <button type="submit" class="btn btn-success">HR</button>
                                </form>
                                <form method="post" action="english">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="locale" value="en">
                                    <button type="submit" class="btn btn-success">EN</button>
                                </form>
                                <a href="{{ url('/addWork') }}" class="btn btn-outline-dark">@lang('messages.add_task')</a>
                            </div>

                            <table class="table table-hover mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th>@lang('messages.name')</th>
                                        <th>@lang('messages.name_english')</th>
                                        <th>@lang('messages.description')</th>
                                        <th>@lang('messages.study_type')</th>
                                        <th>@lang('messages.student')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataTasks as $task)
                                        @if($task->profesor == Auth::user()->name)
                                            <tr>
                                                <td>{{ $task->name }}</td>
                                                <td>{{ $task->name_en }}</td>
                                                <td>{{ $task->task_goal }}</td>
                                                <td>{{ $task->study_type }}</td>
                                                <td>
                                                    @if($task->choosen_student == null)
                                                        <form method="get" action="accept">
                                                            <input type="hidden" name="taskId" value="{{ $task->id }}">
                                                            <button type="submit" class="btn btn-sm btn-info">@lang('messages.chooseStudent')</button>
                                                        </form>
                                                    @else
                                                        <strong>@lang('messages.student'):</strong>
                                                        <span>{{ $task->choosen_student }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    {{-- STUDENT --}}
                    @else
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">{{ Auth::user()->name }} @lang('messages.stud_message')</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-3 mb-3">
                                <form method="post" action="croatian">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="locale" value="hr">
                                    <button type="submit" class="btn btn-success">HR</button>
                                </form>
                                <form method="post" action="english">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="locale" value="en">
                                    <button type="submit" class="btn btn-success">EN</button>
                                </form>
                            </div>

                            <table class="table table-striped mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th>@lang('messages.name')</th>
                                        <th>@lang('messages.name_english')</th>
                                        <th>@lang('messages.description')</th>
                                        <th>@lang('messages.study_type')</th>
                                        <th>@lang('messages.profesor')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataTasks as $task)
                                        <tr>
                                            <td>{{ $task->name }}</td>
                                            <td>{{ $task->name_en }}</td>
                                            <td>{{ $task->task_goal }}</td>
                                            <td>{{ $task->study_type }}</td>
                                            <td>{{ $task->profesor }}</td>
                                            <td>
                                                <form method="post" action="registerWork">
                                                    @csrf
                                                    <input type="hidden" name="user" value="{{ Auth::user()->name }}">
                                                    <input type="hidden" name="taskId" value="{{ $task->id }}">
                                                    <button type="submit" class="btn btn-sm btn-primary">@lang('messages.apply')</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

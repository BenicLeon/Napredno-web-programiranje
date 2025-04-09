@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📋 @lang('messages.details')</h5>
                </div>

                <div class="card-body">
                    @foreach($tasksData as $task)
                        <form method="post" action="accept/confirm" class="mb-4">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">

                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>@lang('messages.name')</th>
                                        <th>@lang('messages.description')</th>
                                        <th>@lang('messages.study_type')</th>
                                        <th>@lang('messages.student')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->task_goal }}</td>
                                        <td>{{ $task->study_type }}</td>
                                        <td>
                                            <select name="student" class="form-select" required>
                                                <option disabled selected>-- Odaberi studenta --</option>
                                                @foreach($students as $student)
                                                    <option value="{{ $student }}">{{ $student }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">@lang('messages.confirm_student')</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

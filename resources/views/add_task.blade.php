@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">@lang('messages.add_task')</h5>
                </div>
                @if (!Auth::guest())
                    <div class="card-body">
                        <form method="post" action="addWork">
                            @csrf
                            <input type="hidden" name="profesor" value="{{ Auth::user()->name }}">

                            <div class="mb-3">
                                <label for="naziv_rada" class="form-label">@lang('messages.name')</label>
                                <input type="text" class="form-control" name="naziv_rada" required>
                            </div>

                            <div class="mb-3">
                                <label for="naziv_rada_eng" class="form-label">@lang('messages.name_english')</label>
                                <input type="text" class="form-control" name="naziv_rada_eng" required>
                            </div>

                            <div class="mb-3">
                                <label for="zadatak_rada" class="form-label">@lang('messages.description')</label>
                                <input type="text" class="form-control" name="zadatak_rada" required>
                            </div>

                            <div class="mb-3">
                                <label for="tip_stud" class="form-label">@lang('messages.study_type')</label>
                                <select required class="form-select" name="tip_stud">
                                    <option value="Diplomski">@lang('messages.graduate')</option>
                                    <option value="Preddiplomski">@lang('messages.undergraduate')</option>
                                    <option value="Strucni">@lang('messages.prof_stud_prog')</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100">@lang('messages.add_task')</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
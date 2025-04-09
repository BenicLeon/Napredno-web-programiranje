@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Odaberi svoju ulogu</h5>
                </div>

                @if (!Auth::guest())
                    <div class="card-body">
                        <form method="post" action="home">
                            @csrf

                            <div class="mb-3">
                                <label for="role" class="form-label">Uloga</label>
                                <select required class="form-select" name="role" id="role">
                                    <option value="Admin">Admin</option>
                                    <option value="Profesor">Profesor</option>
                                    <option value="Student">Student</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Nastavi</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

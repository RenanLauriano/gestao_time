@extends('layout.template')

@section('content')
    <div class="col-10">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb d-flex justify-content-between">
                    <span>
                        <h2>Edit Employee</h2>
                    </span>
                    <span>
                        <a class="btn btn-app" href="{{ route('employees.index') }}">Back</a>
                    </span>
                </div>
            </div>
            <div class="mt-3">
                <form action="{{ route('employees.update', $employee->employee_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ @method_field('PATCH') }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="event_date">Employee Name</label>
                                <input type="text" name="employee_name" class="form-control" placeholder="Employee Name" value="{{ $employee->employee_name }}">
                                @error('employee_name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-app ml-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

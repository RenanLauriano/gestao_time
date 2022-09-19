@extends('layout.template')

@section('content')
    <div class="col-10">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>Add Employee</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-app" href="{{ route('employees.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="employee_name">Employee name</label>
                            <input type="text" name="employee_name" id="employee_name" class="form-control" placeholder="Employee Name" required>
                            @error('employee_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
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
@endsection

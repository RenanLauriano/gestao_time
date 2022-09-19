@extends('layout.template')

@section('content')
    <div class="col-10">
        <div class="d-flex justify-content-end">
            <a class="btn btn-app" href="{{ route('employees.create') }}" role="button">New Employee</a>
        </div>
        @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-hover table-bordered mt-3">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <th scope="row">{{ $employee->employee_id }}</th>
                        <td>{{ $employee->employee_name }}</td>
                        <td class="actions">
                            <div class="d-flex justify-content-start">
                                <div class="mr-1">
                                    <form action="{{ route('employees.destroy', $employee->employee_id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                                <a href="{{ route('employees.edit', $employee->employee_id) }}"><button><i class="bi bi-pencil"></i></button></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
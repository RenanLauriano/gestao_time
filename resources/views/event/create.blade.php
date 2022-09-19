@extends('layout.template')

@section('content')
    <div class="col-10">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb d-flex justify-content-between">
                    <span>
                        <h2>Add Event</h2>
                    </span>
                    <span>
                        <a class="btn btn-app" href="{{ route('events.index') }}">Back</a>
                    </span>
                </div>
            </div>
            <div class="mt-3">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xs-9 col-sm-9 col-md-9">
                            <div class="form-group">
                                <label for="event_date">Event Description</label>
                                <input type="text" name="event_description" class="form-control" placeholder="Event Description">
                                @error('event_description')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="event_date">Event Date</label>
                                <input type="date" name="event_date" class="form-control" placeholder="Event date">
                                @error('event_date')
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

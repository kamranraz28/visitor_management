@extends('frontdesk.master')
@section('title','VMS')
@section('content')

<div class="col-md-12 col-lg-12 col-xl-12">
    <div class="text-center">
        <h3>Register New Interviewees/Workers</h3>
        <hr>
    </div>
    <div class="mx-auto" style="max-width: 500px;">
        @if(session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
        @endif

        @if(session('error_message'))
        <div class="alert alert-danger">
            {{ session('error_message') }}
        </div>
        @endif


        <form action="{{ route('intervieweeStore') }}" method="post" enctype="multipart/form-data"
            style="padding-top:100px">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Upload CSV file</label>
                <input class="form-control" type="file" name="csv_file" accept=".csv" required="required">
            </div>

            <div class="mb-3">
                <label class="form-label">Select Upload Type</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" id="interviewee" value="interviewee" required>
                    <label class="form-check-label" for="interviewee">
                    Interviewee
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" id="worker" value="worker" required>
                    <label class="form-check-label" for="worker">
                        Worker
                    </label>
                </div>
            </div>


            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-sm">Upload</button>
            </div>
        </form>

    </div>
</div>

@endsection
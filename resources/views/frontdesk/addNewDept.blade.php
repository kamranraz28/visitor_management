@extends('frontdesk.master')
@section('title','VMS')
@section('content')

<div class="col-md-12 col-lg-12 col-xl-12">

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

    
         <form action="{{ route('deptStore') }}" method="post"  style="padding-top:100px">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Department Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter department name" required>
    </div>

    
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary btn-sm  btn-lg login-btn">Add Department</button>
    </div>
</form>

    </div>
</div>

@endsection

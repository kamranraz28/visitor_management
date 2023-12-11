@extends('frontdesk.master')
@section('title','VMS')
@section('content')

<div class="col-md-12 col-lg-12 col-xl-12">

    <div class="mx-auto" style="max-width: 500px; padding-top:50px">
    
         <form action="{{route('staffStore')}}" method="post">
    @csrf
    

    

    <div class="mb-3">
        <div class="col-md-12">
            <label for="department_id" class="form-label">Department</label>
            <select class="form-select" id="department_id" name="department_id">
                <option value="">Select Department</option>
                @foreach($department as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter staff name" required>
    </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary w-100 btn-lg login-btn">Add Staff</button>
    </div>
</form>

    </div>
</div>

@endsection

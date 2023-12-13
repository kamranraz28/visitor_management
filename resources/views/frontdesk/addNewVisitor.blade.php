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

    
         <form action="{{ route('applyStore') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your e-mail" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" placeholder="Enter your address" rows="3" required></textarea>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="department" class="form-label">Department</label>
            <select class="form-select" id="department" name="department">
                <option value="">Select Department</option>
                @foreach($department as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="staff" class="form-label">Whom to visit</label>
            <select class="form-select" id="staff" name="staff">
                <option value="">Select whom to meet</option>
                @foreach($staffs as $staff)
                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3">
                <label for="reason" class="form-label">Reason</label>
                <select class="form-select" id="reason" name="reason">
                    <option value="">Select Reason</option>
                    
                    @foreach($reasons as $reason)
                        <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                    @endforeach
                </select>
            </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary w-100 btn-lg login-btn">Add Visitor</button>
    </div>
</form>

    </div>
</div>

@endsection

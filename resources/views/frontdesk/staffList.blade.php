@extends('frontdesk.master')
@section('title', 'VMS')
@section('content')
    <div class="col-md-9 col-lg-8 col-xl-12">
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
        <div class="row">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar2">
                                    <div class="circle-graph2" data-percent="65">
                                        <img src="assets/img/total-icon.png" class="img-fluid" alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>Total Staff</h6>
                                    <h3>{{$staffCount}}</h3>
                                    <p class="text-muted">Running</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end mt-3">
            <a style="width: 150px; height: 40px; display: flex; justify-content: center; align-items: center; margin: 0 20px 10px 0;"
               href="{{route('new_staff_add')}}" class="btn btn-secondary btn-sm">Add new Staff</a>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body pt-3">

                        <!-- Your table code remains unchanged -->
                        <div class="card card-table mb-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover table-center mb-0 patients-table table table-striped" style="width:100%">
                                    <thead>
                                        <tr style="text-align:center">
                                            <th>#</th>
                                            <th>Department Name</th>
                                            <th>Staff Name</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                    @foreach ($staffDetails as $element)
                                        <tr style="text-align:center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $element['departmentName'] }}</td>
                                            <td>{{ $element['staffName'] }}</td>
                                            <td>
                                                <button class="btn btn-secondary editButton" data-id="{{ $element['id'] }}">Edit</button>
                                                <a href="{{ route('staff_delete', ['id' => $element['id']]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                    </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

   
 @section('js') 

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
  document.addEventListener('DOMContentLoaded', function() {
   document.querySelectorAll('.editButton').forEach(function(button) {
      button.addEventListener('click', function() {
         var clickedElement = this;
         var staff_id = clickedElement.dataset.id;
         Swal.fire({
            title: 'Edit Staff information',
            html:
               '<form action="/edit_staff" method="post">' +
               '   @csrf' +
               '   <input type="text" name="name" class="form-control" placeholder="Enter staff name">' +
               '   <input type="hidden" name="staff_id" value="' + staff_id + '">' +
               '<br>' +
               '   <button type="submit" class="btn btn-primary">Update</button>' +
               '</form>',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
         });
      });
   });
});
</script>



 
<script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    
    @endsection


@endsection
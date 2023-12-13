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
                                    <h6>Total reason</h6>
                                    <h3>{{$reasonCount}}</h3>
                                    <p class="text-muted">Active</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end mt-3">
            <a style="width: 150px; height: 40px; display: flex; justify-content: center; align-items: center; margin: 0 20px 10px 0;"
               href="{{route('new_reason_add')}}" class="btn btn-secondary btn-sm">Add new Reason</a>
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
                                            <th>Reason</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($reasons as $reason)
                                        <tr style="text-align:center">
                                            <td>{{ $loop->iteration }}</td>
                                            
                                            <td>{{ $reason->name }}</td>
                                            <td>
                                                <button class="btn btn-secondary editButton" data-id="{{ $reason->id }}">Edit</button>
                                                <a href="{{ route('reason_delete', ['id' => $reason->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this reason?')">Delete</a>
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
         var reason_id = clickedElement.dataset.id;
         Swal.fire({
            title: 'Edit Reason Name',
            html:
               '<form action="/edit_reason" method="post">' +
               '   @csrf' +
               '   <input type="text" name="name" class="form-control" placeholder="Enter reason name">' +
               '   <input type="hidden" name="reason_id" value="' + reason_id + '">' +
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
@extends('frontdesk.master')
@section('title', 'VMS')
@section('content')
    <div class="col-md-9 col-lg-8 col-xl-12">
        <div class="row">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar2">
                                    <div class="circle-graph2" data-percent="65">
                                        <img src="assets/img/pending-icon.png" class="img-fluid" alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>New Application</h6>
                                    <h3>{{$newCount}}</h3>
                                    <p class="text-muted">Pending</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end mt-3">
            <a style="width: 150px; height: 40px; display: flex; justify-content: center; align-items: center; margin: 0 20px 10px 0;"
               href="{{route('new_visitor_add')}}" class="btn btn-secondary btn-sm">Add new Visitor</a>
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
                                           
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>E-mail</th>
                                            <th>Address</th>
                                            <th>Visited Dept.</th>
                                            <th>Visited to</th>
                                            <th>Reason</th>
                                            <th>Application Time</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visitorDetails as $element)
                                        <tr style="text-align:center">
                                            <td>{{ $loop->iteration }}</td>
                                            
                                            <td>{{ $element['visitorName'] }}</td>
                                            <td>{{ $element['visitorPhone'] }}</td>
                                            <td>{{ $element['visitorEmail'] }}</td>
                                            <td>{{ $element['visitorAddress'] }}</td>
                                            <td>{{ $element['deptName'] }}</td>
                                            <td>{{ $element['staffName'] }}</td>
                                            <td>{{ $element['reasonName'] }}</td>
                                            <td>{{ $element['visitorTime'] }}</td>
                                            <td>
                                            <button class="btn btn-secondary btn-sm approveButton" data-id="{{ $element['id'] }}">Approve</button>   
                                            <a href="{{ route('new_visitors_delete', ['id' => $element['id']]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to decline this visitor application?')">Decline</a>
                                             <br>
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
   document.querySelectorAll('.approveButton').forEach(function(button) {
      button.addEventListener('click', function() {
         var clickedElement = this;
         var visitor_id = clickedElement.dataset.id;
         Swal.fire({
            title: 'Scan Bar Code',
            html:
               '<form action="/final_approve" method="post">' +
               '   @csrf' +
               '   <input type="text" name="card_number" class="form-control" placeholder="Enter Card Number">' +
               '   <input type="hidden" name="visitor_id" value="' + visitor_id + '">' +
               '<br>' +
               '   <button type="submit" class="btn btn-primary">Submit</button>' +
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
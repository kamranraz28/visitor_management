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
                                            <!-- <th>Application Details</th> -->
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visitors as $visitor)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            
                                            <td>{{ $visitor->name }}</td>
                                            <td>{{ $visitor->phone }}</td>
                                            <td>{{ $visitor->email }}</td>
                                            <td>{{ $visitor->address }}</td>
                                            <!-- <td><a href="/application_details/{{$visitor->id}}" class="btn btn-info btn-sm">Details</a></td> -->
                                            <td>
                                                <button class="btn btn-success btn-sm" data-id="{{ $visitor->id }}" id="approveButton">Approve</button>                                                <br>
                                                <!-- <a href="/application_reject/{{$visitor->id}}" class="btn btn-danger btn-sm">Reject</a>    -->
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
  document.getElementById('approveButton').addEventListener('click', function() {
    var clickedElement = $(this);
    var visitor_id = clickedElement.data('id');
    Swal.fire({
      title: 'Scan Bar Code',
      html:
        '<form action="/final_approve" method="post">' +
        '   @csrf' +
        '   <input type="text" name="card_number" class="form-control" placeholder="Enter Card Number">' +
        '   <input type="hidden" name="visitor_id" value="' + visitor_id + '">' +
        '<br>'+
        '   <button type="submit" class="btn btn-primary">Submit</button>' +
        '</form>',
      showCancelButton: true,
      showConfirmButton: false,
      cancelButtonText: 'Cancel',
      showLoaderOnConfirm: true,
    })
  });
</script>


 
<script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    
    @endsection


@endsection
@extends('frontdesk.master')
@section('title', 'VMS')
@section('content')
    <div class="col-md-9 col-lg-8 col-xl-12">
        
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
                                        <tr>
                                            <th>#</th>
                                           
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Bar Code</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($interInfo as $inter)
                                        <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$inter->name}}</td>
                                        <td>{{$inter->phone}}</td>
                                        <td>{!! DNS2D::getBarcodeHTML("$inter->bar_code",'QRCODE',4,4) !!}</td>
                                        <td>-</td>
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
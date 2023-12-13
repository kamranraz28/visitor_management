@extends('frontdesk.master')
@section('title','VMS')
@section('content')
    <div class="col-md-9 col-lg-8 col-xl-12">
        <div class="row">
          
            <div class="card dash-card">
                <div class="card-body">
                <div class="text-center">
                        <h3>Find Report By Date</h3>
                    </div>
                    <hr>
                    <br>
                    <div class="row">
                        <form action="{{route('dayReportStore')}}">
                        <div class="col-md-12 col-lg-6">
                        <div class="col-md-8">
                            <label class="control-label" for="from">From</label>
                            <input type="date" class="form-control" name="from" id="from" value="{{ old('from', Session::get('from')) }}" format="Y-m-d">
                        </div>

                            <br>
                            <div class="col-md-8">
                            <label class="control-label" for="to">To</label>
                            <input type="date" class="form-control" name="to" id="to" value="{{ old('to', Session::get('to')) }}" format="Y-m-d">
                        </div>
                            <br>
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    
                    <div class="card-body pt-3">
    
                    <div class="card card-table mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-center mb-0 patients-table table table-striped" style="width:100%">
                                <thead>
                                        <tr style="text-align:center">
                                            <th>#</th>
                                           <th>Card Number</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>E-mail</th>
                                            <th>Address</th>
                                            <th>Visited Dept.</th>
                                            <th>Visited to</th>
                                            <th>Reason</th>
                                            <th>CheckIn Time</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visitorDetails as $element)
                                        <tr style="text-align:center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $element['visitorBarCode'] }}</td>
                                            <td>{{ $element['visitorName'] }}</td>
                                            <td>{{ $element['visitorPhone'] }}</td>
                                            <td>{{ $element['visitorEmail'] }}</td>
                                            <td>{{ $element['visitorAddress'] }}</td>
                                            <td>{{ $element['deptName'] }}</td>
                                            <td>{{ $element['staffName'] }}</td>
                                            <td>{{ $element['visitReason'] }}</td>
                                            <td>{{ $element['visitCheckin'] }}</td>
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
 
<script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthMenu": [10, 25, 50, 75, 100],
                "pageLength": 10,
                "order": [],
                "columnDefs": [{
                    "targets": [0, 6],
                    "orderable": false
                }],
                "language": {
                    "paginate": {
                        "previous": "&lt;",
                        "next": "&gt;"
                    }
                }
            });
        });
    </script>

@php
  Session::forget(['from','to']);
@endphp
    @endsection


@endsection
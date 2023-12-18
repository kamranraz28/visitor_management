@extends('frontdesk.master')
@section('title', 'VMS')
@section('content')
<div class="col-md-9 col-lg-8 col-xl-12">

    <div class="row">
        <div class="card dash-card">
            <div class="card-body">
                <form action="{{route('interStore')}}">

                    <div class="form-group">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="interviewee" name="userType"
                                value="interviewee">
                            <label class="form-check-label" for="interviewee">Interviewee</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="worker" name="userType" value="worker">
                            <label class="form-check-label" for="worker">Worker</label>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="last_upload" name="last_upload"
                                value="last_upload">
                            <label class="form-check-label" for="last_upload">Last Upload</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>

    @if($userType == "worker")
    <div class="text-center">
        <h2>Worker List</h2>
    </div>
    @else
    <div class="text-center">
        <h2>Interviewee List</h2>
    </div>
    @endif

    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body pt-3">

                    <!-- Your table code remains unchanged -->
                    <div class="card card-table mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-hover table-center mb-0 patients-table table table-striped"
                                    style="width:100%">
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
                                        @foreach ($interviewees as $inter)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$inter->name}}</td>
                                            <td>{{$inter->phone}}</td>
                                            <td>{!! DNS1D::getBarcodeSVG($inter->bar_code, "C39", 1, 33, '#2A3239') !!}</td>
                                            <td>
                                                <a href="{{ $userType == 'worker' ? route('print_worker', ['id' => $inter->id]) : route('print_interviewee', ['id' => $inter->id]) }}"
                                                    onclick="printDocument('{{ $userType == 'worker' ? route('print_worker', ['id' => $inter->id]) : route('print_interviewee', ['id' => $inter->id]) }}'); return false;"
                                                    class="btn btn-secondary">Print</a>
                                                <iframe id="printFrame" style="display:none;"></iframe>
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

<script>
    function printDocument(url) {
        var printFrame = document.getElementById('printFrame');
        printFrame.src = url;
        printFrame.onload = function () {
            printFrame.contentWindow.print();
        };
    }
</script>

@endsection


@endsection
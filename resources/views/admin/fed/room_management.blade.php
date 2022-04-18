@extends('../layouts/user')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Booking History</h4>
                        <div class="info_box">
                            <a href="{{ url('fed/room_management' )}}" class="btn btn-info">All</a>
                            <a href="{{ url('fed/room_management?s=ac' )}}" class="btn btn-success">Accepted</a>
                            <a href="{{ url('fed/room_management?s=rj' )}}" class="btn btn-danger">Rejected</a>
                            <a href="{{ url('fed/room_management?s=dc' )}}" class="btn btn-danger">Declined</a>
                            <a href="{{ url('fed/room_management?s=pd' )}}" class="btn btn-warning">Pending</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="room_management_table">
                                <thead>
                                    <tr>
                                        <th rowspan="2"> Booking Code </th>
                                        <th rowspan="2"> Name </th>
                                        <th rowspan="2"> NIM </th>
                                        <th rowspan="2"> Class </th>
                                        <th rowspan="2"> Room </th>
                                        <th rowspan="2"> Location </th>
                                        <th rowspan="2"> Status </th>
                                        <th colspan="2"> Time </th>
                                        <th rowspan="2"> Information </th>
                                        <th rowspan="2"> Action </th>
                                    </tr>
                                    <tr>
                                        <th>Start</th>
                                        <th>End</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_res as $res)
                                        <tr class="text-center">
                                            <td> {{$res->date}} </td>
                                            <td> {{$res->name}} </td>
                                            <td> {{$res->nim}} </td>
                                            <td> {{$res->class}} </td>
                                            <td> {{$res->room_number}} </td>
                                            <td> @if(substr($res->reservation_code,0,2) == 'AD') Aryaduta @else Lippo Mall @endif </td>
                                            <td> 
                                                <i class="icon-md mdi
                                                 @if($res->reservation_status_id == 'booked') mdi-close-circle-outline text-danger 
                                                 @elseif($res->reservation_status_id == 'accept') mdi mdi-calendar-check text-primary
                                                 @elseif($res->reservation_status_id == 'decline' || $res->reservation_status_id == 'rejected') mdi mdi mdi-close-box text-danger
                                                 @elseif($res->reservation_status_id == 'available') mdi mdi-check-circle-outline text-success
                                                 @elseif($res->reservation_status_id == 'pending') mdi mdi-calendar-clock text-warning @endif"></i> 
                                            </td>
                                            <td> 14:00 </td>
                                            <td> 16:00 </td>
                                            <td> Meeting HMPSI </td>
                                            <td>
                                                <a href="{{ url('fed/acc_book/'.$res->id) }}" class="btn btn-rounded btn-success pt-2 @if($res->reservation_status_id != 'pending') disabled @endif" >Accept</a>
                                                <a href="{{ url('fed/ccl_book/'.$res->id) }}" class="btn btn-rounded btn-danger pt-2 @if($res->reservation_status_id != 'pending') disabled @endif" >Reject</a>
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
@endsection
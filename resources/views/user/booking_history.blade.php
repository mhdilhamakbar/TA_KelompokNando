@extends('../layouts/user')
@section('content')
    <div class="content-wrapper">
        <script>
            function get_data(r_id) {
                $.ajax({
                    type: 'GET',
                    url: 'info_book',
                    data : {id : r_id},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data)
                        console.log("Success Get Data")
                        $('#b_id').val(data.id)
                        $("#b_code").val(data.reservation_code)
                        $('#r_number').val(data.room_number)
                        $("#loc").val(data.location)
                        $('#time').val(data.start+" - "+data.end)
                        $("#date").val(data.date)
                        $("#status").val(data.reservation_status_id)
                        $("#name").val(data.name)
                        $("#nim").val(data.nim)
                        $("#class").val(data.class)
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        </script>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Booking History</h4>
                        <div class="info_box">
                            <i class="icon-sm mdi mdi-calendar-check text-primary"></i> <p class="info_icon"> ( Accepted ) </p>
                            <i class="icon-sm mdi mdi-close-box text-danger"></i> <p class="info_icon"> ( Rejected / Decline ) </p>
                            <i class="icon-sm mdi mdi-calendar-clock text-warning"></i> <p class="info_icon"> ( Pending ) </p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="history_table">
                                <thead>
                                    <tr>
                                        <th rowspan="2"> Date </th>
                                        <th rowspan="2"> Booking Code </th>
                                        <th rowspan="2"> Room </th>
                                        <th rowspan="2"> Location </th>
                                        <th colspan="2"> Time </th>
                                        <th rowspan="2"> Information </th>
                                        <th rowspan="2"> Status </th>
                                        <th rowspan="2"> Action </th>
                                    </tr>
                                    <tr>
                                        <th>Start</th>
                                        <th>End</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($book_history as $b)
                                        <tr class="text-center">
                                            <td> {{$b->date}} </td>
                                            <td> {{$b->reservation_code}} </td>
                                            <td> {{$b->room_number}} </td>
                                            <td> @if(substr($b->reservation_code,0,2) == 'AD') Aryaduta @else Lippo Mall @endif </td>
                                            <td> {{Carbon\Carbon::parse($b->start)->format('H:i:s')}} </td>
                                            <td> {{Carbon\Carbon::parse($b->end)->format('H:i:s')}} </td>
                                            <td> {{$b->description}} </td>
                                            <td> <i class="icon-md mdi
                                                 @if($b->reservation_status_id == 'booked') mdi-close-circle-outline text-danger 
                                                 @elseif($b->reservation_status_id == 'accept') mdi mdi-calendar-check text-primary
                                                 @elseif($b->reservation_status_id == 'decline' || $b->reservation_status_id == 'rejected') mdi mdi mdi-close-box text-danger
                                                 @elseif($b->reservation_status_id == 'available') mdi mdi-check-circle-outline text-success
                                                 @elseif($b->reservation_status_id == 'pending') mdi mdi-calendar-clock text-warning @endif"></i> </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#det_book" onclick="get_data({{$b->id}})" class="btn btn-rounded btn-warning">Detail</button>
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
        <div class="modal fade" id="det_book" tabindex="-1" role="dialog" aria-labelledby="det_bookTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-info">
                  <h5 class="modal-title" id="det_bookTitle">Booking Info</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ url('user/cancel') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row" style="display: none;">
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="b_id" name="b_id" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Booking Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="b_code" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Room</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="r_number" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="loc" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Time</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="time" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="date" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="status" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">NIM</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nim" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Class</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="class" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Cancel</a>
                    </div>  
                </form>
              </div>
            </div>
        </div>
    </div>
@endsection
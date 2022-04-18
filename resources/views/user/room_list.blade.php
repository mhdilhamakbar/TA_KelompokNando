@extends('../layouts/user')
@section('content')
<script>
    function get_data(r_id) {
        $.ajax({
            type: 'GET',
            url: 'info_room',
            data : {id : r_id},
            dataType: 'json',
            success: function (data) {
                console.log(data)
                console.log("Success Get Data")
                $("#b_code").val(data.reservation_code)
                $('#r_number').val(data.room_number)
                $("#loc").val(data.location)
                $('#time').val(data.start+" - "+data.end)
                $("#date").val(data.date)
                $("#status").val(data.reservation_status_id)
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    function update_id($r_id){
        $('#room_id').val($r_id);
    }
</script>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Showing Room List</h4>
                        <div class="info_box">
                            <i class="icon-sm mdi mdi-check-circle-outline text-success"></i> <p class="info_icon"> ( Available ) </p>
                            <i class="icon-sm mdi mdi mdi-close-circle-outline text-danger"></i> <p class="info_icon"> ( Booked / Not Available ) </p>
                            <i class="icon-sm mdi mdi mdi mdi-calendar-clock text-warning"></i> <p class="info_icon"> ( Pending ) </p>
                            <i class="icon-sm mdi mdi mdi mdi mdi-close-box text-danger"></i> <p class="info_icon"> ( Rejected ) </p>
                            <i class="icon-sm mdi mdi mdi mdi-calendar-check text-primary"></i> <p class="info_icon"> ( Accepted ) </p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="room_table">
                                <thead>
                                    <tr>
                                        <th rowspan="2"> Date </th>
                                        <th rowspan="2"> Booking Code </th>
                                        <th rowspan="2"> Room </th>
                                        <th rowspan="2"> Location </th>
                                        <th colspan="2"> Time </th>
                                        <th rowspan="2"> Status </th>
                                        <th rowspan="2"> Action </th>
                                    </tr>
                                    <tr>
                                        <th>Start</th>
                                        <th>End</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_rooms as $room)
                                        <tr class="text-center">
                                            <td> {{$room->date}} </td>
                                            <td> {{$room->reservation_code}} </td>
                                            <td> {{$room->room_number}} </td>
                                            <td> @if(substr($room->reservation_code,0,2) == 'AD') Aryaduta @else Lippo Mall @endif </td>
                                            <td> {{Carbon\Carbon::parse($room->start)->format('H:i:s')}} </td>
                                            <td> {{Carbon\Carbon::parse($room->end)->format('H:i:s')}} </td>
                                            <td> <i class="icon-md mdi
                                                 @if($room->reservation_status_id == 'booked' || $room->reservation_status_id == 'decline') mdi-close-circle-outline text-danger 
                                                 @elseif($room->reservation_status_id == 'accept') mdi mdi-calendar-check text-primary
                                                 @elseif($room->reservation_status_id == 'rejected') mdi mdi mdi-close-box text-danger
                                                 @elseif($room->reservation_status_id == 'available') mdi mdi-check-circle-outline text-success
                                                 @elseif($room->reservation_status_id == 'pending') mdi mdi-calendar-clock text-warning @endif"></i> </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#booking" onclick="update_id({{$room->id}})" @if($room->reservation_status_id != 'available') disabled @endif class="btn btn-rounded btn-success">Booking</a>
                                                <button data-toggle="modal" data-target="#det_book" onclick="get_data({{$room->id}})" class="btn btn-rounded btn-warning">Detail</button>
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
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-labelledby="det_bookTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-success">
                  <h5 class="modal-title" id="det_bookTitle">Booking Form</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                    <div class="modal-body">
                        <form action="{{ url('user/book') }}" method="post">
                            @csrf
                            <div class="form-group" style="display: none;">
                                <input type="text" name="room_id" id="room_id">
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="name">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nim">NIM</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nim" name="nim" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="class">Class</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="class" name="class" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="desc">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="desc" id="desc" cols="30" rows="10">Description here</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Book this room</button>
                        </div>                
                    </form>
                </form>
              </div>
            </div>
        </div>
    </div>
@endsection
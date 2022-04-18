@extends('../layouts/user')
@section('content')
<script>
    function get_info(att_id) {
        $.ajax({
            type: 'GET',
            url: 'info_att',
            data : {id : att_id},
            dataType: 'json',
            success: function (data) {
                console.log(data)
                console.log("Success Get Data")
                $("#edit_id").val(data.id)
                $('#l_name_ed').val(data.lecture_name)
                $("input[name=loc_ed][value='"+data.location+"']").prop('checked','checked')
                $("#class_ed").val(data.class)
                $('#date_ed').val(data.date)
                $("#mk_pick_ed").val(data.marker_collect_at)
                $("#mk_rtn_ed").val(data.marker_return_at)
                $("#att_pick_ed").val(data.attendance_collect_at)
                $("#att_rtn_ed").val(data.attendance_return_at)
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    function get_info2(att_id) {
        $.ajax({
            type: 'GET',
            url: 'info_att',
            data : {id : att_id},
            dataType: 'json',
            success: function (data) {
                console.log(data)
                console.log("Success Get Data")
                $('#lname_info').val(data.lecture_name)
                $("#loc_info").val(data.location_fname)
                $("#class_info").val(data.class)
                $("#room_info").val(data.room_number)
                $("#date_info").val(data.date)
                $("#mk_pick_info").val(data.marker_collect_at)
                $("#mk_rtn_info").val(data.marker_return_at)
                $("#att_pick_info").val(data.attendance_collect_at)
                $("#att_rtn_info").val(data.attendance_return_at)
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
</script>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Attendance</h4>
                        <div class="info_box text-right mb-3">
                            <button class="btn btn-lg btn-success btn-rounded" data-toggle="modal" data-target="#add_new_att"> <i class="mdi mdi-alarm-plus"></i> Add Attendance</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="attendance_table" style="border-top: 1px solid #2c2e33;">
                                <thead>
                                    <tr>
                                        <th rowspan="2"> No </th>
                                        <th rowspan="2"> Lecture Name </th>
                                        <th rowspan="2"> Class </th>
                                        <th rowspan="2"> Location </th>
                                        <th rowspan="2"> Date </th>
                                        <th colspan="2"> Time Pick Up</th>
                                        <th colspan="2"> Time Return</th>
                                        <th rowspan="2"> Action </th>
                                    </tr>
                                    <tr>
                                        <th>Markers</th>
                                        <th>Attendance</th>
                                        <th>Markers</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_attendance as $attendance)
                                        <tr class="text-center">
                                            <td> {{$attendance->id}} </td>
                                            <td> {{$attendance->lecture_name}} </td>
                                            <td> {{$attendance->class}} </td>
                                            <td> {{$attendance->location}} </td>
                                            <td> {{$attendance->date}} </td>
                                            <td @if(substr($attendance->marker_collect_at, -8) == "00:00:00")class="text-danger"@endif> {{$attendance->marker_collect_at}} </td>
                                            <td @if(substr($attendance->attendance_collect_at, -8) == "00:00:00")class="text-danger"@endif> {{$attendance->attendance_collect_at}} </td>
                                            <td @if(substr($attendance->marker_return_at, -8) == "00:00:00")class="text-danger"@endif> {{$attendance->marker_return_at}} </td>
                                            <td @if(substr($attendance->attendance_return_at, -8) == "00:00:00")class="text-danger"@endif> {{$attendance->attendance_return_at}} </td>
                                            <td>
                                                <button class="btn btn-rounded btn-warning" data-toggle="modal" data-target="#edit_att" id="{{$attendance->id}}" onclick="get_info({{$attendance->id}})">Edit</button>
                                                <button class="btn btn-rounded btn-info" data-toggle="modal" data-target="#info_att" id="{{$attendance->id}}" onclick="get_info2({{$attendance->id}})">Detail</button>
                                            </td>
                                        </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="add_new_att" tabindex="-1" role="dialog" aria-labelledby="add_new_attTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="add_new_attTitle">MARKET & ATTENDANCE</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{ url('fed/add_att') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="l_name">Lecture Name</label>
                                            <select class="js-example-basic-single" style="width:100%" name="l_name">
                                                @foreach ($list_lecture as $lecture)
                                                    <option value="{{$lecture->id}}">{{$lecture->name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        <div class="form-group row">
                                            <label for="l_name" class="col-sm-3 col-form-label">Location</label>
                                            <div class="col-sm-9">
                                                @foreach ($list_location as $location)
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="location" id="loc_{{$location->code}}" value="{{$location->code}}" @if($location->code == "AD") selected @endif> {{$location->name}} <i class="input-helper"></i></label>
                                                    </div>                                                    
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="class" class="col-sm-3 col-form-label">Class</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="class" placeholder="Class" name="class" required>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="r_ad">
                                            <label for="room" class="col-sm-12 col-form-label">Room Aryaduta</label>                                            
                                            <select class="js-example-basic-single" style="width:100%" name="room">
                                                @foreach ($list_room_ad as $room)
                                                    <option value="{{$room['id']}}">{{$room->code.'-'.$room->room_number.' ['.$room->name.']'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group row" id="r_lp">
                                            <label for="room" class="col-sm-12 col-form-label">Room Lippo</label>                                            
                                            <select class="js-example-basic-single" style="width:100%" name="room">
                                                @foreach ($list_room_lp as $room)
                                                <option value="{{$room['id']}}">{{$room->code.'-'.$room->room_number.' ['.$room->name.']'}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-3 col-form-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="date" name="date" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-12 col-form-label">Marker</label>
                                            <label class="col-sm-3 col-form-label" for="mk_pick">Pick Up</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="mk_pick" name="mk_pick" value="00:00" required>
                                            </div>
                                            <label class="col-sm-3 col-form-label" for="mk_rtn">Return</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="mk_rtn" name="mk_rtn" value="00:00" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-12 col-form-label">Attendance</label>
                                            <label class="col-sm-3 col-form-label" for="at_pick">Pick Up</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="at_pick" name="at_pick" value="00:00" required>
                                            </div>
                                            <label class="col-sm-3 col-form-label" for="at_rtn">Return</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="at_rtn" name="at_rtn" value="00:00" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Add</button>
                                    </div>                
                                </form>
                              </div>
                            </div>
                        </div>
                        <div class="modal fade" id="edit_att" tabindex="-1" role="dialog" aria-labelledby="edit_attTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-warning">
                                  <h5 class="modal-title" id="edit_attTitle">Edit Attendance</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{ url('fed/edit_att') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="edit_id" id="edit_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="l_name">Lecture Name</label>
                                            <select class="js-example-basic-single" style="width:100%" name="l_name_ed">
                                                @foreach ($list_lecture as $lecture)
                                                    <option value="{{$lecture->id}}">{{$lecture->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Location</label>
                                            <div class="col-sm-9">
                                                @foreach ($list_location as $location)
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="loc_ed" id="loc_{{$location->code}}" value="{{$location->code}}"> {{$location->name}} <i class="input-helper"></i></label>
                                                    </div>                                                    
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="class" class="col-sm-3 col-form-label">Class</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="class_ed" name="class_ed" required>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="r_ad_ed">
                                            <label for="room" class="col-sm-12 col-form-label">Room Aryaduta</label>                                            
                                            <select class="js-example-basic-single" style="width:100%" name="room_ed">
                                                @foreach ($list_room_ad as $room)
                                                    <option value="{{$room['id']}}">{{$room->code.'-'.$room->room_number.' ['.$room->name.']'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group row" id="r_lp_ed">
                                            <label for="room" class="col-sm-12 col-form-label">Room Lippo</label>                                            
                                            <select class="js-example-basic-single" style="width:100%" name="room_ed">
                                                @foreach ($list_room_lp as $room)
                                                <option value="{{$room['id']}}">{{$room->code.'-'.$room->room_number.' ['.$room->name.']'}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date-ed" class="col-sm-3 col-form-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="date_ed" name="date_ed" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-12 col-form-label">Marker</label>
                                            <label class="col-sm-3 col-form-label" for="mk_pick_ed">Pick Up</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="mk_pick_ed" name="mk_pick_ed" value="00:00" required>
                                            </div>
                                            <label class="col-sm-3 col-form-label" for="mk_rtn_ed">Return</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="mk_rtn_ed" name="mk_rtn_ed" value="00:00" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-12 col-form-label">Attendance</label>
                                            <label class="col-sm-3 col-form-label" for="att_pick_ed">Pick Up</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="att_pick_ed" name="att_pick_ed" value="00:00" required>
                                            </div>
                                            <label class="col-sm-3 col-form-label" for="att_rtn_ed">Return</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="att_rtn_ed" name="att_rtn_ed" value="00:00" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Add</button>
                                    </div>                
                                </form>
                              </div>
                            </div>
                        </div>
                        <div class="modal fade" id="info_att" tabindex="-1" role="dialog" aria-labelledby="info_attTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-info">
                                  <h5 class="modal-title" id="info_attTitle">Attendance Info</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Lecture Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="lname_info" name="lname_info" readonly>
                                            </div>
                                          </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Location</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="loc_info" name="loc_info" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="class" class="col-sm-3 col-form-label">Class</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="class_info" name="class_info" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="r_ad_ed">                                           
                                            <label for="room_info" class="col-sm-3 col-form-label">Room <span id="loc_name_info"></span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="room_info" name="room_info" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date_info" class="col-sm-3 col-form-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="date_info" name="date_info" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-12 col-form-label">Marker</label>
                                            <label class="col-sm-3 col-form-label" for="mk_pick_ed">Pick Up</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="mk_pick_info" name="mk_pick_info" readonly>
                                            </div>
                                            <label class="col-sm-3 col-form-label" for="mk_rtn_info">Return</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="mk_rtn_info" name="mk_rtn_info" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-12 col-form-label">Attendance</label>
                                            <label class="col-sm-3 col-form-label" for="att_pick_info">Pick Up</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="att_pick_info" name="att_pick_info" readonly>
                                            </div>
                                            <label class="col-sm-3 col-form-label" for="att_rtn_info">Return</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="att_rtn_info" name="att_rtn_info" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>                
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#r_lp').css('display','none');
            $('input[type=radio][name=location]').change(function() {
                if (this.value == 'AD') {
                    $('#r_lp').css('display','none');
                    $('#r_ad').css('display','block');
                }
                else if (this.value == 'LP') {
                    $('#r_lp').css('display','block');
                    $('#r_ad').css('display','none');
                }
            });
            $('#r_lp_ed').css('display','none');
            $('input[type=radio][name=loc_ed]').change(function() {
                if (this.value == 'AD') {
                    $('#r_lp_ed').css('display','none');
                    $('#r_ad_ed').css('display','block');
                }
                else if (this.value == 'LP') {
                    $('#r_lp_ed').css('display','block');
                    $('#r_ad_ed').css('display','none');
                }
            });
        })
    </script>
@endsection
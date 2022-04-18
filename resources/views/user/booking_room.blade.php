@extends('../layouts/user')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-2"></div>
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Search Room</h4>
                            <p class="card-description"> Search room for booking </p>
                            <form class="forms-sample" action="{{ url('user/s_availroom') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="booking_date" class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="booking_date" name="booking_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="start_time" class="col-sm-3 col-form-label">Time Start</label>
                                    <div class="col-sm-9">
                                        <input type="time" class="form-control" id="start_time" name="start_time">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_time" class="col-sm-3 col-form-label">Time End</label>
                                    <div class="col-sm-9">
                                        <input type="time" class="form-control" id="end_time" name="end_time">
                                    </div>
                                </div>
                                <div class="btn-group act_btn_group mt-4" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary mr-2">Search</button>
                                    <a href="{{ route('show_room_list') }}" class="btn btn-dark">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
@endsection
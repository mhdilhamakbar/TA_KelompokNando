@extends('../layouts/user')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-2"></div>
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Change Password</h4>
                            <p class="card-description"> Change your old password to a new one </p>
                            <form class="forms-sample" action="{{ url('com_cp') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="c_password" class="col-sm-3 col-form-label">New Password Confirmation</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="c_password" name="c_password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="submit" class="btn btn-block btn-success"> Confirm </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="wrap">
                    <div class="img" style="background-image: url({{ asset('auth/images/logo_uph.jpg') }});background-size:contain;"></div>
                    <div class="login-wrap p-4 p-md-5">
                  <div class="d-flex">
                    <div class="w-100">
                      <h3 class="mb-4">Register</h3>
                    </div>
                  </div>
                  <form action="{{ url('register') }}" class="signin-form" method="POST">
                    @csrf
                    <div class="form-group mt-3">
                      <input type="email" class="form-control" name="email" required>
                      <label class="form-control-placeholder" for="email">Email</label>
                    </div>
                    <div class="form-group">
                      <input id="password-field" type="password" class="form-control" name="password" required>
                      <label class="form-control-placeholder" for="password">Password</label>
                      <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                      <input id="c_password-field" type="password" class="form-control" name="c_password" required>
                      <label class="form-control-placeholder" for="c_password">Password</label>
                      <span toggle="#c_password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group mt-3">
                      <input type="text" class="form-control" name="name" required>
                      <label class="form-control-placeholder" for="name">Name</label>
                  </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Register</button>
                    </div>
                  </form>
                  <p class="text-center">Have an acoount ? <a href="{{route('login')}}">Sign In</a></p>
            </div>
          </div>
            </div>
        </div>
    </div>
</section>
@endsection

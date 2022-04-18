@extends('layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url({{ asset('auth/images/logo_uph.jpg') }});background-size:contain;">
              </div>
                    <div class="login-wrap p-4 p-md-5">
                  <div class="d-flex">
                      <div class="w-100">
                          <h3 class="mb-4">Sign In</h3>
                      </div>
                  </div>
                <form action="{{ url('login') }}" class="signin-form" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="label" for="name">Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="label" for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="w-50 text-left">

                        </div>
                        <div class="w-50 text-md-right">
                            <a href="#">Forgot Password</a>
                        </div>
                    </div>
              </form>
              <p class="text-center">Not a member? <a href="{{route('register')}}">Sign Up</a></p>
            </div>
          </div>
            </div>
        </div>
    </div>
</section>
@endsection

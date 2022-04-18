@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">You're on redirecting</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    Welcome {{Auth::user()->name}}, {{ __("Your session has been renewed !") }}
                    And you will be redirected in <span id="ctd"></span> seconds...
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var role = "{{Auth::user()->role}}"
    var url;
    if(role == "fed"){
        url = "{{ route('fed_dashboard') }}"
    }
    else if (role == "ssc"){
        url = "{{ route('ssc_dashboard') }}"
    }
    else if (role == "sa"){
        url = "{{ route('sa_dashboard') }}"
    }
    else {
        url = "{{ route('user_dashboard') }}"
    }
    var i = 5;
    setInterval(function(){
        document.getElementById("ctd").innerText = i;
        i--;
    }, 1000);
    setTimeout(function () {
        window.location.href= url;
    },5000); 
</script>
@endsection

@extends('layouts.auth')
 
@section('title', 'Page Title')
@section('content')
    
<div class="account-pages mt-5 mb-5" data-aos="fade-right">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">

                    <div class="card-body p-4">
                        
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="index.html" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <!-- logo are here -->
                                    </span>
                                </a>
            
                                <a href="index.html" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="assets/images/logo-light.png" alt="" height="22">
                                    </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                        </div>

                        <form onsubmit="confirmAndSubmit(this)" method="POST" action="{{route('auth.forgot_password.email')}}">
                            @csrf

                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input  type="email" name="email" class="form-control @error('email') is-invalid @enderror " id="email" value="{{ old('email') }}" placeholder="Enter your email">
                                @error('email')
                                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-center d-grid">
                                <button class="btn btn-primary" type="submit"> Reset Password </button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Back to <a href="{{route('login')}}" class="text-white ms-1"><b>Log in</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


@endsection
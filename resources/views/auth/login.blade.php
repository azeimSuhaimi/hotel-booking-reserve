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
                                        
                                    </span>
                                </a>
            
                                <a href="index.html" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <!-- logo here -->
                                    </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">Enter your email address and password.</p>
                        </div>

                        <form method="POST" action="{{route('auth.login')}}">
                            @csrf

                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input  type="email" name="email" class="form-control @error('email') is-invalid @enderror " id="email" value="{{ old('email') }}" placeholder="Enter your email">
                                @error('email')
                                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror " value="{{ old('password') }}" id="password" placeholder="Enter your password">
                                    @error('password')
                                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember_token">
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="show_password" onchange="showPassword()" >
                                    <label class="form-check-label" for="checkbox-signin">show password</label>
                                </div>
                            </div>

                            <div class="text-center d-grid">
                                <button class="btn btn-primary" type="submit"> Log In </button>
                            </div>

                        </form>

                        <div class="text-center">
                            <h5 class="mt-3 text-muted">Sign in with</h5>
                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="/auth/google/redirect" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">

                                    <a href="/auth/github/redirect" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p> <a href="{{route('auth.forgot_password')}}" class="text-white-50 ms-1">Forgot your password?</a></p>
                        <p class="text-white-50">Don't have an account? <a href="{{route('auth.create')}}" class="text-white ms-1"><b>Sign Up</b></a></p>
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
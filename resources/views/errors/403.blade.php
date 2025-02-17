@extends('layouts.auth')
 
@section('title', 'Page Title')
@section('content')
    
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">

                    <div class="card-body p-4">
                        
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

                        <div class="text-center mt-4">
                            <h1 class="text-error">403</h1>
                            <h3 class="mt-3 mb-2">{{ $exception->getMessage() }}</h3>
                            <!-- <p class="text-muted mb-3">Why not try refreshing your page? or you can contact <a href="" class="text-dark"><b>Support</b></a></p> -->

                            <a href="javascript:window.history.back();" class="btn btn-success waves-effect waves-light">Back</a>
                        </div>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


@endsection
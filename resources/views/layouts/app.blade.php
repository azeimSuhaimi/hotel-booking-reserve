<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- third party css -->
        <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <script src="{{ asset('vendor/smart-ads/js/smart-banner.min.js') }}"></script>

        <script
          src="https://code.jquery.com/jquery-3.3.1.min.js"
          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>
          
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      
        <!-- sweet alert 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Plugins css -->
        <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/dropify/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />

		<!-- Bootstrap css -->
		<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
		<!-- App css -->
		<link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
		<!-- icons -->
		<link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
		<!-- Head js -->
		<script src="{{asset('assets/js/head.js')}}"></script>

    </head>

    <!-- body start -->
    <body data-layout-mode="default" data-theme="light" data-topbar-color="dark" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

        <!-- Begin page -->
        <div id="wrapper">

            @include('partials.topbar')


            @include('partials.left_sidebar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        @yield('content')

                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="">Coderthemes</a> 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        @include('partials.right_sidebar')

        <!-- Vendor js -->
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.min.js')}}"></script>

        <!-- Plugins js -->
        <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
        <script src="{{asset('assets/libs/dropify/js/dropify.min.js')}}"></script>

        <!-- third party js -->
        <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
        <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

        <!-- Footable js -->
        <script src="{{asset('assets/libs/footable/footable.all.min.js')}}"></script>

        <!-- Init js -->
        <script src="{{asset('assets/js/pages/foo-tables.init.js')}}"></script>

        
        <script>
            function showPassword() {
                // Get the password input and checkbox elements
                var password = document.getElementById("password");
                var checkbox = document.getElementById("show_password");
            
                // Check the state of the checkbox
                if (checkbox.checked) {
                    // If the checkbox is checked, change the input type to "text"
                    password.type = "text";
                } else {
                    // If the checkbox is not checked, change the input type back to "password"
                    password.type = "password";
                }
            }
        
        </script>

        <script>
            AOS.init();
        </script>

        <script>




            // https://sweetalert2.github.io/#download

            function confirmAndSubmit(element) {
            event.preventDefault();


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, ',
                    cancelButtonText: 'cancel, '
                }).then((result) => {
                    if (result.isConfirmed) {
                        element.submit();
                    }

                });
            }

            function confirmAndRedirect(element) {
                event.preventDefault();


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, ',
                    cancelButtonText: 'cancel, '
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = element.getAttribute('href');
                    }

                });
            }
        </script>
        
        @if (session('error'))

            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: '{{ session('error') }}'
                    })
            </script>
        @endif

        @if (session('success'))

            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'success',
                    text: '{{ session('success') }}'
                    })
            </script>
        @endif
        
    </body>
</html>
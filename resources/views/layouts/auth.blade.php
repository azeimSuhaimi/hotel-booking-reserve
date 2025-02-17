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

		<!-- Bootstrap css -->
		<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
		<!-- App css -->
		<link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
		<!-- icons -->
		<link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
		<!-- Head js -->
		<script src="{{asset('assets/js/head.js')}}"></script>

    </head>

    <body class="authentication-bg authentication-bg-pattern">

        @yield('content')



        <footer class="footer footer-alt">
            2015 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="" class="text-white-50">Coderthemes</a> 
        </footer>

        <!-- Vendor js -->
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.min.js')}}"></script>


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
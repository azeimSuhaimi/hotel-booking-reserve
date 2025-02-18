@extends('layouts.app')
 
@section('title', 'Page Title')
@section('content')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>
            <h4 class="page-title">Change Password</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 


<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Change Password</h4>
                <p class="sub-header"></p>

                <form method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('user.change_password_update')}}" >
                    @csrf




                    <div class="mb-3">
                        <label for="password" class="form-label">Current Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" id="password">
                        @error('password')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password1" class="form-label">New Password</label>
                        <input type="password" onkeyup="checkPasswordStrength(this)" class="form-control @error('password1') is-invalid @enderror" name="password1" value="{{ old('password1') }}" id="password1">
                        <span id="password-strength"></span>
                        @error('password1')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password2" class="form-label">Re-enter New Password</label>
                        <input type="password" class="form-control @error('password2') is-invalid @enderror" name="password2" value="{{ old('password2') }}" id="password2">
                        @error('password2')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="show_password" onchange="showPassword1()" />
                            <label class="form-check-label" for="show_password">Show Password</label>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Submit form</button>
                </form>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->


    <!-- end col-->
</div>
<!-- end row -->


<script>
    function showPassword1() {
      // Get the password input and checkbox elements
      var password = document.getElementById("password");
      var password1 = document.getElementById("password1");
      var password2 = document.getElementById("password2");
      var checkbox = document.getElementById("show_password");

      // Check the state of the checkbox
      if (checkbox.checked) {
          // If the checkbox is checked, change the input type to "text"
          password.type = "text";
          password1.type = "text";
          password2.type = "text";
      } else {
          // If the checkbox is not checked, change the input type back to "password"
          password.type = "password";
          password1.type = "password";
          password2.type = "password";
      }
    }

</script>

<script>
  function checkPasswordStrength() {
      var password = document.getElementById("password1").value;
      var strength = 0;
  
      // Check for length
      if (password.length < 6) {
          document.getElementById("password-strength").innerHTML = "Too short";
          return;
      }
  
      // Check for uppercase
      if (password.match(/[A-Z]/)) {
          strength++;
      }
  
      // Check for lowercase
      if (password.match(/[a-z]/)) {
          strength++;
      }
  
      // Check for numbers
      if (password.match(/\d+/)) {
          strength++;
      }
  
      // Check for special characters
      if (password.match(/[!@#$%^&*]/)) {
          strength++;
      }
  
      // Display strength
      switch (strength) {
          case 0:
              document.getElementById("password-strength").innerHTML = "Too Weak";
              break;
          case 1:
              document.getElementById("password-strength").innerHTML = "Weak";
              break;
          case 2:
              document.getElementById("password-strength").innerHTML = "Moderate";
              break;
          case 3:
              document.getElementById("password-strength").innerHTML = "Strong";
              break;
          case 4:
              document.getElementById("password-strength").innerHTML = "Very Strong";
              break;
      }
  }
</script>


@endsection
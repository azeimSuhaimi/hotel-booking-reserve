@extends('admin.admindashboard')
@section('admin')

<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{asset('backend/assets/img/'.auth()->user()->picture)}}" alt="Profile" class="rounded-circle">
            <h2>{{auth()->user()->name}}</h2>

          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->name}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->address}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->phone}}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{auth()->user()->email}}</div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <form class="submit pb-3" onsubmit="confirmAndSubmit(this)" action="{{route('admin.update.image')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{auth()->user()->id}}">

                  <!-- Profile Edit Form -->
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="{{asset('backend/assets/img/'.auth()->user()->picture)}} " id="image-preview" alt="Profile">
                      
                    </div>
                  </div>

                  <div class="row mb-3">
                      <label for="file-input" class="col-md-4 col-lg-3 col-form-label @error('file') is-invalid @enderror">Select Files Here</label>
                      <div class="col-md-8 col-lg-9">

                        <input  class="form-control" name="file" id="file-input" type="file" placeholder="" />
                      </div>
                      
                  </div>
                      @error('file')
                          <span class=" invalid-feedback mt-2">{{ $message }}</span>
                      @enderror

                      <div class="text-center">
                          <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i></button>
                          <button form="remove_image" type="submit"  class="btn btn-danger"><i class="bi bi-trash"></i></button>
                      </div>

                </form>

                <form id="remove_image" onsubmit="confirmAndSubmit(this)" action="{{route('admin.remove.image')}}" method="post" >
                    @csrf
                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                </form>

                <!-- Profile Edit Form -->
                <form onsubmit="confirmAndSubmit(this)" action="{{route('admin.update.profile')}}" method="post">
                  @csrf

                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="name" value="{{auth()->user()->name}}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" value="{{auth()->user()->address}}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone" value="{{auth()->user()->phone}}">
                    </div>
                  </div>




                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">

                <!-- Settings Form -->
                <form>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                          Changes made to your account
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                          Information on new products and services
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                          Marketing and promo offers
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                          Security alerts
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End settings Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('admin.password.update')}}">

                  @csrf

                  <div class="row mb-3">
                    <label for="password1" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password">
                      @error('password')
                          <span class=" invalid-feedback mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password1" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password1" type="password" class="form-control @error('password1') is-invalid @enderror" value="{{ old('password1') }}" id="password1">
                      @error('password1')
                          <span class=" invalid-feedback mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password2" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password2" type="password" class="form-control @error('password2') is-invalid @enderror" value="{{ old('password2') }}" id="password2">
                      @error('password2')
                          <span class=" invalid-feedback mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-6">
                      <div class="form-check ">
                          <input class="form-check-input" type="checkbox" id="show_password" onchange="showPassword()" />
                          <label class="form-check-label" for="show_password">Show Password</label>
                      </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>


  <script>
    const fileInput = document.getElementById('file-input');
    const imagePreview = document.getElementById('image-preview');
    
    fileInput.addEventListener('change', function () {
      const file = fileInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function () {
          imagePreview.src = reader.result;
          //imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        //imagePreview.style.display = 'none';
      }
    });
    
    
    
</script>


<script>
    function showPassword() {
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
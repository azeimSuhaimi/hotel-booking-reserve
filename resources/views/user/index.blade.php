@extends('layouts.app')
 
@section('title', 'Page Title')
@section('content')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
            <h4 class="page-title">Profile</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">
    <div class="col-lg-4">
        <div class="card ">
            <div class="card-body">
                <h4 class="header-title"></h4>
                <p class="sub-header"></p>

                <div class=" text-center justify-content-center">
                    <img src="{{asset(auth()->user()->picture)}}" alt="image"
                            class="img-fluid rounded-circle" width="120"/>
                    
                    <form id="remove_image" onsubmit="confirmAndSubmit(this)" action="{{route('user.remove.image')}}" method="post" >
                        @csrf
                        <button class="btn btn-danger rounded-pill mt-2" type="submit">Remove</button>
                    </form>

                    <h4 class="header-title mt-2">{{auth()->user()->name}}</h4>
                    <h4 class="header-title mt-2">{{auth()->user()->email}}</h4>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->


    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"></h4>
                <p class="sub-header"></p>
    
                <div class=" text-center justify-content-center">
                    <img src="{{asset(auth()->user()->picture)}}" alt="image"
                            class="img-fluid rounded-circle" id="image-preview" width="120"/>
                    


                    <form  onsubmit="confirmAndSubmit(this)" action="{{route('user.update.image')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file-input" class="form-label ">Select Files Here</label>
                            <input  class="form-control @error('file') is-invalid @enderror" name="file" id="file-input" type="file" placeholder="" />
                            @error('file')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button class="btn btn-primary rounded-pill mt-" type="submit">Save</button>
                    </form>

                </div>

                <form method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('user.update.profile')}}">
                    @csrf
                    <div class=" mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ auth()->user()->name }}">
                        @error('name')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class=" mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ auth()->user()->phone }}">
                        @error('phone')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class=" mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" value="{{ auth()->user()->address }}">
                        @error('address')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
            <!-- end card-body-->
        </div>
        <!-- end card-->
    </div>
    <!-- end col-->
</div>
<!-- end row -->


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


@endsection
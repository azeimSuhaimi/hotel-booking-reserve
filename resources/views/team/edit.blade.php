@extends('layouts.app')
 
@section('title', 'Page Title')
@section('content')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    
                    <li class="breadcrumb-item"><a href="{{route('all.team')}}">All Team</a></li>
                    <li class="breadcrumb-item active">Edit Team</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Team</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-3 header-title">Horizontal form</h4>

                <form class="form-horizontal" onsubmit="confirmAndSubmit(this)" action="{{route('update.team', ['id' => $id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-4 col-xl-3 col-form-label">Name</label>
                        <div class="col-8 col-xl-9">
                            <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $team->name }}" id="name" placeholder="Name">
                            @error('name')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="position" class="col-4 col-xl-3 col-form-label">Position</label>
                        <div class="col-8 col-xl-9">
                            <input type="position" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ $team->position }}" id="position" placeholder="Position">
                            @error('position')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="facebook" class="col-4 col-xl-3 col-form-label">Facebook</label>
                        <div class="col-8 col-xl-9">
                            <input type="facebook" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $team->facebook}}" id="facebook" placeholder="facebook">
                            @error('facebook')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        
                        <label for="file-input" class="col-4 col-xl-3 col-form-label">Select Files Here</label>

                        <div class="col-8 col-xl-9">
                            <input  class="form-control @error('file') is-invalid @enderror" name="file" id="file-input" type="file" placeholder="" />
                            @error('file')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3 justify-content-end">
                        <div class="col-8 col-xl-9">
                            <img src="{{asset($team->image)}}" alt="image"
                            class="img-fluid rounded-circle" id="image-preview" width="120"/>
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-8 col-xl-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                        </div>
                    </div>
                </form>

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>  <!-- end col -->

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
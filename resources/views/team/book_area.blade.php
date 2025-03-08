@extends('layouts.app')
 
@section('title', 'Page Title')
@section('content')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    
                    
                    <li class="breadcrumb-item active">Edit Book Area</li>
                </ol>
            </div>
            <h4 class="page-title">Edit Book Area</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-3 header-title">Horizontal form</h4>

                <form class="form-horizontal" onsubmit="confirmAndSubmit(this)" action="{{route('update.book_area', ['id' => $book_area->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="short_title" class="col-4 col-xl-3 col-form-label">Short Title</label>
                        <div class="col-8 col-xl-9">
                            <input type="name" class="form-control @error('short_title') is-invalid @enderror" name="short_title" value="{{ $book_area->short_title }}" id="short_title" placeholder="short title">
                            @error('short_title')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="main_title" class="col-4 col-xl-3 col-form-label">Main Title</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control @error('main_title') is-invalid @enderror" name="main_title" value="{{ $book_area->main_title }}" id="main_title" placeholder="main title">
                            @error('main_title')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="short_desc" class="col-4 col-xl-3 col-form-label">Short Desc</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control @error('short_desc') is-invalid @enderror" name="short_desc" value="{{ $book_area->short_desc}}" id="short_desc" placeholder="short_desc">
                            @error('short_desc')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="link_url" class="col-4 col-xl-3 col-form-label">link url</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control @error('link_url') is-invalid @enderror" name="link_url" value="{{ $book_area->link_url}}" id="link_url" placeholder="link_url">
                            @error('link_url')
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
                            <img src="{{asset($book_area->image)}}" alt="image"
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
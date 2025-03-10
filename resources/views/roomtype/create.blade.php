@extends('layouts.app')
 
@section('title', 'Page Title')
@section('content')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    
                    <li class="breadcrumb-item"><a href="{{route('all.team')}}">All room type</a></li>
                    <li class="breadcrumb-item active">Add Room type</li>
                </ol>
            </div>
            <h4 class="page-title">Add Room Type</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-3 header-title">Horizontal form</h4>

                <form class="form-horizontal" onsubmit="confirmAndSubmit(this)" action="{{route('store.roomtype')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-4 col-xl-3 col-form-label">Name</label>
                        <div class="col-8 col-xl-9">
                            <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Name">
                            @error('name')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
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




@endsection
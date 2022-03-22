@extends('layouts.finder_app')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Categories</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Categories</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<section class="content">
  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body pb-0">


      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Category Update</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('categories.update', $category->id) }}" data-parsley-validate novalidate enctype="multipart/form-data">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="card-body">
            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
              @if($errors->has('name'))
                <span class="text-danger"><small>{{$errors->first('name')}}</small>
                  @endif
            </div>
            <div class="form-group">
              <label for="description">Category Description</label>
              <textarea class="form-control" rows="3" id="description" name="description">{{$category->description}}</textarea>
              @if($errors->has('description'))
                <span class="text-danger"><small>{{$errors->first('description')}}</small>
                  @endif
            </div>
            <div class="form-group" style="size: 200 200;">
              <img src='{{asset($category->image)}}' class="img-circle img-fluid" style="width: 10%;height: 10%;">
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Category Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                @if($errors->has('image'))
                  <span class="text-danger"><small>{{$errors->first('image')}}</small></span>
                  @endif
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>





    </div>
  </div>
</section>


@endsection
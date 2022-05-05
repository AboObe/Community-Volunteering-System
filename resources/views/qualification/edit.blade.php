@extends('layouts.community_volunteering_app')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Qualifications</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Qualifications</li>
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
          <h3 class="card-title">Qualification Update</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('qualifications.update', $qualification->id) }}" data-parsley-validate novalidate enctype="multipart/form-data">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="card-body">
            <div class="form-group">
              <label for="name">Qualification Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{$qualification->name}}">
              @if($errors->has('name'))
                <span class="text-danger"><small>{{$errors->first('name')}}</small>
                  @endif
            </div>
            <div class="form-group">
              <label for="description">Qualification Description</label>
              <textarea class="form-control" rows="3" id="description" name="description">{{$qualification->description}}</textarea>
              @if($errors->has('description'))
                <span class="text-danger"><small>{{$errors->first('description')}}</small>
                  @endif
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
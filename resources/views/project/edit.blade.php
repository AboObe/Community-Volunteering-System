@extends('layouts.community_volunteering_app')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Projects</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Projects</li>
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
          <h3 class="card-title">Project Update</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('projects.update', $project->id) }}" data-parsley-validate novalidate enctype="multipart/form-data">
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="card-body">
            <div class="form-group">
              <label for="name">Project Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{$project->name}}">
              @if($errors->has('name'))
                <span class="text-danger"><small>{{$errors->first('name')}}</small>
                  @endif
            </div>
            <div class="form-group">
              <label for="owner">Project Owner</label>
              <input type="text" class="form-control" id="owner" name="owner" value="{{$project->owner}}">
              @if($errors->has('owner'))
                <span class="text-danger"><small>{{$errors->first('owner')}}</small>
                  @endif
            </div>
            <div class="form-group">
              <label for="description">Project Description</label>
              <textarea class="form-control" rows="3" id="description" name="description">{{$project->description}}</textarea>
              @if($errors->has('description'))
                <span class="text-danger"><small>{{$errors->first('description')}}</small>
                  @endif
            </div>

            <div class="form-group">
              <label for="start_date">Start Date</label>
              <input type="date" class="form-control" id="start_date" name="start_date" value="{{$project->start_date}}">
              @if($errors->has('start_date'))
                <span class="text-danger"><small>{{$errors->first('start_date')}}</small>
                  @endif
            </div>

            <div class="form-group">
              <label for="period">Project Peroid</label>
              <input type="number" class="form-control" id="period" name="period" value="{{$project->period}}" min="1">
              @if($errors->has('period'))
                <span class="text-danger"><small>{{$errors->first('period')}}</small>
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
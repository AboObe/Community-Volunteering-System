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
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>



<section class="content">
  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body pb-0">
      <div class="row">

        <!-- Create New project-->
        @role('Admin')
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">

            <form method="POST" action="{{ route('projects.store') }}" data-parsley-validate novalidate enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="card-header text-muted border-bottom-0">
                New Project
              </div>
              <div class="card-body">
                <input class="form-control" type="text" placeholder="Project Name" id="name" name="name">
                @if($errors->has('name'))
                <span class="text-danger"><small>{{$errors->first('name')}}</small>
                  @endif
                </span>
                <input class="form-control" type="text" placeholder="Owner Name" id="owner" name="owner">
                @if($errors->has('owner'))
                <span class="text-danger"><small>{{$errors->first('owner')}}</small>
                  @endif
                </span>
                <textarea class="form-control" rows="3" placeholder="Project Description" id="description" name="description"></textarea>
                @if($errors->has('description'))
                <span class="text-danger"><small>{{$errors->first('description')}}</small>
                  @endif
                </span>

                <div class="row">
                  <div class="col-6">
                    <input class="form-control" type="date" placeholder="Start Date" id="start_date" name="start_date">
                    @if($errors->has('start_date'))
                    <span class="text-danger"><small>{{$errors->first('start_date')}}</small>
                      @endif
                    </span>
                  </div>
                  <div class="col-6">
                    <input class="form-control" type="number" placeholder="Period" id="period" name="period" min="1">
                    @if($errors->has('period'))
                    <span class="text-danger"><small>{{$errors->first('period')}}</small>
                      @endif
                    </span>
                  </div>
                </div>
                <div class="text-right">
                  <button class="btn btn-sm btn-primary" type="submit">
                    <i class="fas fa-save"> ADD </i>
                  </button>
                </div>
              </div>
          </div>
          </form>
        </div>
        @endrole
        <!-- End Create New project-->


        <!-- List Of project-->

        @foreach($projects as $project)
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
              <h2 class="lead"><b>{{$project->name}}</b></h2>
            </div>
            <div class="card-body pt-0">
              <input class="form-control" type="text" value="{{$project->owner}}" readonly>
              <textarea class="form-control" rows="3" readonly>
              {{$project->description}}
              </textarea>
              <input class="form-control" value="{{$project->start_date}}" readonly>
              <input class="form-control" value="{{$project->period}}" readonly>


              <div class="text-right">
                <form method="POST" action="{{ route('projects.destroy', $project->id) }}" onsubmit="return confirm('Are you sure?')">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  @role('Admin')
                  <a class="btn btn-info btn-sm" href="{{ route('projects.edit', $project->id) }}">
                    <i class="fas fa-pencil-alt"></i>Edit </a>
                  @if(sizeof($project->announcements) < 1 ) <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                    </i>Delete
                    </button>
                    @endif
                    @endrole
                </form>
                @if(sizeof($project->announcements) > 0 )
                <form method="POST" action="{{ route('announcements.search') }}" data-parsley-validate enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input name="project_id" value="{{$project->id}}" hidden />
                  <button type="submit" class="btn-sm btn btn-primary"><i class="fas fa-folder"></i>View Announcements</button>

                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    <!-- End List Of project-->
  </div>
  </div>
  </div>
</section>

@endsection
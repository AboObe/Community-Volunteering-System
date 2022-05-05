@extends('layouts.community_volunteering_app')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <form method="POST" action="{{ route('announcements.search') }}" data-parsley-validate enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row mb-12">
        <div class="col-sm-2">
          <label for="name">Name</label>
          <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name">
        </div>
        <div class="col-sm-2">
          <label>Project</label>
          <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="project_id" name="project_id">
            <option></option>
            @foreach($projects as $project)
            <option value={{$project->id}}>{{$project->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-2">
          <label>Status</label>
          <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="status" name="status">
            <option></option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <div class="col-sm-2">
          <label for="address">Address</label>
          <input type="text" class="form-control form-control-border" id="address" name="address" placeholder="Address">
        </div>
        <div class="col-sm-2">
          <label for="description">Description</label>
          <input type="text" class="form-control form-control-border" id="description" name="description" placeholder="Description">
        </div>
        <div class="col-sm-2">
          <a class="form-control btn btn-success" href="{{ route('announcements.create')}}">
            <i class="fas fa-save"> </i>
            Add New Announcement
          </a>
          <br>
          <button type="submit" class="form-control btn btn-primary">Search</button>
        </div>
    </form>
  </div><!-- /.container-fluid -->
</section>



<section class="content">
  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body pb-0">
      <div class="row">
        <!-- List Of announcement-->

        @foreach($announcements as $announcement)
        @role('Admin')
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
              <h2 class="lead"><b>{{$announcement->name}}</b></h2>

            </div>
            <div class="card-body pt-0">
              <div class="row">
                <h3>{{$announcement->project->name}}</h3>

                <div class="col-12">
                  Address : {{$announcement->address}}
                </div>
                <div class="col-12">
                  Description : {{$announcement->description}}
                </div>
                <div class="col-12">
                  Status : {{$announcement->status}}
                </div>

              </div>
            </div>
            <div class="text-right">
              <form method="POST" action="{{ route('announcements.destroy', $announcement->id) }}" onsubmit="return confirm('Are you sure?')">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <a class="btn btn-info btn-sm" href="{{ route('announcements.edit', $announcement->id) }}">
                  <i class="fas fa-pencil-alt"></i>Edit </a>

                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                  </i>Delete
                </button>

              </form>
            </div>
          </div>
        </div>
      
      @endrole

      @role('Normal')
      @if($announcement->status == "active")
      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-header text-muted border-bottom-0">
            <h2 class="lead"><b>{{$announcement->name}}</b></h2>

          </div>
          <div class="card-body pt-0">
            <div class="row">
              <h3>{{$announcement->project->name}}</h3>

              <div class="col-12">
                Address : {{$announcement->address}}
              </div>
              <div class="col-12">
                Description : {{$announcement->description}}
              </div>
              <div class="col-12">
                Status : {{$announcement->status}}
              </div>

            </div>
          </div>
          <div class="text-right">
          @if(!in_array($announcement->id, $userAnnouncements))
           <form method="POST" action="{{ route('userAnnouncements.store') }}" data-parsley-validate novalidate enctype="multipart/form-data">
              {{ csrf_field() }}
                <input hidden  id="announcement_id" name="announcement_id" value="{{$announcement->id}}">
              
              <button type="submit" class="btn btn-primary">Apply</button>
            </form>
          @endif

          </div>
        </div>
      </div>
      @endif
      @endrole
    @endforeach
    <!-- End List Of announcement-->
  </div>
  </div>
  </div>
</section>

@endsection
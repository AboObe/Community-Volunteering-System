@extends('layouts.community_volunteering_app')
@section('content')
 

<!-- Page specific script -->

<div class="card">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Items</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Items</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.card-header -->
    <div class="card-body">
    <form method="POST" action="{{ route('announcements.update',$announcement->id) }}" data-parsley-validate enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">            
   
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name" value="{{$announcement->name}}">
                        @if($errors->has('name'))
                        <span class="text-danger"><small>{{$errors->first('name')}}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label>Project</label>
                        <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="project_id" name="project_id">
                            @foreach($projects as $project)
                            <option value={{$project->id}} {{$project->id == $announcement->project->id ? "selected":""}}>{{$project->name}}</option>
                            @endforeach 
                        </select>
                        @if($errors->has('project_id'))
                        <span class="text-danger"><small>{{$errors->first('project_id')}}</small>
                            @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="hours">Hours<sub>In Week</sub></label>
                            <input type="number" class="form-control form-control-border" id="hours" name="hours" placeholder="Hours" min="1" value="{{$announcement->hours}}">
                            @if($errors->has('hours'))
                            <span class="text-danger"><small>{{$errors->first('hours')}}</small>
                                @endif
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Status</label>
                            <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="status" name="status">
                                <option value="active" {{$announcement->status == "active" ? "selected" : ""}}>Active</option>
                                <option value="inactive" {{$announcement->status == "inactive" ? "selected" : ""}}>Inactive</option>
                            </select>
                            @if($errors->has('status'))
                            <span class="text-danger"><small>{{$errors->first('status')}}</small>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control form-control-border" id="address" name="address" placeholder="address" value="{{$announcement->address}}">
                        @if($errors->has('address'))
                        <span class="text-danger"><small>{{$errors->first('address')}}</small>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control form-control-border" id="description" name="description" placeholder="description">{{$announcement->description}}</textarea>
                    </div>

                    <div class="card-footer  text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    <!-- /.card-body -->
</div>



@endsection
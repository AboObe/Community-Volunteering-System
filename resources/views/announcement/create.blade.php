@extends('layouts.community_volunteering_app')
@section('content')


<!-- Page specific script -->

<div class="card">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Announcements</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.card-header -->
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Announcement</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('announcements.store') }}" data-parsley-validate enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name">
                        @if($errors->has('name'))
                        <span class="text-danger"><small>{{$errors->first('name')}}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label>Project</label>
                        <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="project_id" name="project_id">
                            @foreach($projects as $project)
                            <option value={{$project->id}}>{{$project->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('project_id'))
                        <span class="text-danger"><small>{{$errors->first('project_id')}}</small>
                            @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="hours">Hours<sub>In Week</sub></label>
                            <input type="number" class="form-control form-control-border" id="hours" name="hours" placeholder="Hours" min="1">
                            @if($errors->has('hours'))
                            <span class="text-danger"><small>{{$errors->first('hours')}}</small>
                                @endif
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Status</label>
                            <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @if($errors->has('status'))
                            <span class="text-danger"><small>{{$errors->first('status')}}</small>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control form-control-border" id="address" name="address" placeholder="address">
                        @if($errors->has('address'))
                        <span class="text-danger"><small>{{$errors->first('address')}}</small>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control form-control-border" id="description" name="description" placeholder="description"></textarea>
                    </div>

                    <div class="card-footer  text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card-body -->
</div>



@endsection
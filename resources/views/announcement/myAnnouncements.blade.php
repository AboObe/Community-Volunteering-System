@extends('layouts.community_volunteering_app')
@section('content')


<!-- Page specific script -->

<div class="card">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Announcements</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Announcement</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Announcements Applied</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('userAnnouncements.update', $user->id) }}" data-parsley-validate novalidate enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-border" id="user_id" name="user_id" value={{$user->id}} hidden>
                        <input type="text" class="form-control form-control-border" id="name" name="name" value={{auth()->user()->name}} >
                        @if($errors->has('name'))
                        <span class="text-danger"><small>{{$errors->first('name')}}</small>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="name">Announcements</label>
                    </div>
                    <div class="row">

                        @foreach($announcements as $announcement)
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="announcement[{{$announcement->id}}]" name="announcement[{{$announcement->id}}]" value="{{$announcement->id}}" {{in_array($announcement->id, $userAnnouncements) ? "checked" : ""}} Readonly>
                                    <label for="announcement[{{$announcement->id}}]" class="custom-control-label">{{$announcement->name}}</label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($errors->has('announcement'))
                        <span class="text-danger"><small>{{$errors->first('announcement')}}</small>
                            @endif
                    </div>
                    <div class="card-footer">
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
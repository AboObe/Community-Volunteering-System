@extends('layouts.finder_app')
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
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.card-header -->
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}" data-parsley-validate novalidate enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name" value={{$user->name}}>
                        @if($errors->has('name'))
                        <span class="text-danger"><small>{{$errors->first('name')}}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-border" id="email" name="email" placeholder="email" value={{$user->email}}>
                        @if($errors->has('email'))
                        <span class="text-danger"><small>{{$errors->first('email')}}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-border" id="password" name="password" placeholder="password">
                        @if($errors->has('password'))
                        <span class="text-danger"><small>{{$errors->first('password')}}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control form-control-border" id="city" name="city" placeholder="city" value={{$user->city}}>
                        @if($errors->has('city'))
                        <span class="text-danger"><small>{{$errors->first('city')}}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone <small>973 XXXX XXXX</small>:</label>
                        <input type="text" class="form-control form-control-border" id="phone" name="phone" placeholder="phone" value={{$user->phone}}>
                        @if($errors->has('phone'))
                        <span class="text-danger"><small>{{$errors->first('phone')}}</small>
                            @endif
                    </div>



                    <div class="form-group">
                        <label>Role </label>
                        <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" name="role" id="role">

                            @foreach($roles as $role)
                            <option value={{$role}} {{$userRole->name == $role?"selected" :""}}>{{$role}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample" style="opacity: 1; transform: scale(1) translate3d(0px, 0px, 0px); backface-visibility: hidden; perspective: 1000px; transform-style: preserve-3d; position: absolute; width: 114.5px; transition: all 0.5s ease-out 0ms, width 1ms ease 0s;">
                            <a href="{{asset($user->image)}}" data-toggle="lightbox" data-title="sample 1 - white" target="_blank">
                                <img src="{{asset($user->image)}}" class="img-fluid mb-2" alt="white sample">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <label for="image">Profile Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        @if($errors->has('image'))
                        <span class="text-danger"><small>{{$errors->first('image')}}</small>
                            @endif
                    </div>
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
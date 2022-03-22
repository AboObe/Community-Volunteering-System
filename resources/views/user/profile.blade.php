@extends('layouts.finder_app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<section class="content ">
    <!-- Default box -->
    <div class="card-body card">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{asset($user->image)}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">{{$user->email}}</p>
                <form method="POST" action="{{ route('users.update', Auth::user()->id) }}" data-parsley-validate novalidate enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Name</b>
                            <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name" value={{$user->name}}>
                            @if($errors->has('name'))
                            <span class="text-danger"><small>{{$errors->first('name')}}</small>
                                @endif

                                <b>Email</b>
                                <input type="email" class="form-control form-control-border" id="email" name="email" placeholder="email" value={{$user->email}}>
                                @if($errors->has('email'))
                                <span class="text-danger"><small>{{$errors->first('email')}}</small>
                                    @endif

                                    <b>Password</b>
                                    <input type="password" class="form-control form-control-border" id="password" name="password" placeholder="password">
                                    @if($errors->has('password'))
                                    <span class="text-danger"><small>{{$errors->first('password')}}</small>
                                        @endif
                                        <b>City</b>
                                        <input type="text" class="form-control form-control-border" id="city" name="city" placeholder="city" value={{$user->city}}>
                                        @if($errors->has('city'))
                                        <span class="text-danger"><small>{{$errors->first('city')}}</small>
                                            @endif

                                            <b>Phone <small>973 XXXX XXXX</small>:</b>
                                            <input type="text" class="form-control form-control-border" id="phone" name="phone" placeholder="phone" value={{$user->phone}}>
                                            @if($errors->has('phone'))
                                            <span class="text-danger"><small>{{$errors->first('phone')}}</small>
                                                @endif
                                                @role("Admin")
                                                <b>Role</b>
                                                <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" name="role" id="role">

                                                    @foreach($roles as $role)
                                                    <option value={{$role}} {{$userRole->name == $role?"selected" :""}}>{{$role}}</option>
                                                    @endforeach
                                                </select>
                                                @endrole
                                                
                                                @role("Normal")
                                                <b>Role</b>
                                                <input type="text" class="form-control form-control-border" value="{{$userRole->name}}" Readonly>
                                                @endrole

                                                <b>Profile Photo</b>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image">
                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                                @if($errors->has('image'))
                                                <span class="text-danger"><small>{{$errors->first('image')}}</small>
                                                    @endif
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-primary btn-block"><b>Submit</b></button>
                </form>
                <form method="POST" action="{{ route('items.myItems') }}" data-parsley-validate enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input name="user_id" value="{{$user->id}}" hidden />
                  <br>
                  <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-folder"></i>View Items</button>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</section>

@endsection
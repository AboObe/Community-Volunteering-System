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
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.card-header -->
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
                <form method="POST" action="{{ route('users.update', $user->id) }}" data-parsley-validate novalidate enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="row">
                        <div class="col-sm-6">
                            <b>Name</b>
                            <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name" value="{{$user->name}}">
                            @if($errors->has('name'))
                            <span class="text-danger"><small>{{$errors->first('name')}}</small></span>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <b>Phone:</b>
                                <input type="text" class="form-control form-control-border" id="phone" name="phone" placeholder="phone" value="{{$user->phone}}">
                                @if($errors->has('phone'))
                                <span class="text-danger"><small>{{$errors->first('phone')}}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <b>Email</b>
                                <input type="email" class="form-control form-control-border" id="email" name="email" placeholder="email" value="{{$user->email}}">
                                @if($errors->has('email'))
                                <span class="text-danger"><small>{{$errors->first('email')}}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <b>Password</b>
                                <input type="password" class="form-control form-control-border" id="password" name="password" placeholder="password">
                                @if($errors->has('password'))
                                <span class="text-danger"><small>{{$errors->first('password')}}</small></span>
                                @endif
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <b>City</b>
                                <input type="text" class="form-control form-control-border" id="city" name="city" placeholder="city" value="{{$user->city}}">
                                @if($errors->has('city'))
                                <span class="text-danger"><small>{{$errors->first('city')}}</small></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <b>Address</b>
                                <input type="text" class="form-control form-control-border" id="address" name="address" placeholder="address" value="{{$user->address}}">
                                @if($errors->has('address'))
                                <span class="text-danger"><small>{{$errors->first('address')}}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <b>Birthday</b>
                                <input type="date" class="form-control form-control-border" id="birthday" name="birthday" placeholder="address" value="{{$user->birthday}}">
                                @if($errors->has('birthday'))
                                <span class="text-danger"><small>{{$errors->first('birthday')}}</small></span>
                                @endif
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
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
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                @role("Admin")
                                <b>Status</b>
                                <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" name="status" id="status">


                                    <option value='active' {{$user->status == "active"?"selected" :""}}>Active</option>
                                    <option value='inactive' {{$user->status == "inactive"?"selected" :""}}>Inactive</option>

                                </select>
                                @endrole

                                @role("Normal")
                                <b>Status</b>
                                <input type="text" class="form-control form-control-border" value="{{$user->status}}" Readonly>
                                @endrole
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                @role("Admin")
                                <b>Gender</b>
                                <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" name="gender" id="gender">


                                    <option value='male' {{$user->gender == "male"?"selected" :""}}>Male</option>
                                    <option value='female' {{$user->gender == "female"?"selected" :""}}>Female</option>

                                </select>
                                @endrole

                                @role("Normal")
                                <b>Gender</b>
                                <input type="text" class="form-control form-control-border" value="{{$user->gender}}" Readonly>
                                @endrole
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">

                                <b>Profile Photo</b>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                @if($errors->has('image'))
                                <span class="text-danger"><small>{{$errors->first('image')}}</small></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">

                                <b>Current CV</b>
                                <div class="custom-file">
                                    @if($user->cv != "")
                                    <object data="test.pdf" type="application/pdf" width="300" height="200">
                                        <a href="../../{{$user->cv}}">{{$user->name}}.pdf</a>
                                    </object>
                                    @else
                                    <a>Not Exist</a>
                                    @endif
                                </div>
                                @if($errors->has('cv'))
                                <span class="text-danger"><small>{{$errors->first('cv')}}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">

                                <b>Update CV</b>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="cv" name="cv">
                                    <label class="custom-file-label" for="cv">Choose file</label>
                                </div>
                                @if($errors->has('cv'))
                                <span class="text-danger"><small>{{$errors->first('cv')}}</small></span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"><b>Submit</b></button>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                            <a href="{{ route('qualifications.show', $user->id) }}" class="btn btn-primary btn-block" >Qualification</a>
        
                            </div>
                        </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
</section>
    <!-- /.card-body -->
</div>



@endsection
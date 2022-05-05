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
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('users.store') }}" data-parsley-validate enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name">
                        @if($errors->has('name'))
                        <span class="text-danger"><small>{{$errors->first('name')}}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-border" id="email" name="email" placeholder="email">
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
                        <input type="text" class="form-control form-control-border" id="city" name="city" placeholder="city">
                        @if($errors->has('city'))
                        <span class="text-danger"><small>{{$errors->first('city')}}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone :</label>
                        <input type="text" class="form-control form-control-border" id="phone" name="phone" placeholder="phone">
                        @if($errors->has('phone'))
                        <span class="text-danger"><small>{{$errors->first('phone')}}</small>
                            @endif
                    </div>



                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="role" name="role"> 
                        
                        @foreach($roles as $role)    
                            <option  value={{$role->id}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>





                    <div class="form-group">
                        <label for="image">Profile Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        @if($errors->has('image'))
                        <span class="text-danger"><small>{{$errors->first('image')}}</small>
                            @endif
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
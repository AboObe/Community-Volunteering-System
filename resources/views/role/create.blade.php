@extends('layouts.finder_app')
@section('content')


<!-- Page specific script -->

<div class="card">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Role</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name">
                    @if($errors->has('name'))
                    <span class="text-danger"><small>{{$errors->first('name')}}</small>
                        @endif
                </div>

                <div class="form-group">
                    <label for="name">Permission</label>
                </div>
                <div class="row">

                    @foreach($permissions as $permission)
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="permission[{{$permission->id}}]" name="permission[{{$permission->id}}]" value="{{$permission->id}}">
                                <label for="permission[{{$permission->id}}]" class="custom-control-label">{{$permission->name}}</label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($errors->has('permission'))
                    <span class="text-danger"><small>{{$errors->first('permission')}}</small>
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
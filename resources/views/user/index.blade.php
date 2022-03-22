@extends('layouts.finder_app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                    <li class="breadcrumb-item "></li>
                    <li>
                        <a class="btn btn-primary " href="{{ route('users.create')}}">
                            <i class="fas fa-save"> </i>
                            Add New User
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<section class="content ">
    <!-- Default box -->
    <div class="card-body card">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name</th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Email</th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Phone</th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">City</th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Status</th>

                                <th aria-label="Browser">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="odd">
                                <td>
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="{{asset($user->image)}}" style="width: 40px;height: 40px;border-radius: 50%;">
                                    </li>
                                </td>
                                <td class="dtr-control sorting_1" tabindex="0">{{$user->name}}</td>
                                <td class="dtr-control sorting_1" tabindex="0">{{$user->email}}</td>
                                <td class="dtr-control sorting_1" tabindex="0">{{$user->phone}}</td>
                                <td class="dtr-control sorting_1" tabindex="0">{{$user->city}}</td>
                                <td class="dtr-control sorting_1" tabindex="0">
                                    @if($user->status == "active")
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger ">Inactive</span>
                                    @endif

                                </td>
                                <td class="project-actions text-center">

                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <a class="btn btn-info btn-sm" href="{{ route('users.edit', $user->id) }}">
                                            <i class="fas fa-pencil-alt"></i> Edit </a>
                                        {{$user->hasUser}}
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                                            </i>Delete
                                        </button>
                                    </form>





                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th rowspan="1" colspan="1">Name</th>
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Phone</th>
                                <th rowspan="1" colspan="1">City</th>
                                <th rowspan="1" colspan="1">Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
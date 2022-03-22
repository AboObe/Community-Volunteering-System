@extends('layouts.finder_app')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <form method="POST" action="{{ route('items.search') }}" data-parsley-validate enctype="multipart/form-data">
                    {{ csrf_field() }}
      <div class="row mb-12">
        <div class="col-sm-2">
          <label for="name">Name</label>
          <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name">
        </div>
        <div class="col-sm-2">
          <label>Category</label>
          <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="category_id" name="category_id">
            <option></option>
            @foreach($categories as $category)
            <option value={{$category->id}}>{{$category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-2">
          <label>Type</label>
          <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="type" name="type">
            <option></option>
            <option value="missing">Missing</option>
            <option value="existent">Existent</option>
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
          <label for="location">Location</label>
          <input type="text" class="form-control form-control-border" id="location" name="location" placeholder="location">
        </div>
        <div class="col-sm-2">
        <a class="form-control btn btn-success" href="{{ route('users.create')}}">
                            <i class="fas fa-save"> </i>
                            Add New User
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
        <!-- List Of item-->

        @foreach($items as $item)
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
              <h2 class="lead"><b>{{$item->name}}</b></h2>

            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-7">
                  <h3>{{$item->category->name}}</h3>
                  <div class="col-12">
                    {{$item->type}} / {{$item->status}} / {{$item->date_item}}
                  </div>
                  <div class="col-12">
                    {{$item->location}}
                  </div>
                  <div class="col-12">
                    {{$item->description}}
                  </div>

                </div>
                <div class="col-5 text-center">
                  <img src="{{asset($item->image)}}" class="img-circle img-fluid">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-right">
                @role('Normal')
                <a class="btn  btn-success btn-sm" href="https://wa.me/{{$item->user->phone}}" target="_blank">
                  <i class="fab fa-whatsapp fa-fw"></i> </a>
                @endrole
                @role('Admin')
                <form method="POST" action="{{ route('items.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?')">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <a class="btn  btn-success btn-sm" href="https://wa.me/{{$item->user->phone}}" target="_blank">
                    <i class="fab fa-whatsapp fa-fw"></i> </a>
                  <a class="btn btn-info btn-sm" href="{{ route('items.edit', $item->id) }}">
                    <i class="fas fa-pencil-alt"></i>Edit </a>

                  <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                    </i>Delete
                  </button>

                </form>
                @endrole
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <!-- End List Of item-->
      </div>
    </div>
  </div>
</section>

@endsection
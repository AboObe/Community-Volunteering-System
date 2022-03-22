@extends('layouts.finder_app')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Categories</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Categories</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>



<section class="content">
  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body pb-0">
      <div class="row">

        <!-- Create New Category-->
        @role('Admin')
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">

            <form method="POST" action="{{ route('categories.store') }}" data-parsley-validate novalidate enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="card-header text-muted border-bottom-0">
                New Category
              </div>
              <div class="card-header text-muted border-bottom-0">
                <input class="form-control" type="text" placeholder="Category Name" id="name" name="name">
                @if($errors->has('name'))
                <span class="text-danger"><small>{{$errors->first('name')}}</small>
                  @endif
              </div>

              <div class="card-header text-muted border-bottom-0">
                <textarea class="form-control" rows="3" placeholder="Category Description" id="description" name="description"></textarea>
                @if($errors->has('description'))
                <span class="text-danger"><small>{{$errors->first('description')}}</small>
                  @endif
              </div>
              <div class="card-header text-muted border-bottom-0">
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Category Image</label>
                  </div>
                  @if($errors->has('image'))
                  <span class="text-danger"><small>{{$errors->first('image')}}</small></span>
                  @endif
                </div>
              </div>

              <div class="card-footer">
                <div class="text-right">
                  <button class="btn btn-sm btn-primary" type="submit">
                    <i class="fas fa-save"> ADD </i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        @endrole
        <!-- End Create New Category-->


        <!-- List Of Category-->

        @foreach($categories as $category)
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
              <h2 class="lead"><b>{{$category->name}}</b></h2>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-7">
                  {{$category->description}}
                </div>
                <div class="col-5 text-center">
                  <img src="{{asset($category->image)}}" class="img-circle img-fluid">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-right">
                <form method="POST" action="{{ route('categories.destroy', $category->id) }}" onsubmit="return confirm('Are you sure?')">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  @role('Admin')
                  <a class="btn btn-info btn-sm" href="{{ route('categories.edit', $category->id) }}">
                    <i class="fas fa-pencil-alt"></i>Edit </a>
                  @if(sizeof($category->items) < 1 ) <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                    </i>Delete
                    </button>
                    @endif
                    @endrole
                </form>
                @if(sizeof($category->items) > 0 )
                <form method="POST" action="{{ route('items.search') }}" data-parsley-validate enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input name="category_id" value="{{$category->id}}" hidden />
                  <button type="submit" class="btn-sm btn btn-primary"><i class="fas fa-folder"></i>View Items</button>

                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <!-- End List Of Category-->
      </div>
    </div>
  </div>
</section>

@endsection
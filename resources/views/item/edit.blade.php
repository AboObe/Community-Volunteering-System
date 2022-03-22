@extends('layouts.finder_app')
@section('content')


<!-- Page specific script -->

<div class="card">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Items</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Items</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.card-header -->
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Item</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('items.update',$item->id) }}" data-parsley-validate enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="name" value="{{$item->name}}">
                        @if($errors->has('name'))
                        <span class="text-danger"><small>{{$errors->first('name')}}</small>
                            @endif
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="category_id" name="category_id">
                            @foreach($categories as $category)
                            <option value={{$category->id}} {{$category->id == $item->category->id ? "selected":""}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category_id'))
                        <span class="text-danger"><small>{{$errors->first('category_id')}}</small>
                            @endif
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-sm-6">
                            <label>Type</label>
                            <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="type" name="type">
                                <option value="missing" {{$item->type == "missing" ? "selected" : ""}}>Missing</option>
                                <option value="existent" {{$item->type == "existent" ? "selected" : ""}}>Existent</option>
                            </select>
                            @if($errors->has('type'))
                            <span class="text-danger"><small>{{$errors->first('type')}}</small>
                                @endif
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Status</label>
                            <select class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true" id="status" name="status">
                                <option value="active" {{$item->status == "active" ? "selected" : ""}}>Active</option>
                                <option value="inactive" {{$item->status == "inactive" ? "selected" : ""}}>Inactive</option>
                            </select>
                            @if($errors->has('status'))
                            <span class="text-danger"><small>{{$errors->first('status')}}</small>
                                @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group  col-sm-6">
                            <label for="location">Location</label>
                            <input type="text" class="form-control form-control-border" id="location" name="location" placeholder="location" value="{{$item->location}}">
                            @if($errors->has('location'))
                            <span class="text-danger"><small>{{$errors->first('location')}}</small>
                                @endif
                        </div>

                        <div class="form-group  col-sm-6">
                            <label>Date and time:</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="datetime-local" class="form-control datetimepicker-input" data-target="#reservationdatetime" id="date_item" name="date_item" value="{{date('Y-m-d', strtotime($item->date_item)).'T'.date('H:i:s', strtotime($item->date_item))}}">

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control form-control-border" id="description" name="description" placeholder="description">{{$item->description}}</textarea>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample" style="opacity: 1; transform: scale(1) translate3d(0px, 0px, 0px); backface-visibility: hidden; perspective: 1000px; transform-style: preserve-3d; position: absolute; width: 114.5px; transition: all 0.5s ease-out 0ms, width 1ms ease 0s;">
                                <a href="{{asset($item->image)}}" data-toggle="lightbox" data-title="sample 1 - white" target="_blank">
                                    <img src="{{asset($item->image)}}" class="img-fluid mb-2" alt="white sample">
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="image">Image</label>
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
@extends('layouts.finder_app')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    
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
                
                <form method="POST" action="{{ route('items.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?')">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                  <a class="btn btn-info btn-sm" href="{{ route('items.edit', $item->id) }}">
                    <i class="fas fa-pencil-alt"></i>Edit </a>

                  <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                    </i>Delete
                  </button>

                </form>
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
@extends('layouts.community_volunteering_app')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Qualifications</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Qualifications</li>
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

        <!-- Create New Qualification-->
        @role('Admin')
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">

            <form method="POST" action="{{ route('qualifications.store') }}" data-parsley-validate novalidate enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="card-header text-muted border-bottom-0">
                New Qualification
              </div>
              <div class="card-body">
                <input class="form-control" type="text" placeholder="Qualification Name" id="name" name="name">
                @if($errors->has('name'))
                <span class="text-danger"><small>{{$errors->first('name')}}</small>
                  @endif
                </span>
                <textarea class="form-control" rows="3" placeholder="Qualification Description" id="description" name="description"></textarea>
                @if($errors->has('description'))
                <span class="text-danger"><small>{{$errors->first('description')}}</small>
                  @endif
                </span>
                <div class="text-right">
                  <button class="btn btn-sm btn-primary" type="submit">
                    <i class="fas fa-save"> ADD </i>
                  </button>
                </div>
              </div>
          </div>
          </form>
        </div>
        @endrole
        <!-- End Create New Qualification-->


        <!-- List Of Qualification-->

        @foreach($qualifications as $qualification)
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
            Qualification
            </div>
            <div class="card-body text-right">
                <form method="POST" action="{{ route('qualifications.destroy', $qualification->id) }}" onsubmit="return confirm('Are you sure?')">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input class="form-control" value="{{$qualification->name}}" readonly>
                  <textarea class="form-control" rows="3" readonly>
              {{$qualification->description}}
              </textarea>
                  @role('Admin')
                  <a class="btn btn-info btn-sm" href="{{ route('qualifications.edit', $qualification->id) }}">
                    <i class="fas fa-pencil-alt"></i>Edit </a>
                  @if(sizeof($qualification->announcements) < 1 || sizeof($qualification->volunteers) < 1 ) <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                    </i>Delete
                    </button>
                    @endif
                    @endrole
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    <!-- End List Of Qualification-->
  </div>
  </div>
  </div>
</section>

@endsection
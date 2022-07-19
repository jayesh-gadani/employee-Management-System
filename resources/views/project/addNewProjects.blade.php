@extends('layout')
@section('pageTitle','Add new Project')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{isset($project->id)?'Update Project':'Add Project'}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{'/home'}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('add_project')}}">Project</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
               @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                  {{ Session::get('success') }}
                </div>
              @endif
              @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                  {{ Session::get('error') }}
                </div>
              @endif
              <div class="card-header">
                <h3 class="card-title">Project Detail<small></small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
            <form action="" id="quickForm" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label><span class='text-danger'>*</span>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title"  value="{{ old('title') ? old('title') : $project->title}}">
                    @error('title')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
          
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label><span class='text-danger'>*</span>
                    <textarea  name="description" class="form-control" id="exampleInputEmail1">{{ old('description') ? old('description') : $project->description}}</textarea>
                    @error('description')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
                  
                   <div class="row">
          <div class="col-md-6">

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Start Date:</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Date:</label><span class='text-danger'>*</span>

                  <div class="input-group date"  data-target-input="nearest">
                        <input type="date" name="startDate" class="form-control" value="{{old('startDate') ? old('startDate') : $project->start_date}}" data-target="#reservationdate" />
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    @error('startDate')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  <!-- /.input group -->
                </div>
               

              </div>
              
            </div>
            
          </div>
          <!-- /.col (left) -->
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">End Date:</h3>
              </div>
              <div class="card-body">
                <!-- Date -->
                <div class="form-group">
                  <label>Date:</label><span class='text-danger'>*</span>
                    <div class="input-group date" data-target-input="nearest">
                        <input type="date" name="endDate" class="form-control" value="{{old('endDate') ? old('endDate') : $project->end_date}}">
                        
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    @error('endDate')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>
               
              </div>
                
           
            </div>
           
          </div>
          <!-- /.col (right) -->
        </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{isset($project->id)?'Update':'Submit'}}</button>
                  <a href='{{route('listing_project')}}' class="btn btn-primary">cancel</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  
@endsection

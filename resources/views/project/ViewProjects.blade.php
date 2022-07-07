@extends('layout')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listing Projects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Listing Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

            
    <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
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
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Listing</h3> <div align='right'><a class="btn btn-primary" href='{{route('add_project')}}'>Add New Project</a></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>  
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                    @foreach($projects as $project)
                  <tr>
                    <td>{{$project->title}}</td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->start_date}}</td>
                    <td>{{$project->end_date}}</td>
                    <td>
                        @if($project->status==1)
                            Active
                        @else    
                            Inactive
                        @endif    


                    </td>
                    <td><a href='{{ route('edit_project',['id' => $project->id]) }}'>Edit</a> | 
                        <a href='{{ route('delete_project',['id' => $project->id]) }}'>Delete</a>
                    </td>
                       
                  </tr>
                  
                    @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                     <th>Title</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>  
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  
  
@endsection
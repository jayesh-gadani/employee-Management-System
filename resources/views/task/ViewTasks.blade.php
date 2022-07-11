@extends('layout')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Task of Projects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Listing Task</li>
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
                <h3 class="card-title">Task Listing</h3> <div align='right'><a class="btn btn-primary" href='{{route('add_task')}}'>Add New Task</a></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>Project</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>  
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                    @foreach($tasks as $task)
                  <tr>
                    <td>{{$task->title}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->user->name}}</td>
                    <td>{{$task->project->title}}</td>
                    <td>{{$task->start_date}}</td>
                    <td>{{$task->end_date}}</td>
                    <td>
                        @if($task->status==1)
                            Active
                        @else    
                            Inactive
                        @endif    


                    </td>
                        <td>
                        <a href='{{ route('editTask',['id' => $task->id]) }}'><i class='far fa-edit'></i></a> 
                        <a href='{{ route('deleteTask',['id' => $task->id]) }}'><i class='fas fa-trash'></i></a>

                        </td>
                       
                  </tr>
                  
                    @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>Project</th>
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

            <div id="modal_load">

            </div>




        <script>
       




  
@endsection

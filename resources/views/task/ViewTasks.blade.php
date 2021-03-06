@extends('layout')
@section('pageTitle','List of task')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List task</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{'/home'}}">Home</a></li>
              <li class="breadcrumb-item active"><a href='{{route("listing_task")}}'>List task</a></li>
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
                <h3 class="card-title">Task Listing</h3> <div align='right'><a class="btn btn-primary" href='{{route('add_task')}}'>Add new task</a></div>
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
                            Scoping
                        @elseif($task->status==2)    
                            Inprogress
                        @elseif($task->status==2)    
                            Hold
                        @elseif($task->status==2)    
                            QA
                        @else
                            Done
                        @endif    


                    </td>
                        <td>
                        <a href='{{ route('editTask',['id' => $task->id]) }}'><i class='far fa-edit' title="Edit Task"></i></a> 
                       
                        <a class="confirm" href='' data-id="{{$task->id}}" data-title="{{$task->title}}"><i class='fas fa-trash' title="Delete Task"></i></a>


                        </td>
                       
                  </tr>
                  
                    @endforeach

                  </tbody>
                 
                </table>
                <br>

                {{ $tasks->links('pagination::bootstrap-4') }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div id="modal_load">

            </div>




        <script>
              $(document).ready(function()
              {
                $(document).on('click', '.confirm', function(event) {
                event.preventDefault();
                var id=$(this).data('id');;
                var title=$(this).data('title');
                var result=confirm("Are you sure you want to delete"+title+" task ?");
                if (result) {
                
                 $.ajax({
                    url : "{{ route('deleteTask') }}",
                    type: "GET",
                    data:{id:id},
                    success: function(data, textStatus, jqXHR)
                    {

                         location.reload(); 
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                 
                    }
                });

               }
               else {
                location.reload();

               }

            });
              });
        
       </script>




  
@endsection

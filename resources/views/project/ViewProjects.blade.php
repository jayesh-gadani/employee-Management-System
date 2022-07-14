@extends('layout')
@section('pageTitle','List of project')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listing projects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{'/home'}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('listing_project')}}">List project</a></li>
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
                <h3 class="card-title">User Listing</h3> <div align='right'><a class="btn btn-primary" href='{{route('add_project')}}'>Add new project</a></div>
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
                    <td>

                      <a href="{{ route('edit_project',['id' => $project->id]) }}"><i class='far fa-edit' title='Edit Project'></i></a>
                     
                       <a class='confirm' data-title="{{$project->title}}" href='' data-id="{{$project->id}}"><i class='fas fa-trash' title="Delete Project"></i></a>

                      <a class='smallButton' name="{{$project->title}}" href='' id="{{$project->id}}">Assign Project</a>
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
                <br>
                
                 {{ $projects->links('pagination::bootstrap-4') }}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div id="modal_load">

            </div>




        <script>
        // display a modal (small modal)
        $(document).ready(function()
        {
            $(document).on('click', '.smallButton', function(event) {
                event.preventDefault();
            
                /*
                var projectName=event.target.name;
                $('#projectName').text(projectName);
                var x=event.target.id;
                $('#projectId').val(x);
                */
               
                var x=event.target.id;
                $.ajax({
                    url : "{{ route('modalLoad') }}",
                    type: "GET",
                    data:{id:x},
                    success: function(data, textStatus, jqXHR)
                    {

                        $("#modal_load").html(data);
                        $('#exampleModal').modal("show");
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                 
                    }
                });
            });
              $(document).on('click', '#assign_btn', function(event){
                
               $.ajax({
                    url : "{{ route('projectAssign') }}",
                    type: "POST",
                    data : $('#form').serialize(),
                    success: function(data, textStatus, jqXHR)
                    {
                      if(data['status']=="failed")
                      {
                        $("#message").html(data['message']);
                      }
                      else
                      {
                        $('#exampleModal').modal("hide");
                        $("#modal_load").html(data['message']);
                        location.reload(); 
                      }

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                 
                    }

                });
            });

               $(document).on('click', '.confirm', function(event) {
                event.preventDefault();
                var id=$(this).data('id');
                var title=$(this).data('title');
                var result=confirm("Are you sure you want to delete"+title+" Project ?");

                if (result) {
                
                 $.ajax({
                    url : "{{ route('delete_project') }}",
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

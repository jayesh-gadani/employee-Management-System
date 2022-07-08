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
                        <a href='{{ route('delete_project',['id' => $project->id]) }}'>Delete</a>|
                        <a class='smallButton' name='{{$project->title}}' href='' id={{$project->id}}>Assign Project</a>
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


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Project To The user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="form" method='post'>
        @csrf
          <div class="form-group">
            Project Title :- <label for="recipient-name" id="projectName"></label><br>
            <label for="recipient-name" class="col-form-label">Select user To assign project:</label>
            <select class="form-control" name="userId">
                <option>--- select user ---</option>
               
                    @foreach($users as $user)
                        <option value='{{$user->id}}'>{{$user->name}}</option>
                    @endforeach
               
            </select>
          </div>
          <div class="form-group">
            
            
            <input type="hidden" id="projectId" name='projectId'>
            
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"  id="assign_btn">Assign Project</button>
        <button type="button" class="btn btn-primary" id="assign">click me</button>


      </div>
      </form>
    </div>
  </div>
</div>




        <script>
        // display a modal (small modal)
        $(document).ready(function()
        {
            $(document).on('click', '.smallButton', function(event) {
                event.preventDefault();
            
                $('#exampleModal').modal("show");
                var projectName=event.target.name;
                $('#projectName').text(projectName);
                var x=event.target.id;
                $('#projectId').val(x);
            
             });
            $("#assign").click(function(event) {
               
                $.ajax({
                    url : "{{ route('projectAssign') }}",
                    type: "POST",
                    data : $('#form').serialize(),
                    success: function(data, textStatus, jqXHR)
                    {
                        //document.write("sucess");
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                 
                    }

                });
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
  

   <div class="container mt-2">
  
        <!-- Input field to accept user input -->
        <textarea id="textarea" rows="4" 
            cols="50">
        </textarea><br>
          
        <!-- Button to invoke the modal -->
        <button type="button" 
            class="btn btn-success btn-sm" 
            data-toggle="modal" 
            data-target="#exampleModal1"
            id="submit">
            Submit
        </button>
  
        <!-- modal -->
        <div class="modal fade" id="exampleModal1" 
            tabindex="-1" 
            aria-labelledby="exampleModalLabel" 
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" 
                            id="exampleModalLabel">
                            Entered Data
                        </h5>
                          
                        <button type="button" 
                            class="close" 
                            data-dismiss="modal" 
                            aria-label="Close">
  
                            <span aria-hidden="true">
                                ×
                            </span>
                        </button>
                    </div>
  
                    <div class="modal-body">
  
                        <!-- Data passed is displayed
                            in this part of the 
                            modal body -->
                        <p id="modal_body"></p>
  
                        <button type="button" 
                            class="btn btn-warning btn-sm" 
                            data-toggle="modal"
                            data-target="#exampleModal">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <script type="text/javascript">
        $("#submit").click(function () {
            var text = $("#textarea").val();
            $("#modal_body").html(text);
        });
    </script>





  
@endsection

@extends('layout')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project</li>
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
                <h3 class="card-title">New Task<small></small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
            <form action="" id="quickForm" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title"  value="{{ old('title') ? old('title') : $tasks->title}}">
                    @error('title')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
          
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea  name="description" class="form-control" id="exampleInputEmail1">{{ old('description') ? old('description') : $tasks->description}}</textarea>
                    @error('description')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Project</label>
                    <select class="form-control" name="projectId" id="project">
               			<option>--- select user ---</option>
               			@foreach($projects as $project)

		                    <option value='{{$project->id}}'>{{$project->title}}</option>
		                @endforeach
		               
            		</select>
                    @error('projectId')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Selct User</label>
                    <div id="user_load">
	                    <select class="form-control" name="userId">
	               			<option>--- select user ---</option>
	               		</select>
            		</div>
                    @error('userId')
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
			                  <label>Date:</label>

			                  <div class="input-group date"  data-target-input="nearest">
			                        <input type="date" name="startDate" class="form-control" value="{{old('startDate') ? old('startDate') : $tasks->start_date}}" data-target="#reservationdate" />
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
		                  <label>Date:</label>
		                    <div class="input-group date" data-target-input="nearest">
		                        <input type="date" name="endDate" class="form-control"value="{{old('endDate') ? old('endDate') : $tasks->end_date}}>
		                        
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
                  <button type="submit" class="btn btn-primary">Submit</button>
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
    <script>
 		$(document).ready(function()
        {

            $(document).on('change', '#project', function(event) {
                event.preventDefault();
            
                var x=event.target.value;
               
                $.ajax({
                    url : "{{ route('userLoad') }}",
                    type: "GET",
                    data:{id:x},
                    success: function(data, textStatus, jqXHR)
                    {

                        $("#user_load").html(data);
                       
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                 
                    }
                });
            });
        });
  	</script>


@endsection

@extends('layout')
@section('pageTitle','User Listing')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listing user</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{'/home'}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('user')}}">List User</li>
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
                <h3 class="card-title"></h3> <div align='right'><a class="btn btn-primary" href='{{route('add')}}'>Add new user</a></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                    @foreach($users as $user)
                  <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->contact}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->position}}</td>
                    <td> @if($user->status==0)
                            <a href='{{ route('parmission',['id' => $user->id]) }}'>
                              <small class="badge badge-success"><i title="Approved" class="fa fa-check-circle" aria-hidden="true">Approved</i></small></a>
                        @else
                        <a href='{{ route('parmission',['id' => $user->id]) }}'>
                          <small class="badge badge-danger">
                            <i class="fa fa-times-circle" title="Parmission Disapprove" aria-hidden="true">Approval</i></small></a>
                            
                        @endif</td>
                    <td><a href='{{ route('edit',['id' => $user->id]) }}'><i class='far fa-edit' title='Edit User'></i></a> 

                        <a class="confirm" data-title="{{$user->name}}" data-id="{{$user->id}}"><i class='fas fa-trash' title="Delete User"></i></a> 

                       

                  </tr>
                  
                    @endforeach

                  </tbody>
                 
                </table>
                <br>
                {{ $users->links('pagination::bootstrap-4') }}
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
<script>
    $(document).ready(function()
        {
            $(document).on('click', '.confirm', function(event) {
                event.preventDefault();
                var id=$(this).data('id');
                var title=$(this).data('title');
                var result=confirm("Are you sure you want to delete"+ title +" user ?");
                
                if (result) {
                
                 $.ajax({
                    url : "{{ route('delete') }}",
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

@extends('layout')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listing User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Listing User</li>
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
                <h3 class="card-title">User Listing</h3> <div align='right'><a class="btn btn-primary" href='{{route('add')}}'>Add New User</a></div>
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
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                    @foreach($data1 as $f)
                  <tr>
                    <td>{{$f->name}}</td>
                    <td>{{$f->email}}</td>
                    <td>{{$f->contact}}</td>
                    <td>{{$f->address}}</td>
                    <td>{{$f->role}}</td>
                    <td>{{$f->position}}</td>
                    <td><a href='{{ route('edit',['id' => $f->id]) }}'>Edit</a> | 
                        <a href='{{ route('delete',['id' => $f->id]) }}'>Delete</a> |

                        @if($f->status==0)
                            <a href='{{ route('parmittion',['id' => $f->id]) }}'>Approve Permition</a>
                        @else
                        <a href='{{ route('parmittion',['id' => $f->id]) }}'>Dis Approve</a>
                            
                        @endif      
                  </tr>
                  
                    @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Position</th>
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

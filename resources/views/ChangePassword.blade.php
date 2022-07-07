@extends('layout')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
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
                <h3 class="card-title">Change Password <small></small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
            <form action={{route('change_password')}} id="quickForm" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Old Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter old Password" value="{{ old('password')}}">
                    @error('password')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                    @error('match_password')
                      <div style="color:red">{{ $message }}</div>
                    @enderror

                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" name="newPassword" class="form-control" id="exampleInputPassword1" placeholder="New Password">
                    @error('newPassword')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
                    @error('confirmPassword')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
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
    <!-- /.content -->
  
  
@endsection

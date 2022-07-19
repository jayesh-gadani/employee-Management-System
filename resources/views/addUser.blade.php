@extends('layout')
@section('pageTitle','New User Registration')
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
            {{isset($user->name)?'Update user':'Add user'}}
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{'/home'}}">Home</a></li>
              <li class="breadcrumb-item active"><a href='{{route('user')}}'>User</a></li>
              <li class="breadcrumb-item active">{{isset($user->name)?'Update':'Add'}}</li>
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

                <h3 class="card-title">{{isset($user->name)?'Update user':'Add user'}}<small></small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
            <form action="" id="quickForm" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label><span class='text-danger'>*</span>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name"  value="{{ old('name') ? old('name') : $user->name}}">
                    @error('name')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label><span class='text-danger'>*</span>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email') ? old('email') : $user->email}}">
                    @error('email')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact number</label><span class='text-danger'>*</span>
                    <input type="text" name="contact" class="form-control" id="exampleInputEmail1" placeholder="Enter contact number" value="{{ old('contact') ? old('contact') : $user->contact}}">
                    @error('contact')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label><span class='text-danger'>*</span>
                    <textarea  name="address" class="form-control" id="exampleInputEmail1" placeholder="Enter address">{{ old('address') ? old('address') : $user->address}}</textarea>
                    @error('address')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">

                    <label for="exampleInputEmail1">Role</label><span class='text-danger'>*</span>
                    <select  name="role" class="form-control" id="exampleInputEmail1" {{ old('role') ? old('role') : $user->role}}> 
                      <option value="">Select role</option>
                     
                      @foreach(config('global.roles') as $key => $value)
                                @if((isset($user->role) && $key == $user->role) or old('role') == $key)
                                    <option value='{{$key}}' selected>{{$value}}</option>
                                @else
                                    <option value='{{$key}}'>{{$value}}</option>
                                @endif       
                      @endforeach

                    </select>
                    @error('role')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Position</label><span class='text-danger'>*</span>
                    <select  name="position" class="form-control" id="exampleInputEmail1">
                      <option value="">Select position</option>
                       @foreach(config('global.positions') as $key => $value)
                                @if((isset($user->position) && $key == $user->position) or old('position') == $key )
                                    <option value='{{$key}}' selected>{{$value}}</option>
                                @else
                                    <option value='{{$key}}'>{{$value}}</option>
                                @endif    
                      @endforeach

                    </select>
                    @error('position')
                      <div style="color:red">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{isset($user->name)?'Update':'Submit'}}</button>
                   <a href='{{route('user')}}' class="btn btn-primary">Cancel</a>
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

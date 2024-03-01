@extends('Admin_head')

@extends('Admin_nav_aside')

@section('AdminContent')
  

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">

              <div class="card-body">
                <div class="tab-content p-0">
                <div class="container">
                    <div class="form_parent">
                        <h1 class="heading primary">Update Course</h1>
                        <form action="{{url('course/update/')}}/{{$courses->course_id}}" method="post">
                        @csrf
                        
                            <label for="c_name">Course Name</label>
                            <input type="text" name="c_name" placeholder="Enter course name"  value="{{$courses->course_name}}">
                            <span class="text-danger">
                                @error('c_name')
                                    {{$message}}
                                @enderror
                            </span>

                            <label for="c_code">Course Code</label>
                            <input type="text" name="c_code" placeholder="Enter course code"  value="{{$courses->course_code}}">
                            <span class="text-danger">
                                @error('c_code')
                                    {{$message}}
                                @enderror
                            </span>

                            <button type="submit" name="save-course" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
                  
                </div>
              </div>
            </div>

          </section>
          <!-- /.Left col -->
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer mt-2">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

@endsection



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
              <div class="card-header">
                <h3 class="card-title">
                  Courses Record
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a href="{{url('/course/form')}}" class="btn btn-success add_student_btn">ADD Course</a>
                    </li>
                    
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                <div class="container">
                    <table>
                    
                        <tr>
                            <th>Course id</th>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Actions </th>
                        </tr>
                        @foreach($courses as $course )
                            <tr>
                            <td>{{$course->course_id}}</td>
                            <td>{{$course->course_name}}</td>
                            <td>{{$course->course_code}}</td>
                            <td>
                                <a class='btn btn-success edit_btn'
                                href="{{url('/course/edit/')}}/{{$course->course_id}}">Edit</a>

                                <a class=' btn btn-danger delete_btn'
                                href="{{url('/course/delete/')}}/{{$course->course_id}}" >Delete</a> 
                            </td>
                            </tr>
                        @endforeach
                        </table>

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
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
                  Student Record
                </h3>
                
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <!-- <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a> -->
                      <a href="{{url('/form')}}" class="btn btn-success add_student_btn">ADD Student</a>
                    </li>
                    
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                <div class="container">
                    <table>

                        <tr>
                            <th>Student id</th>
                            <th>Student Image</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Course Name</th>
                            <th>Actions </th>
                        </tr>
                        @foreach($students as $student )
                            <tr>
                            <td>{{$student->student_id}}</td>
                            <td>
                              <img src="{{asset('/storage/uploadImages')}}/{{$student->image}}" 
                            alt=""></td>
                            <td>{{$student->student_name}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->course_name}}</td>
                            <td>
                                <a class='btn btn-success edit_btn'
                                href="{{url('/student/edit/')}}/{{$student->student_id}}">Edit</a>

                                <a class=' btn btn-danger delete_btn'
                                href="{{url('/student/delete/')}}/{{$student->student_id}}" >Delete</a> 
                            </td>
                            </tr>
                        @endforeach
                       
                        </table>
                        <div class="mt-5 w-100">

                          <div id="range_slider"></div>
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

  <script src="{{ asset('assets/js/rangeslider.umd.min.js')}}"></script>

  <script>
		const rangeSliderElement = rangeSlider(document.getElementById('range_slider'),{
      value: [0, 30],
    // thumbsDisabled: [true, false],
    thumbsDisabled: (false) ,
    rangeSlideDisabled: true
    });
	</script> 
  @endsection
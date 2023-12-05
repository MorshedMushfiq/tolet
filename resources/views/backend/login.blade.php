@extends("layouts.app")
@section('main')

  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="/assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Login for Your Dashboard</p>
                @if(Session::has("success"))
                <p class='alert alert-success'>{{Session::get("success")}}<button class='close' data-dismissed="alert">&times;</button> </p>
                @endif
            
                @if(Session::has("error"))
                <p class='alert alert-danger'>{{Session::get("error")}}<button class='close' data-dismissed="alert">&times;</button> </p>
              
                @endif
                <form action="{{route('login.user')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control">
                  </div>
                  <div class="mb-4">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name='password' class="form-control" id="">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="javascript:void(0)">Forgot Password ?</a>
                  </div>
                  <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Login">
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                    <a class="text-primary fw-bold ms-2" href="{{route('admin.register')}}">Create an account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
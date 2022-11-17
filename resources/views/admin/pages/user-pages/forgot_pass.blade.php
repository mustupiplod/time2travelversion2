@extends('Admin.layout.master-mini')
@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('Admin/assets/images/auth/login_1.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
        <form action="{{ route('admin.forgot_pass') }}" method="post">
        @csrf

        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
          <div class="form-group">
            <h1>Forgot Password</h1>
            <p>Please enter the valid email id. Password reset mail will be sent on it.</p>
            <label class="label">Email</label>
            <div class="input-group">
              <input type="email" class="form-control" name="email" placeholder="email" required>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block">Submit</button>
          </div>
          
          
          
        </form>
      </div>
      <ul class="auth-footer">
        <li>
          <a href="#">Conditions</a>
        </li>
        <li>
          <a href="#">Help</a>
        </li>
        <li>
          <a href="#">Terms</a>
        </li>
      </ul>
      <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
    </div>
  </div>
</div>

@endsection

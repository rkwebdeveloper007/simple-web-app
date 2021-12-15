<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dummy Test</title>

  <link rel="stylesheet" href="{{asset('admin/css/app.css')}}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
<div class="register-logo">
   <h4><b>Update New Password</b></h4>
  </div>
  
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg"></p>
      @if (session('status'))
          <div class="alert alert-danger">
              {{ session('status') }}
          </div>
      @endif
      <form method="post" action="{{ route('resetPassword') }}" >
      {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="{{$data->name}}" name="name" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
          @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
          @endif
        <div class="input-group mb-3">
          <input type="email" class="form-control" value="{{$data->email}}" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
          @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
          @endif
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="new password">
        </div>
          @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
          @endif
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <!-- <input type="checkbox" id="agreeTerms" name="terms" value="agree"> -->
              <label for="agreeTerms">
               <!-- I agree to the terms -->
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" value="submit" class="btn btn-primary btn-block">update</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- js -->
<script src="{{asset('admin/js/app.js')}}"></script>
<script src="https://kit.fontawesome.com/5a48532541.js" crossorigin="anonymous"></script>

</body>
</html>

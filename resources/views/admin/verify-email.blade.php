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
    <a href=""><b>Verify account</b></a>
  </div>

  <div class="card">
   
    <div class="card-body register-card-body">
      <p class="login-box-msg">Verify Email</p>
      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
      <form method="post" action="{{ route('emailNotification') }}" >
      {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
          @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
          @endif
        <div class="row">
          <div class="col-8">
        
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" value="submit" class="btn btn-primary btn-block">Login</button>
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

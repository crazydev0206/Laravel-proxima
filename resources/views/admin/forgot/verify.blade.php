<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Administration | <?php echo env('APP_NAME'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo url('assets/admin/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo url('assets/admin/dist/css/AdminLTE.min.css'); ?> ">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo url('assets/admin/plugins/iCheck/square/blue.css'); ?> ">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
      <a href="<?php echo url('admin/dashboard'); ?>"><?php echo env('APP_NAME'); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Change Your Password</p>
    <?php if(!empty($error)) echo '<p>'.$error.'</p>'; ?>
    <form action="" method="post">
       
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="New Password" name="password" required>
        <span class="glyphicon glyphicon-cog form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="hidden" name="adminid" value="<?=$adminid; ?>">
        <input type="password" class="form-control" placeholder="New Password Again" name="confirm_password" required>
        <span class="glyphicon glyphicon-cog form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
         {{ csrf_field() }}

          <a href="<?php echo url('admin/login'); ?>">Sign in</a>
        </div>
        <div class="col-xs-8">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Change Your Password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="assets/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

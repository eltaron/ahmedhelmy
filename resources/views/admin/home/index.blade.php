<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>أستاذ رأفت جابر</title>
    <meta name="theme-color" content="#0881a3" />
    <meta name="msapplication-navbutton-color" content="#0881a3" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#0881a3" />
    <meta name="author" content="Ahmed Eltaroun ( Master code )" />
    <meta name="MobileOptimized" content="320" />
    <meta property="og:title" content="الرئيسية" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://raafatgaber.com" />
    <meta property="og:image" content="" />
    <meta property="og:site_name" content="raafatgaber" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="shortcut icon" type="image/png" href="{{asset('admin_files')}}/favicon.png" />
    <link rel="stylesheet" href="{{asset('admin_files')}}/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{asset('admin_files')}}/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{asset('admin_files')}}/css/styles.css">
</head>
<body class="rtl">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5 text-light">
                            <div class="brand-logo text-center">
                                <img src="{{asset('admin_files')}}/images/Logo.png" class="pl-2" width="200">
                            </div>
                            <h4 style="float:right;">مرحبا بك </h4>
                            <h6 class="font-weight-bold">تسجيل الدخول</h6>
                            <form class="pt-3"  action="{{aurl('login')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="اسم المستخدم" name="username" autocomplete="off" >
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="الرقم السرى"  name="password" autocomplete="new-password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" >تسجيل دخول</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
    </div>
    <script src="{{asset('admin_files')}}/js/vendor.bundle.base.js "></script>
    <script src="{{asset('admin_files')}}/js/Chart.min.js "></script>
    <script src="{{asset('admin_files')}}/js/off-canvas.js "></script>
    <script src="{{asset('admin_files')}}/js/hoverable-collapse.js "></script>
    <script src="{{asset('admin_files')}}/js/misc.js "></script>
    <script src="{{asset('admin_files')}}/js/dashboard.js "></script>
    <script src="{{asset('admin_files')}}/js/todolist.js "></script>
</body>
</html>

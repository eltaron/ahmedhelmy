<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>منصة التفوق في اللغة الإنجليزية - Mr. Ahmed Helmy</title>
    <meta name="theme-color" content="#0881a3" />
    <meta name="msapplication-navbutton-color" content="#071a36" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#071a36" />
    <meta name="author" content="Ahmed Eltaroun ( Master code )" />
    <meta name="MobileOptimized" content="320" />
    <meta property="og:title" content="الرئيسية" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://drsherifwaly.com" />
    <meta property="og:image" content="" />
    <meta property="og:site_name" content="drsherifwaly" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{asset('web_files')}}/images/favicon.png" />
    <!-- css files -->
    <link rel="stylesheet" href="{{asset('web_files')}}/assets/bootstrab/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('web_files')}}/assets/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('auth')}}/bio.css" />
</head>
<body>
    <div class="main">
        <div class="row">
            <div class="col-lg-6 text-center">
                <h1>انشاء حساب</h1>
                @include('web.includes.message')
                <form action="{{url('store')}}" method="POST">
                    @csrf
                    <div>
                        <div>
                            <input type="text" class="form-control" name="username"  placeholder=" اسم المستخدم" required/>
                        </div>
                        <div>
                            <input type="tel" class="form-control text-end" name="phone" placeholder=" رقم التليفون" required/>
                        </div>
                        <div>
                            <input type="passsword" class="form-control" name="password" placeholder="كلمة المرور" required/>
                        </div>
                        <select name="parent" class="form-control" required>
                            <option disabled selected>اختار الصف</option>
                            <option value="1">الصف الاول الثانوي</option>
                            <option value="2">الصف الثاني الثانوي</option>
                            <option value="3">الصف الثالث الثانوي</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">انشاء حساب</button>
                </form>
                <h3><a href="{{url('login')}}"> تسجيل الدخول</a></h3>
            </div>
            <div class="col-lg-6">
                <img src="{{asset('web_files')}}/bg2.jpg" width="100%" />
            </div>
        </div>
    </div>
    <script src="{{asset('web_files')}}/assets/bootstrab/bootstrap.bundle.min.js"></script>
</body>
</html>

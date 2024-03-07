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
    <link rel="stylesheet" href="{{asset('web_files')}}/css/404.css" />
</head>
<body style="height: 97vh">
    <div class="container">
      <div class="main">
        <a class="navbar-brand" href="{{url('')}}"
          ><img src="{{asset('web_files')}}/images/logo.png" alt="" width="250"
        /></a>
        <h2 class="mb-4 text-center"> لقد تم اداء الامتحان بنجاح </h2>
        <table class="table table-bordered">
            <tbody>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">النتيجة</th>
                        <th scope="col">النتيجة الكلية</th>
                    </tr>
                </thead>
                <tr>
                    <td>{{$mark->mark}}</td>
                    <td>{{$mark->fullmark}}</td>
                </tr>
            </tbody>
        </table>
       <div class="button">
         <button > <a href="{{url('')}}">الرئيسية</a></button>
       </div>
      </div>
    </div>
</body>
</html>

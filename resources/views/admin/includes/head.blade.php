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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="{{asset('admin_files')}}/favicon.png" />
    <link rel="stylesheet" href="{{asset('admin_files')}}/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{asset('admin_files')}}/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{asset('admin_files')}}/css/styles.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/droid-arabic-kufi" type="text/css" />
    @stack('styles')
    <style>
        div.dataTables_wrapper div.dataTables_filter input {
            margin-right: 0.5em;
        }

        .page-item:last-child .page-link {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .page-item:first-child .page-link {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .toast {
            position: fixed;
            top: 0;
            z-index: 99999;
            min-width: 300px;
        }

        .toast-header button.close {
            background-color: transparent;
            border: none;
            font-size: 22px;
        }
    </style>
</head>

<body class="rtl">
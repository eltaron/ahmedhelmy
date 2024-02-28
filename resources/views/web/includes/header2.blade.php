<header class="d-flex justify-content-between">
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center justify-content-between gap-5">
            <a class="navbar-brand" href="#">
                <img src="{{asset('web_files')}}/images/logoW.png" width="90" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page" href="{{url('')}}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('events') ? 'active' : '' }}" aria-current="page" href="{{url('events')}}">المهام</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" aria-current="page" href="{{url('profile')}}">حسابي</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('contactus') ? 'active' : '' }}" aria-current="page" href="{{url('contactus')}}">تواصل معنا</a>
                    </li>
                    @if(Auth::user()->only == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{aurl('')}}"> لوحة التحكم</a>
                    </li>
                    @endif

                </ul>
                <div class="register">
                    @if(Auth::user())
                    <button onclick="window.location.href=`{{url('logout')}}`" class="headerBtn">تسجيل الخروج</button>
                    @else
                    <button onclick="window.location.href=`{{url('login')}}`" class="headerBtn">تسجيل الدخول</button>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>

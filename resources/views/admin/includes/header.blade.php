<div class="container-scroller">
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center pr-5 pr-md-0">
            <img src="{{asset('admin_files')}}/favicon.png" alt="profile" width="40">
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center pr-0" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        <span class="count-symbol" style="border: none;top: 12px;right: 20px;width: 24px;height: 24px;">{{adminNotificationsCount()}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <h6 class="p-3 mb-0 text-right">الاشعارات</h6>
                        <div class="dropdown-divider"></div>
                        @forelse (adminNotifications() as $n)
                        <a href="{{aurl('members/show2').'/'.$n->user->id}}" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="mdi mdi-account-plus"></i>
                                </div>
                            </div>
                            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal mb-1">{{$n->user->name}}</h6>
                                <p class="text-gray ellipsis mb-0"> {{$n->content}} </p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        @empty
                        <div class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="mdi mdi-alert-circle"></i>
                                </div>
                            </div>
                            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal mb-1">لا يوجد اي اشعارات</h6>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        @endforelse
                    </div>
                </li>
                <li class="nav-item nav-logout d-none d-lg-block">
                    <a class="nav-link" href="{{aurl('logout')}}">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <div class="container-fluid page-body-wrapper pr-0 pl-0">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('dashboard')}}">
                        <span class="menu-title">الصفحه الرئيسيه</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="true" aria-controls="ui-basic">
                        <span class="menu-title">الاعضاء</span>
                        <i class="menu-arrow"></i>
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                    </a>
                    <div class="collapse" id="ui-basic" style="">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{aurl('members')}}">جميع الاعضاء</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{aurl('members/old')}}">اعضاء مفعلين</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{aurl('members/new')}}">اعضاء في الانتظار</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{aurl('members/tops')}}">اعضاء متفوقين</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('categories')}}">
                        <span class="menu-title">الاقسام</span>
                        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('lessons')}}">
                        <span class="menu-title">الدروس</span>
                        <i class="mdi mdi-alphabetical menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('books')}}">
                        <span class="menu-title">الملخصات</span>
                        <i class="mdi mdi-alphabetical menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('exams')}}">
                        <span class="menu-title">الامتحانات</span>
                        <i class="mdi mdi-help menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('audios')}}">
                        <span class="menu-title">الصوتيات</span>
                        <i class="mdi mdi-microphone-variant menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('events')}}">
                        <span class="menu-title">المهام</span>
                        <i class="mdi mdi-calendar-plus menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('messages')}}">
                        <span class="menu-title ">رسائل الصفحة</span>
                        <i class="mdi mdi-email-outline menu-icon "></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('live')}}">
                        <span class="menu-title ">البث المباشر</span>
                        <i class="mdi mdi-camcorder menu-icon "></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{aurl('logout')}}">
                        <span class="menu-title ">تسجيل الخروج</span>
                        <i class="mdi mdi-logout menu-icon "></i>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " data-toggle="collapse " href="{{url('')}}" aria-expanded="false " aria-controls="general-pages ">
                        <span class="menu-title ">الواجهه</span>
                        <i class="mdi mdi-airplay menu-icon "></i>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="main-panel">
            <div class="content-wrapper ">

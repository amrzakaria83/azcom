<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Wrapper-->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper" data-kt-scroll-offset="5px">
        <!--begin::Sidebar menu-->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">

            <div class="menu-item">
                <a class="menu-link" href="{{url('/teacher')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.dashboard')}}</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('teacher.classrooms.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.classrooms')}}</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('teacher.wallas.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.walls')}}</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('teacher.questions.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.questions')}}</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('teacher.exams.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.exams')}}</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('teacher.scratchvideos.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.custom_videos')}}</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('teacher.notifications.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{trans('lang.notifications')}}</span>
                </a>
            </div>

        </div>

    </div>
    <!--end::Wrapper-->
</div>
<!--end::Sidebar-->
<!--begin::Logo-->
<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
    <!--begin::Logo image-->
    <a href="{{ route('dashboard') }}" class="text-decoration-none d-flex gap-6">
        <img alt="Logo" src="{{ image('logos/logo-2.a54cbefc.png') }}" class="h-35px app-sidebar-logo-default"/>
        <img alt="Logo" src="{{ image('logos/minilogo.png') }}" class="h-20px app-sidebar-logo-minimize">

        {{--        <h4 class="text-white h3 d-inline mt-2">Marblex</h4>--}}
    </a>

    <div id="kt_app_sidebar_toggle"
         class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
         data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
         data-kt-toggle-name="app-sidebar-minimize">{!! getIcon('black-left-line', 'fs-3 rotate-180 ms-1') !!}</div>
    <script type="text/javascript">
        var sidebar_toggle = document.getElementById("kt_app_sidebar_toggle");
        @if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on")
        document.body.setAttribute("data-kt-app-sidebar-minimize", "on");
        sidebar_toggle.setAttribute("data-kt-toggle-state", "active");
        sidebar_toggle.classList.add("active");
        @endif
    </script>
    <!--end::Sidebar toggle-->
</div>
<!--end::Logo-->

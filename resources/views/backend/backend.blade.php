@include('backend.layouts.backend_css')
@include('backend.layouts.backend_preloader')  
@include('backend.layouts.backend_overlay')
@include('backend.layouts.backend_searchbar')
@include('backend.layouts.backend_header')
@include('backend.layouts.backend_leftsidebar')

    @yield('main_section')

@include('backend.layouts.backend_js')
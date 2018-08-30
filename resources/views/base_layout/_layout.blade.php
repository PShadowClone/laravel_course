<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]>
<html lang="{{app()->getLocale()}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="{{app()->getLocale()}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>

<!-- HEADER META STARTS->
    @include('base_layout.components.header.header_meta')
        <!-- HEADER META ENDS-->

    @yield('style')
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
@includeIf('base_layout.components.header.header')
<!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
        @includeIf('base_layout.components.nav')
        <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->

    <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">

            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
            @endif
            @yield('breadcrumb')
            @yield('body')
            <!-- END PAGE HEADER-->
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
@includeIf('base_layout.components.footer.footer')
<!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV -->

<!-- END QUICK NAV -->


<!-- FOOTER META STARTS -->
@includeIf('base_layout.components.footer.footer_meta')
<!-- FOOTER META ENDS -->
@yield('script')

</body>

</html>
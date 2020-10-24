@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="/message">
                              <i class="fa fa-envelope-o"></i>
                              @foreach($users as $user)
                              <span class="label label-success">{{ $user->unread != 0 ? $user->unread : ''  }}</span>
                              @endforeach
                            </a>
                          </li>
                        <li class="dropdown user user-menu">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="user-image">
                                    <img src="<?= Auth::user()->profile_image ?>" alt="User Image">
                                </div>
                                <span class="hidden-xs"><?= Auth::user()->first_name; ?></span>
                            </a>

                            <ul class="dropdown-menu boxshadow-light-dark">
                                <li class="user-header">
                                    <div class="user-image">
                                        <a href="#" title="View Profile">
                                            <img src="<?= Auth::user()->profile_image ?>" alt="User Image">
                                        </a>
                                    </div>
                                    <p>
                                        @if(Auth::user()->id != 1)
                                            <span style="text-transform: uppercase;"><?= Auth::user()->first_name . ' ' . Auth::user()->last_name; ?></span><br>
                                            <small><?= Auth::user()->role->name ?> </small>
                                        @else
                                            <span style="text-transform: uppercase;"><?= Auth::user()->last_name; ?></span><br>
                                        @endif
                                    </p>
                                </li>
                                <li class="user-footer">
                                    @if(Auth::user()->id != 1)
                                    <p>
                                        <a class="btn btn-default btn-block break-me" target="_blank" href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACqklEQVQ4EaXBT2gcVRzA8e/vvTeb6U7jDJnGxproJmgrWi3WnPTiXUopVKtWUUFz8Q80YquCxltREBFysQh6KB4qgtKL4r2I9GaQoIgVW0uF7WaH2d3ZnXnvJxEq3vv5iKpyM+TK8uyx8cn1Q+njTwx9b0t1XCHWckMIAUQwIqj3mDjGZRnFZ2eTa2dWzrs6XzzNd98shgMPEO+9h2YwgKoCY9imqmwTVaTdxiYJ482f8d+eI211HjaD2YWO2fyJ8qWnGH59jihJcHmOqGKMwVqLBVye45KEwZdf0D9+mNYvG1Q793TMpOh1u0t7CU1D9eZr9NZOEooCNzODqqKq2JkZQlFw/e1VBqsrOJTfOnexce2PrtlR9kUix9+vnKLat5/w6TrdZ49QXfyRKMuIsozq4g90nz5E88lHcGCZq6trXJ6MaBc9cY0PTJcF6WOH+ev+g0yvv0/2/Xn6Lxylee8DRAPlu29gij7l0WcYnniHJM/ZdeZDJgIOESZ1w65elzv338ul19eo9t3HrV+dZXTqZVCQ2Tm6Kyeojxxj9/w8rd9/5XIIqAqOENhWNZ64LFnKbuHPJ5/jyuLd7P58neCV7ouvMvXIo8yNK6b6W0yU/zhUQRURqH3A1hPuUOXqg8ts7TmNiLDz9gXSsk/wntBuIyKgigBOUQTlhnFdEzlHpx3Tm1+gaWriaogHRARjDB4wAgHFEPiXBiWEgLWGqNXCOEcaOVpNQx0CIoKxFhEQQEQAxQVDbkcjUKU1NYULnm3ee6y1pGlKWZaoKsYIYgwiBi1LrIbcmFF1oU4zbBRhjcE3DU3T4L2nrmtCCMRxjIjgfUC9ByO05m5j6LngdvRHb11fXHpeRXU8HJowHisi/J8xBlXFe09dVRrAJQcfmr60sfmxqCo34x/ixkOgJHqxYQAAAABJRU5ErkJggg==">&nbsp;&nbsp;<?= Auth::user()->email ?></a>
                                    </p>
                                    @endif
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                                        <a href="#" class="btn btn-default btn-flat">Settings</a>
                                    </div>
                                    <div class="pull-right">
                                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                            <a class="btn btn-default btn-flat" href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                            </a>
                                        @else
                                            <a  class="btn btn-default btn-flat" href="#"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            >
                                                </i> {{ trans('adminlte::adminlte.log_out') }}
                                            </a>
                                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                                @if(config('adminlte.logout_method'))
                                                    {{ method_field(config('adminlte.logout_method')) }}
                                                @endif
                                                {{ csrf_field() }}
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <div class="user-panel">
                <div class="image">
                    <img src="<?= Auth::user()->profile_image ?>" alt="avatar">
                    <!-- <form name="upload-photo" method="post">
                        <a href="/my/v2/cropper.php" class="btn-upload" id="btn-upload-photo">
                            <img src="/my/v2/assets/img/profile-photos/x56dea6e99d665da885fc065c43c8726f.jpg.pagespeed.ic.FsQ8IifcHT.jpg" class="profile-photo " alt="User Image" data-pagespeed-url-hash="353616640" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                            <div class="profile-pic-selector" id="profile-pic-selector">
                                <i class="fa fa-camera"></i>
                                <span class="pps-text">Update Photo</span>
                            </div>
                        </a>
                    <input class="file-upload" type="file" accept="image/jpeg, image/png">
                    </form> -->
                </div>
                <!-- <div class="user-name" style="text-overflow: ellipsis; color: gray; text-align: center; padding-top: 5px"><span style="text-transform: uppercase;"><?= Auth::user()->first_name . ' ' . Auth::user()->last_name; ?></span> </div> -->
                @if(Auth::user()->id == 1)
                    <div class="info ellipsis"><?= Auth::user()->last_name; ?></div>
                @else
                    <div class="info ellipsis"><?= Auth::user()->first_name . ' ' . Auth::user()->last_name; ?></div>
                @endif
            </div>
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li>
                        <a href="/accreditation">
                          <i class="fa fa-book"></i> <span>Accreditation</span>
                          <span class="pull-right-container">
                            <small class="label pull-right bg-green"></small>
                          </span>
                        </a>
                    </li>
                    <li>
                        <a href="/message">
                          <i class="fa fa-inbox"></i> <span>Messages</span>
                          <span class="pull-right-container">
                            <small class="label pull-right bg-green"></small>
                          </span>
                        </a>
                    </li>
                    @if(Auth::user()->role_id < 3)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-flag"></i> <span>Request</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li><a href="request/parameter"><i class="fa fa-circle"></i> Parameters</a></li>
                            <li><a href="request/file"><i class="fa fa-circle"></i> Files</a></li>
                        </ul>
                    </li>
                    @endif
                    {{-- <li class="active treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                        </ul>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                        </ul>
                    </li>
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item') --}}
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<<<<<<< HEAD
    <script>
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
        return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
        return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
    </script>

=======
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('4ce59a8acebdae2c292c', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                // alert(JSON.stringify(data));
                if (my_id == data.from) {
                    $('#' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending-message').html());

                        if (pending) {
                            $('#' + data.from).find('.pending-message').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending-message">1</span>');
                        }
                    }
                }
            });

            $('.user-message').click(function () {
                $('.user-message').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending-messages').remove();

                receiver_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#message').html(data);
                        scrollToBottomFunc();
                    }
                });
            });

            $(document).on('keyup', '.input-text input', function (e) {
                var message = $(this).val();

                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty

                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "sendMessage", // need to create this post route
                        data: datastr,
                        cache: false,
                        success: function (data) {
                            
                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                }
            });
        });

        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper-message').animate({
                scrollTop: $('.message-wrapper-message').get(0).scrollHeight
            }, 50);
        }
    </script>
>>>>>>> a4b6bc54790a52e9f6291bb323f6d3102321c95e
    @stack('js')
    @yield('js')
@stop

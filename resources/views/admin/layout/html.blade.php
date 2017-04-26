<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>王者荣耀</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <link rel="stylesheet" href="/js/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="/css/font.css" type="text/css" />
    <link rel="stylesheet" href="/css/app.css" type="text/css" />
    <link rel="stylesheet" href="/css/jquery.toast.css" type="text/css" />
    <!--[if lt IE 9]>
    <script src="/js/ie/html5shiv.js"></script>
    <script src="/js/ie/respond.min.js"></script>
    <script src="/js/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
<section class="vbox">

    @include('admin.layout.header')
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('admin.layout.aside')
            <!-- /.aside -->
            <section id="content">
                @yield('content')
            </section>
        </section>
    </section>
</section>

<section id="loading-box">
    <img src="/images/loading.gif"> 正在加载中...
</section>
<script src="/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/js/bootstrap.js"></script>

<script src="/js/admin/jquery.extends.js"></script>
<script src="/js/jquery.toast.js"></script>

@yield('foot_script')
<!-- App -->
<script src="/js/app.js"></script>
<script src="/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/js/app.plugin.js"></script>
<script type="text/javascript" src="/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="/js/jPlayer/demo.js"></script>
</body>
</html>
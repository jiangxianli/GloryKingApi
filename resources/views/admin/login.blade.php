<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>Musik | Web Application</title>
    <meta name="description"
          content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <link rel="stylesheet" href="/js/jPlayer/jplayer.flat.css" type="text/css"/>
    <link rel="stylesheet" href="/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="/css/simple-line-icons.css" type="text/css"/>
    <link rel="stylesheet" href="/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="/css/jquery.toast.css" type="text/css" />
    <!--[if lt IE 9]>
    <script src="/js/ie/html5shiv.js"></script>
    <script src="/js/ie/respond.min.js"></script>
    <script src="/js/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="bg-info dker">
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="container aside-xl">
        <a class="navbar-brand block" href="#"><span class="h1 font-bold">最强王者</span></a>
        <section class="m-b-lg">
            <header class="wrapper text-center">
                <strong>登录系统</strong>
            </header>
            <form action="{{ action('Admin\AdminController@postLogin') }}" data-validate="parsley" id="login-form"
                  method="post">
                <div class="form-group">
                    <input type="text" name="user_name" placeholder="账号" data-required="true"
                           data-error-message="请输入用户名" class="form-control rounded input-lg text-center no-border">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="密码" data-required="true"
                           data-error-message="请输入密码" class="form-control rounded input-lg text-center no-border">
                </div>
                <div class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded">
                    <i class="icon-arrow-right pull-right"></i>
                    <input type="submit" class="m-r-n-lg admin-login-btn" value="登录"/>
                </div>
                <div class="text-center m-t m-b"><a href="#">
                        <small>忘记密码?</small>
                    </a></div>
                <div class="line line-dashed"></div>
            </form>
        </section>
    </div>
</section>
<!-- footer -->
<footer id="footer">
    <div class="text-center padder">
        <p>
            <small>Web app framework base on Bootstrap<br>&copy; 2014</small>
        </p>
    </div>
</footer>
<section id="loading-box">
    <img src="/images/loading.gif"> 正在加载中...
</section>

<!-- / footer -->
<script src="/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/js/bootstrap.js"></script>

<script src="/js/admin/jquery.extends.js"></script>
<script src="/js/jquery.toast.js"></script>
<script src="/js/parsley/parsley.min.js"></script>
<script src="/js/parsley/parsley.extend.js"></script>
<script src="/js/admin/login.js"></script>

<!-- App -->
<script src="/js/app.js"></script>
<script src="/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/js/app.plugin.js"></script>
<script type="text/javascript" src="/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="/js/jPlayer/demo.js"></script>
</body>
</html>
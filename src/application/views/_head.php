<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('UTC');

if (!isset($_COOKIE['dil'])) {
    $_COOKIE['dil'] = "gb";
}
?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>

    <?php if (isset($title)) {
        echo "<title>" . $title . "</title>";
        echo "<meta name=\"description\" content=\" . $description . \"/>";
    } else {
        echo "<title>Pickyfy | All you need in Vienna</title>";
    }
    ?>
    <script language='javascript' type='text/javascript'>
        <?php
        if ($_SERVER['SERVER_NAME'] === '127.0.0.1') {
            echo 'var base_url = "http://127.0.0.1/firmguides";';
        } else {
            echo 'var base_url = "https://pickyfy.at";';
        }
        ?>
    </script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="All you need in Vienna" name="description"/>
    <meta content="Gladius Technology" name="author"/>
    <link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico"/>
    <meta name="google-site-verification" content="F4n3x5-m-VL4d02K5xe6fTVx6SPcnFAD4SlJUQbBrMw"/>
    <meta name="msvalidate.01" content="8C279266A0A7E9276250B90EE2FE3941"/>
    <meta name="yandex-verification" content="ad0a4badcd083d84"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <?php
    if (class_exists('Login')) {
        ?>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css?vlogin" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css?vlogin"
          rel="stylesheet"
          type="text/css"/>
        <!-- END PAGE LEVEL PLUGINS --><!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo base_url(); ?>assets/global/css/components-md.min.css?vlogin" rel="stylesheet"
          id="style_components"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/css/plugins-md.min.css?vlogin" rel="stylesheet" type="text/css"/>
        <!-- END THEME GLOBAL STYLES --><!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo base_url(); ?>assets/pages/css/login-5.min.css?vlogin" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->

    <?php
    } else if (class_exists('Search_Plus')) {
    ?>

        <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css?vSearch_Plus"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/fancybox/source/jquery.fancybox.css?vSearch_Plus"
          rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css?vSearch_Plus"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css?vSearch_Plus"
          rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL PLUGINS --><!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo base_url() ?>assets/global/css/components-md.min.css?vSearch_Plus" rel="stylesheet"
          id="style_components" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/css/plugins-md.min.css?vSearch_Plus" rel="stylesheet"
          type="text/css"/>
        <!-- END THEME GLOBAL STYLES --><!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo base_url() ?>assets/pages/css/search.min.css?vSearch_Plus" rel="stylesheet"
          type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->
    <?php
    } else {
    ?>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link
            href="<?php echo base_url() ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css?velse"
            rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/clockface/css/clockface.css?velse" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/jquery-multi-select/css/multi-select.css?velse"
          rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2.min.css?velse" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2-bootstrap.min.css?velse"
          rel="stylesheet"
          type="text/css"/>

    <link href="<?php echo base_url() ?>assets/global/plugins/jstree/dist/themes/default/style.min.css?velse"
          rel="stylesheet"
          type="text/css"/>

    <link href="<?php echo base_url() ?>assets/global/plugins/typeahead/typeahead.css?velse" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2.min.css?velse" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/select2/css/select2-bootstrap.min.css?velse"
          rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css?velse"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/plugins/fancybox/source/jquery.fancybox.css?velse"
          rel="stylesheet"
          type="text/css"/>
        <!-- END PAGE LEVEL PLUGINS --><!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo base_url() ?>assets/global/css/components-md.min.css?velse" rel="stylesheet"
          id="style_components"
          type="text/css"/>
    <link href="<?php echo base_url() ?>assets/global/css/plugins-md.min.css?velse" rel="stylesheet" type="text/css"/>
        <!-- END THEME GLOBAL STYLES --><!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo base_url() ?>assets/pages/css/blog.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/profile-2.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/invoice-2.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/contact.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/profile.min.css?velse" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/pages/css/search.min.css?velse" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->


        <?php
    }
    ?>
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo base_url() ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet"
          type="text/css"
          id="style_color"/>
    <link href="<?php echo base_url() ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->

    <link href="<?php echo base_url() ?>assets/_/css/all.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/v1/jquery.wallform.js?velse"
            type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/v1/alert.js?velse" type="text/javascript"></script>

    <?php
    if ($_SERVER['SERVER_NAME'] === 'pickyfy.at') { // pickyfy.at
        ?>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-91998452-1', 'auto');
            ga('send', 'pageview');

        </script>


    <?php
    } else { // test serverlar
    ?>


        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-26694472-6', 'auto');
            ga('send', 'pageview');

        </script>


        <?php
    }
    ?>
</head>
<!-- END HEAD -->
<?php
if (class_exists('Search') || class_exists('Search_Result') || class_exists('Search_Plus')  || class_exists('Emergency')) {
    echo "<body class='page-header-fixed page-sidebar-closed page-container-bg-solid page-content-white page-full-width page-md'>";
} else if (class_exists('Estreet')) {
    echo "<body class='page-header-fixed page-sidebar-closed page-container-bg page-content-white page-full-width page-md'>";
} else if (class_exists('Login')) {
    echo "<body class=\"login\" style=\" background-color: #fff;\">";
} else {
    echo "<body class='page-header-fixed page-sidebar-closed page-container-bg-solid page-content-white page-sidebar-fixed page-md'>";
}
?>

<?php
if (!class_exists('Login')) {
?>

<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo"><a href="<?php echo base_url() ?>"> <img style="
                    width: 170px;    margin-top: 10px !important;
                    "
                                                                            src="<?php echo base_url() ?>assets/_/pickyfylogo.png"
                                                                            alt="logo"
                                                                            class="logo-default"/> </a>

                <?php
                if (!class_exists('Search') && !class_exists('Search_Result') && !class_exists('Search_Plus')&& !class_exists('Estreet')&& !class_exists('Emergency') ) {
                    echo "<div class=\"menu-toggler sidebar-toggler\"><span></span></div>";
                }
                ?>
            </div>
            <!-- END LOGO -->

            <?php
            if (!class_exists('Search') && !class_exists('Search_Result') && !class_exists('Search_Plus')&& !class_exists('Estreet')&& !class_exists('Emergency')) {
                ?>
                <form class="search-form search-form-expanded" action="_" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control"
                               placeholder="Search..." name="s" id="s"> <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                    </div>
                </form>

                <?php
            }
            ?>

            <!-- BEGIN MEGA MENU -->

            <div id="flowMassages" class="col-md-6" style="float: left;">


            </div>

            <!-- END MEGA MENU -->


            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <?php
            if (!class_exists('Search') && !class_exists('Search_Result') && !class_exists('Search_Plus')&& !class_exists('Estreet')&& !class_exists('Emergency')) {
                echo "<a href=\"javascript:;\" class=\"menu-toggler responsive-toggler\" data-toggle=\"collapse\"
               data-target=\".navbar-collapse\"> <span></span> </a>";
            }
            ?>

            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right hidden-sm hidden-xs">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->


                    <!-- BEGIN LANGUAGE BAR -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-language"><a href="javascript:;" class="dropdown-toggle"
                                                              data-toggle="dropdown" data-hover="dropdown"
                                                              data-close-others="true"> <img alt=""
                                                                                             src="<?php echo base_url() ?>assets/global/img/flags/<?php echo $_COOKIE['dil']; ?>.png">
                            &nbsp;
                            <span class="langname"><?php echo $_COOKIE['dil']; ?></span> <i
                                    class="fa fa-angle-down"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-default">

                            <li><a href="<?php echo base_url(); ?>index.php/Login/dilDegistir/gb"> <img alt=""
                                                                                                        src="<?php echo base_url() ?>assets/global/img/flags/gb.png">
                                    English
                                </a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Login/dilDegistir/de"> <img alt=""
                                                                                                        src="<?php echo base_url() ?>assets/global/img/flags/de.png">
                                    German
                                </a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Login/dilDegistir/tr"> <img alt=""
                                                                                                        src="<?php echo base_url() ?>assets/global/img/flags/tr.png">
                                    Turkish
                                </a></li>
<!--
                            <li><a href="<?php echo base_url(); ?>index.php/Login/dilDegistir/ae"> <img alt=""
                                                                                                        src="<?php echo base_url() ?>assets/global/img/flags/ae.png">
                                    Arabic
                                </a></li>


                            <li><a href="<?php echo base_url(); ?>index.php/Login/dilDegistir/it"> <img alt=""
                                                                                                        src="<?php echo base_url() ?>assets/global/img/flags/it.png">
                                    Italian
                                </a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Login/dilDegistir/ir"> <img alt=""
                                                                                                        src="<?php echo base_url() ?>assets/global/img/flags/ir.png">
                                    Persian
                                </a></li>
                            <li><a href="<?php echo base_url(); ?>index.php/Login/dilDegistir/ru"> <img alt=""
                                                                                                        src="<?php echo base_url() ?>assets/global/img/flags/ru.png">
                                    Russian
                                </a></li>
                           -->
                        </ul>
                    </li> <!-- END LANGUAGE BAR -->
                    <!-- END LANGUAGE BAR -->
                    <?php
                    if (!class_exists('Search') && !class_exists('Search_Result') && !class_exists('Search_Plus')&& !class_exists('Estreet')&& !class_exists('Emergency')) {
                        ?>

                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user"><a href="javascript:;" class="dropdown-toggle"
                                                              data-toggle="dropdown" data-hover="dropdown"
                                                              data-close-others="true"> <img alt="" class="img-circle"
                                                                                             src="<?php echo base_url() ?>assets/layouts/layout/img/avatar3_small.jpg"/>
                                <span class="username username-hide-on-mobile"> Nick </span> <i
                                        class="fa fa-angle-down"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li><a href="<?php echo base_url() ?>index.php/Login" target="_blank"> <i
                                                class="icon-user"></i> Login </a></li>
                                <li><a href="<?php echo base_url() ?>index.php/welcome/representative"> <i
                                                class="icon-user"></i> My Profile </a></li>
                                <li class="divider"></li>
                                <li><a href="page_user_lock_1.html"> <i class="icon-lock"></i> Lock Screen </a></li>
                                <li><a href="<?php echo base_url() ?>index.php/VerifyLogin/sessionDestroy"> <i
                                                class="icon-key"></i> Log Out </a></li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <?php
                    }
                    ?>

                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->

            <div class="hor-menu  hor-menu-light hidden-sm hidden-xs  pull-right">
                <ul class="nav navbar-nav">

                    <li class="classic-menu-dropdown" aria-haspopup="true"><a target="_blank"
                                                                              href="https://www.facebook.com/pickyfy/"
                                                                              data-original-title="facebook"
                                                                              class="facebook"> <i
                                    class="fa fa-facebook"></i></a></li>
                    <!-- v2
                       <li class="classic-menu-dropdown" aria-haspopup="true"><a target="_blank" href="javascript:;"
                                                                                 data-original-title="linkedin"
                                                                                 class="linkedin"> <i
                                       class="fa fa-linkedin"></i></a></li>
                                       -->
                       <li class="classic-menu-dropdown" aria-haspopup="true"><a target="_blank"
                                                                                 href="https://www.youtube.com/channel/UCPOqyi-RVt6mW9bF_jasr3g"
                                                                                 data-original-title="youtube"
                                                                                 class="youtube"> <i
                                       class="fa fa-youtube"></i></a></li>

                </ul>
            </div>
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php
        if (!class_exists('Search') && !class_exists('Search_Result') && !class_exists('Search_Plus')&& !class_exists('Estreet')&& !class_exists('Emergency')) {
            include "_sidebar.php";
        }
        ?>

        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">

            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <?php
                if (!class_exists('Search') && !class_exists('Search_Result') && !class_exists('Search_Plus')&& !class_exists('Estreet')&& !class_exists('Emergency')) {
                    ?>
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar" style="margin-bottom: 20px;">
                        <ul class="page-breadcrumb">
                            <li><a href="/">Home</a> <i class="fa fa-circle"></i></li>


                            <?php if (isset($heading)) {
                                echo " <li><a href=\"\">" . $heading . "</a></li>";
                            } else {
                                echo "<li><a href=\"\"> Refresh</a></li>";
                            }

                            ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
                <!-- END PAGE BAR -->
                <!-- END PAGE HEADER-->
                <?php
                }
                ?>

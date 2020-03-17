<?php
ob_start();

// include required files
require_once 'core/init.php';

// create new user instance
$user = new User();

// check if user is logged in
if (!$user->isLoggedIn()) {
    // if user is not logged in, redirect to login page
    Redirect::to('login.php');
}

$page_name = basename($_SERVER['PHP_SELF'], '.php');
if (!$user->hasPermission('pages', $page_name)) {
    Session::put('fclass', 'error');
    Session::flash('fmsg', 'Unauthorized access!');
    Redirect::to('dashboard.php');
}
?>
<html>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo Config::get('app/name');?> | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

    <!--https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css-->
    <link href="plugins/DataTables-1.10.13/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!--    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">-->
    <link href="plugins/DataTables-1.10.13/media/css/dataTables.material.min.css" rel="stylesheet">
    <link href="plugins/DataTablesResponsive-2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">
<!--    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">-->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="dist/css/custom.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>-->

	<script>
	    function toggleFullscreen(elem) {
	        elem = elem || document.documentElement;
	        if (!document.fullscreenElement && !document.mozFullScreenElement &&
	            !document.webkitFullscreenElement && !document.msFullscreenElement) {
	            if (elem.requestFullscreen) {
	                elem.requestFullscreen();
	            } else if (elem.msRequestFullscreen) {
	                elem.msRequestFullscreen();
	            } else if (elem.mozRequestFullScreen) {
	                elem.mozRequestFullScreen();
	            } else if (elem.webkitRequestFullscreen) {
	                elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
	            }
	        } else {
	            if (document.exitFullscreen) {
	                document.exitFullscreen();
	            } else if (document.msExitFullscreen) {
	                document.msExitFullscreen();
	            } else if (document.mozCancelFullScreen) {
	                document.mozCancelFullScreen();
	            } else if (document.webkitExitFullscreen) {
	                document.webkitExitFullscreen();
	            }
	        }
	    }

	    $(document).ready(function() {
		    $('#btnFullscreen').click(function() {
				toggleFullscreen();
		    });
		});
	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!--<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">-->
<div class="wrapper">
<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo Config::get('app/base_url');?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>C</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Smart</b>City</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <?php
//        $client_id = "phpMQTT-subscriber"; // must be unique
//        $mqtt = new phpMQTT("172.26.46.117", 1883, $client_id);
//
//        if(!$mqtt->connect(true,NULL)){exit(1);}
//
//        //currently subscribed topics
//        $topics['sensor/temperature_celsius'] = array("qos"=>0, "function"=>"procmsg");
//        $mqtt->subscribe($topics,0);
//
//        while($mqtt->proc()){
//        }
//
//        $mqtt->close();
//        function procmsg($topic,$msg){
//            echo "Msg Recieved: $msg";
//        }
        ?>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a><span id="wle_temp">
                    <i class="fa fa-thermometer-empty" aria-hidden="true"></i>
                    <?php
                    $stc = file_get_contents('/home/smartcity/html/smartcity/api/lab/sensor_temperature_celsius.data');
                    if ($stc != '') {
                        echo $stc;
                        echo "<sup>o</sup>";
                    } else {
                        echo "Na";
                    }
                    ?>
                </span></a></li>
                <li>
                    <a><span id="wle_temp">
                        <i class="fa fa-tint" aria-hidden="true"></i>
                        <?php
                        //echo "Humidity: ";
                        $sh = file_get_contents('/home/smartcity/html/smartcity/api/lab/sensor_humidity.data');
                        if ($sh != '') {
                            echo $sh;
                        } else {
                            echo "Na";
                        }
                        ?>
                    </span></a>
                </li>
	            <li><a href="#" id="btnFullscreen"><i class="fa fa-arrows-alt"></i></a></li>
                <!-- .messages-menu -->
<!--                <li class="dropdown messages-menu">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                        <i class="fa fa-envelope-o"></i>-->
<!--                        <span class="label label-success">4</span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li class="header">You have 4 messages</li>-->
<!--                        <li>-->
<!--                            <ul class="menu">-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <div class="pull-left">-->
<!--                                            <img src="dist/img/ishtiyaq.jpg" class="img-circle" alt="User Image">-->
<!--                                        </div>-->
<!--                                        <h4>Support Team<small><i class="fa fa-clock-o"></i> 5 mins</small></h4>-->
<!--                                        <p>Why not buy a new awesome theme?</p>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                        <li class="footer"><a href="#">See All Messages</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
                <!-- /.messages-menu -->

                <?php
                $array_icons = array ('message' => 'fa-comment',
                    'warning' => 'fa-exclamation-triangle',
                    'alert'   => 'fa-bell',
                    'info'    => 'fa-info-circle',
                );
                $notification = new Notification();
                $rows = $notification->find($user->data()->id, 3);
                $count = ($notification->count() > 0) ? '' : 'count';
                ?>
                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <?php
                        $label = ($notification->count() == 0) ? "label-default":"label-warning";
                        ?>
                        <span class="label <?php echo $label?>"><?php echo $notification->count(); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have <?php echo $notification->count(); ?> notification/s</li>
                        <li>
                            <ul class="menu">
                                <?php
                                if ($notification->count() <= 0) {
                                    ?>
                                    <li class="disabled"><a href="#"><div>All caught up!</div></a></li>
                                    <li class="divider"></li>
                                    <?php
                                } else {
                                    foreach ($rows as $r) {
                                        ?>
                                        <li>
                                            <a href="notifications_view.php">
                                                <div>
                                                    <i class="fa <?php echo $array_icons[$r->message_type]; ?> fa-fw text-aqua"></i>
                                                    <?php echo ucfirst($r->message); ?>
                                                    <span class="pull-right text-muted small"><?php echo $notification->elapsedTimeString($r->date_created); ?></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="footer"><a href="notifications_view.php">View all</a></li>
                    </ul>
                </li>

                <!-- Tasks Menu -->
<!--                    <li class="dropdown tasks-menu">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                        <i class="fa fa-flag-o"></i>-->
<!--                            <span class="label label-danger">9</span>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li class="header">You have 9 tasks</li>-->
<!--                            <li>-->
<!--                                <ul class="menu">-->
<!--                                    <li>-->
<!--                                        <a href="#">-->
<!---->
<!--                                            <h3>-->
<!--                                                Design some buttons-->
<!--                                                <small class="pull-right">20%</small>-->
<!--                                            </h3>-->
<!--                                            <div class="progress xs">-->
<!--                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">-->
<!--                                                    <span class="sr-only">20% Complete</span>-->
<!--                                                </div>-->
<!--                                        </div>-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                            <li class="footer">-->
<!--                                <a href="#">View all tasks</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
                <!-- User Account Menu -->
                <?php
                $profile_pic = Config::get('app/profile_url') . '/' . $user->data()->avatar;
                if (!file_exists($profile_pic)) {
                    $profile_pic = Config::get('app/profile_url') . '/no_avatar.jpg';
                }
                ?>
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="<?php echo $profile_pic;?>" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"><?php echo ucwords($user->getFullName());?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="<?php echo $profile_pic;?>" class="img-circle" alt="User Image">
                            <p>
                                <?php echo ucwords($user->data()->title) . ' ' . ucwords($user->getFullName()); ?>
                                <small>Member since <?php echo date("M. Y", strtotime($user->data()->date_created));?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
<!--                            <li class="user-body">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-xs-4 text-center">-->
<!--                                        <a href="#">Followers</a>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-4 text-center">-->
<!--                                        <a href="#">Sales</a>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-4 text-center">-->
<!--                                        <a href="#">Friends</a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
<!--                    <li>-->
<!--                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
<!--                    </li>-->
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
<!--        <div class="user-panel">-->
<!--            <div class="pull-left image">-->
<!--                <img src="dist/img/ishtiyaq.jpg" class="img-circle" alt="User Image">-->
<!--            </div>-->
<!--            <div class="pull-left info">-->
<!--                <p>Ishtiyaq Husain</p>-->
<!--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
<!--            </div>-->
<!--        </div>-->

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search..." autocomplete="off">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <script>
            $( function() {
                $( '#search' ).keyup( function() {
                    var matches = $( 'ul#main_menu' ).find( 'li:containsi('+ $( this ).val() +') ' );
                    $( 'li', 'ul#main_menu' ).not( matches ).slideUp();
                    matches.slideDown();
                });

                $.extend($.expr[':'], {
                    'containsi': function(elem, i, match, array) {
                        return (elem.textContent || elem.innerText || '').toLowerCase()
                                .indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });
            });
        </script>

        <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <div class="bg-primary text-center">
            <span id="date"></span>
            <span id="time"></span>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" id="main_menu">
            <?php
            $pages = new Page();

            $where = array ('display_menu', '=', '1');
            $rows = $pages->find($where);

            if ($rows) {
                foreach ($rows as $row) {
                    if ($user->hasPermission('pages', $row->page_name)) {
                        ?>

                        <li class="treeview menu-open">
                            <a href="<?php echo $row->page_filename; ?>"><i class="fa <?php echo $row->fa_menu_icon; ?> fa-fw"></i>
                                <span>
                                <?php
                                $menu_name = 'MENU_' . strtoupper(str_replace(' ','_', $row->page_title));
                                echo $row->page_title;
                                ?>
                                </span>
                            </a>
                        </li>
                        <?php
                    }
                }
            }
            ?>
        </ul>
    </section>
</aside>

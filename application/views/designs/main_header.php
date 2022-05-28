<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	if($page_active == 'main'){$main_act = 'active';} else {$main_act = '';}
	if($page_active == 'about'){$about_act = 'active';} else {$about_act = '';}
	if($page_active == 'cause'){$cause_act = 'active';} else {$cause_act = '';}
	if($page_active == 'event'){$event_act = 'active';} else {$event_act = '';}
	if($page_active == 'store'){$store_act = 'active';} else {$store_act = '';}
	if($page_active == 'contact'){$contact_act = 'active';} else {$contact_act = '';}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title> 
    <meta name="keywords" content="Food Security, Zero Hunger, Charity, SDG, Farmers, Raw Foods" />
    <meta name="description" content="<?php echo app_meta_desc; ?>">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/flaticon.css" />

</head>
<body>
    <div class="boxed_wrapper">
        <section class="theme_menu stricky">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="main-logo">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-md-7 menu-column">
                        <nav class="main-menu">
                            <div class="navbar-header">     
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">
                                    <li class="<?php echo $main_act; ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
                                    <li class="<?php echo $about_act; ?>"><a href="<?php echo base_url('about'); ?>">About us</a></li>
                                    <li class="<?php echo $cause_act; ?>"><a href="<?php echo base_url('causes'); ?>">Causes</a></li>
                                    <li class="<?php echo $event_act; ?>"><a href="<?php echo base_url('events'); ?>">Events</a></li>
                                    <li class="<?php echo $store_act; ?>"><a href="<?php echo base_url('store'); ?>">Store</a></li>
                                    <li class="<?php echo $contact_act; ?>"><a href="<?php echo base_url('contact'); ?>">contact</a></li>
                                </ul>
                                <ul class="mobile-menu clearfix">
        							<li class="<?php echo $main_act; ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
                                    <li class="<?php echo $about_act; ?>"><a href="<?php echo base_url('about'); ?>">About us</a></li>
                                    <li class="<?php echo $cause_act; ?>"><a href="<?php echo base_url('causes'); ?>">Causes</a></li>
                                    <li class="<?php echo $event_act; ?>"><a href="<?php echo base_url('events'); ?>">Events</a></li>
                                    <li class="<?php echo $store_act; ?>"><a href="<?php echo base_url('store'); ?>">Store</a></li>
                                    <li class="<?php echo $contact_act; ?>"><a href="<?php echo base_url('contact'); ?>">contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
           </div> <!-- End of .conatiner -->
        </section>
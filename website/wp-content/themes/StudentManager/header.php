<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?echo the_title()?> - Student manager</title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php wp_head(); ?>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="65">
	<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
		<div class="container-fluid" id="nav-row">
			<img class="img-responsive logo" src="<?bloginfo('template_directory')?>/assets/brand/mylife_logo.png" height="120"/>
			<button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#sm-navbar-collapse" aria-controls="sm-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
				<?
				wp_nav_menu( array(
				    'theme_location'  => 'primary',
				    'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
				    'container'       => 'div',
				    'container_class' => 'collapse navbar-collapse',
				    'container_id'    => 'sm-navbar-collapse',
				    'menu_class'      => 'navbar-nav mx-auto',
				    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
				    'walker'          => new WP_Bootstrap_Navwalker(),
				) );
				?>
	    </nav>
        <div class="container-fluid"> <!-- Begin Body Content -->

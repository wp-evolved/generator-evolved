<!doctype html>

<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php wp_title(''); ?></title>

	<?php if ( defined('TYPEKIT') ) : // Typkit Code ?>
	<script type="text/javascript" src="//use.typekit.net/<?php echo TYPEKIT; ?>.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php endif; ?>

	<?php if ( defined('HFJ_ACCOUNT') ) : // H&FJ Code ?>
	<link rel="stylesheet" type="text/css" href="//cloud.typography.com/<?php echo HFJ_ACCT; ?>/<?php echo HFJ_PROJECT; ?>/css/fonts.css" />
	<?php endif; ?>

	<?php wp_head(); ?>

</head>

<body <?php bodyClass(); ?> >

	<header role="banner" class="site-header">
		<?php if ( is_front_page() ) :
			echo '<h1 class="site-logo">' . SITE_NAME . '</h1>';
		else :
			echo '<div class="site-logo">' . SITE_NAME . '</div>';
		endif; ?>
		<nav role="navigation" class="nav main-nav">
			<?php wp_nav_menu( array('menu' => 'Main-Nav','container' => false) ); ?>
		</nav>
	</header>

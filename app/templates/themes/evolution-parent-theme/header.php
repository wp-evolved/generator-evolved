<!doctype html>

<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]> <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title( '' ); ?></title>

  <?php if ( defined( 'TYPEKIT' ) ) : // Typkit Code ?>
    <script type="text/javascript">
      TypekitConfig = {
        kitId: '<?php echo TYPEKIT; ?>'
      };
      (function() {
        var tk = document.createElement('script');
        tk.src = '//use.typekit.com/' + TypekitConfig.kitId + '.js';
        tk.type = 'text/javascript';
        tk.async = 'true';
        tk.onload = tk.onreadystatechange = function() {
          var rs = this.readyState;
          if (rs && rs !== 'complete' && rs !== 'loaded') return;
          try { Typekit.load(TypekitConfig); } catch (e) {}
        };
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(tk, s);
      })();
    </script>
  <?php endif; ?>

  <?php if ( defined( 'HFJ_ACCOUNT' ) ) : // H&FJ Code ?>
    <link rel="stylesheet" type="text/css" href="//cloud.typography.com/<?php echo HFJ_ACCT; ?>/<?php echo HFJ_PROJECT; ?>/css/fonts.css" />
  <?php endif; ?>

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?> >

  <header role="banner" class="site-header">

    <div class="site-logo"><?php echo SITE_NAME; ?></div>
    <nav role="navigation" class="nav main-nav">
      <a class="screen-reader-text skip-link" href="#content">Skip to content</a>
      <?php wp_nav_menu( array( 'menu' => 'Main-Nav', 'theme_location' => 'primary', 'container' => false ) ); ?>
    </nav>

  </header>

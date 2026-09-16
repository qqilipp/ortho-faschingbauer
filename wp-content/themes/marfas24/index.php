<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">
<head>
	<meta charset="UTF-8" />	
	<?php get_template_part('parts/seo'); ?>
	
	<meta name="robots"	  content="noodp" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" />
	
	<link rel="apple-touch-icon" sizes="180x180" 	href="https://www.ortho-faschingbauer.at/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="https://www.ortho-faschingbauer.at/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="https://www.ortho-faschingbauer.at/favicon-16x16.png">
	<link rel="manifest" 							href="https://www.ortho-faschingbauer.at/site.webmanifest">
	
	<meta name="theme-color" content="#fff" media="(prefers-color-scheme: light)">
	<meta name="theme-color" content="#fff" media="(prefers-color-scheme: dark)">
	
	<meta name="creator" content="Designtiger Webdesign Wien" />
	
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?> ontouchstart="">

<div id="top"></div>

<div id="outer" class=""> <?php // outer full ?>

	<header id="header" class="bgwhite">
		
		<div id="masternav" class="postinfo">
			<?php wp_nav_menu( array( 'theme_location' => 'menu_master' )); ?>
		</div>
		
		<div class="outer">
	
		    <div class="wrap wide">
		    	
			    <div class="col-xs-9 col-s-10 col-sm-8 col-m-3 col-ml-3 col-l-3 col-xl-3">
				    
				    <div id="logo">
  <div class="logo-title">
    <a rel="home"
       href="<?php echo esc_url( home_url( (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE === 'en') ? '/en/' : '/' ) ); ?>"
       title="<?php echo esc_attr( get_field('kontakt_name', 'options') ); ?>">
      <?php echo esc_html( get_field('kontakt_name', 'options') ); ?>
    </a>
  </div>
</div>

									
				</div>
				
				<div class="col-xs-0 col-s-0 col-sm-0 col-m-9 col-ml-9 col-l-9 col-xl-9">
					
					<nav id="nav">
					    	
					    <?php wp_nav_menu( array( 'theme_location' => 'menu_main' )); ?>
						
					</nav>
			    		
				</div>
		    	
		    </div>
		    
		</div>
	    	    
	</header>

	<?php if( get_field('info_show', 'option') ) {
		get_template_part('parts/infobar'); } ?>
		


  <main id="main">
  <?php if ( is_front_page() ) : ?>
    <?php $is_en = (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE === 'en'); ?>

    

  <?php endif; ?>
	<?php if ( is_page_template( 'page-service.php' )) { ?>
		
    <?php } else { ?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	    <?php if( get_field('content') ) {
			get_template_part('parts/content'); 
		} else { 
			get_template_part('parts/content_empty');
		} ?>
	    
	    <?php if ( is_page('kontakt1') ) { ?>	    
	    <div class="outer full">		    
		    <div class="wrap full">
			    <?php get_template_part('parts/gmap'); ?>
			    
		    </div>
	    </div>
	    <?php } ?>	    
	    
	    <?php edit_post_link( __('Seite bearbeiten'), '<div class="bgwhite"><div class="outer"><div class="wrap"><div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12"><div class="editlink"><span class="icon icon-right"></span><span>', '</span></div></div></div></div></div>' ); ?>
	    
	<?php endwhile; ?>
	<?php }  ?>
	</main>
	<?php if ( is_page('kontakt1') ) : ?>
	<aside id="kontakt" class="bgmedium">
	    
	    <div class="padding"></div>
	
	    
	    <div class="outer">
	    	
		    <div class="wrap">
			    	
			    <div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12 textcenter">
				    
				    <h3 class="sectiontitle"><span class="subline"><?php _e( 'Contact & Appointments', 'tigris' ); ?></span></h3>
				    <div class="padding"></div>
				    <div class="padding"></div>
				    
				    <h5><?php _e( 'Private Practice', 'tigris' ); ?>
					    <?php if(ICL_LANGUAGE_CODE=='de') { ?>
					    <br />
					    (Wahlarzt: keine Kassen)
					    <?php } ?>
				    </h5>
				    
				    <p>
					    <?php the_field('kontakt_ordi', 'options'); ?><br />
					    <?php the_field('kontakt_adresse', 'options'); ?>, <?php the_field('kontakt_plzort', 'options'); ?>
					    <br />
					    <a target="_blank" href="<?php the_field('kontakt_maplink', 'options'); ?>" title=""><?php _e( 'View on map', 'tigris' ); ?></a>
<!-- 					    | <a href="#anfahrt" class="do_anfahrt" title="">Anfahrt</a> -->
				    </p>
				    
				    <div class="padding"></div>
				    
			    </div>
			    
			    <div class="col-xs-12 col-s-12 col-sm-12 col-m-4 col-ml-4 col-l-4 col-xl-4 textcenter">
				    
				    <h5><?php _e( 'Contact', 'tigris' ); ?></h5>
				    
				    <p>
					    <?php $tel = get_field('kontakt_tel', 'options'); 
							$telformat = str_replace(' ', '', $tel);
						    $telformat = str_replace('/', '', $telformat); 
						    $telformat = preg_replace('/^0/', '+43', $telformat); ?>
						<a href="tel:<?php echo $telformat; ?>"><?php echo $tel; ?></a>
						<br />
						<?php $mymail = get_field('kontakt_mail', 'options') ?>
						<a href="mailto:<?php echo antispambot( $mymail ); ?>"><?php echo antispambot( $mymail ); ?></a>
						<br />
						<a class="showform" href="#formbox"><?php _e( 'Contact form', 'tigris' ); ?></a>
				    </p>
				    
				    <div class="padding"></div>
				    
			    </div>
			    
			    <div class="col-xs-12 col-s-12 col-sm-12 col-m-4 col-ml-4 col-l-4 col-xl-4 textcenter">
				    
				    <h5><?php _e( 'Appointments', 'tigris' ); ?></h5>
				    
				    <p>
					    <?php $tel = get_field('kontakt_tel', 'options'); 
							$telformat = str_replace(' ', '', $tel);
						    $telformat = str_replace('/', '', $telformat); 
						    $telformat = preg_replace('/^0/', '+43', $telformat); ?>
						<a href="tel:<?php echo $telformat; ?>"><?php echo $tel; ?></a>
<!--
					    <br />
					    <a href="#" title="">Termin online buchen</a>
-->
					    
				    </p>
				    
				    <div class="padding"></div>
				    
			    </div>
			    
			    <div class="col-xs-12 col-s-12 col-sm-12 col-m-4 col-ml-4 col-l-4 col-xl-4 textcenter">
				    
				    <h5><?php _e( 'Accessibility', 'tigris' ); ?></h5>
				    
				    <p>
					    <?php _e( 'Barrier-free access', 'tigris' ); ?><br />
						<?php _e( 'Parking available', 'tigris' ); ?><br />
						<?php _e( 'Public Transport: ', 'tigris' ); ?> U6, 43, 44, 13A
				    </p>
				    
				    <div class="padding"></div>
				    
			    </div>
			    
				
			    
		    </div>		    
		    
	    </div>
	    
	    
	    		    		    
	</aside>
	<?php endif; ?>
	
	<?php /* ?>			
	<footer id="subfooter" class="bgwhite">
		
		<div class="outer">
	
		    <div class="wrap wide">
		    
		    	<div class="padding"></div>
		    	
		    	<div class="col-xs-12 col-s-12 col-sm-9 col-m-9 col-ml-9 col-l-9 col-xl-9">
			    	
			    	<ul>
			    		<li>&copy; <?php the_field('kontakt_name', 'options'); ?></li>
			    	</ul>
			    	
			    	<?php wp_nav_menu( array( 'theme_location' => 'menu_subfooter' )); ?>
		    		
		    		<div class="padding"></div>
		    	
		    	</div>
		    	
		    	<div class="col-xs-12 col-s-12 col-sm-12 col-m-3 col-ml-3 col-l-3 col-xl-3">
		    	
		    		<p class="textright">
		    			<a class="creator" rel="noopener" target="_blank" href="https://www.designtiger.at/firmen-gruender-webdesign/arzt-zahnarzt-homepage/" title="Webdesign für Ärzte & Ordinationen, Wien">Designtiger Webdesign</a>
		    		</p>
		    		
		    		
		    	
		    	</div>
		    	
		    </div>
		    
		</div>
		
	</footer>
	<?php */ ?>
    
	<?php if ( is_front_page() ) : ?>
  <section class="svc-bottom-cta bgwhite">
    <div class="outer">
      <div class="wrap">
        <div class="col-xs-0 col-s-0 col-sm-1 col-m-2 col-ml-2 col-l-2 col-xl-2"></div>

        <div class="col-xs-12 col-s-12 col-sm-10 col-m-8 col-ml-8 col-l-8 col-xl-8 textcenter">
          

          <span class="button">
  <a href="<?php echo ICL_LANGUAGE_CODE === 'en' 
      ? home_url('/en/contact/') 
      : home_url('/kontakt/'); ?>">
    <?php echo ICL_LANGUAGE_CODE === 'en'
      ? 'Book a consultation'
      : 'Beratungsgespräch vereinbaren'; ?>
  </a>
</span>

          <div class="padding"></div>
          <div class="padding"></div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

    
	
	<?php get_footer("custom"); ?>
	<?php /*
</div>

<div id="formbox" class="bglight">
	<div class="outer">
		<div class="wrap relative">
			<div class="padding"></div>
			<a class="hideform hideicon"></a>
			<div class="clear"></div>
			<div class="col-xs-1 col-s-1 col-sm-1 col-m-1 col-ml-2 col-l-2 col-xl-3"></div>
			<div class="col-xs-10 col-s-10 col-sm-10 col-m-10 col-ml-8 col-l-8 col-xl-6">
				
				<div class="padding"></div>
				<div class="padding"></div>
				
				<?php get_template_part('parts/contactform'); ?>
				
				<div class="clear"></div>
				
				<p class="topline">
					<a class="hideform" href="<?php the_permalink();?>" title="">Formular schließen</a>
				</p>
				
				<div class="padding"></div>
				
				<div class="clear"></div>
				
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<a id="totop" class="scrolly" href="#top" title="Zum Seitenanfang"><span class="icon icon-up"></span></a>

<div id="navicon" class="navtrigger 55555">
	<span></span>
</div>
<div id="mobolay" class="navtrigger"></div>

<?php get_template_part('parts/mobnav'); ?>

<div id="scroll0"></div><div id="scroll1"></div><div id="scroll2"></div>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/toggle.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/superfish.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/waypoint.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/inview.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js<?php echo '?' . filemtime( get_stylesheet_directory() . '/js/main.js'); ?>"></script>

<?php wp_footer(); ?>
</body>
</html>
*/ ?>
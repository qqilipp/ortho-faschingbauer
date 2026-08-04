<div id="mobnav" class="bgwhite 123">
	
	<div class="wrap">
	
		<div class="col-xs-12 col-s-12 col-sm-12 col-m-12">
			
			<div id="mobmenu">
				
				<?php wp_nav_menu( array( 'theme_location' => 'menu_mobile' )); ?>
				
			</div>
			
		</div>
		
	</div>
	
<!--
	<div class="wrap">
	
		<div class="col-xs-12 col-s-12 col-sm-12 col-m-12">
			
			<div class="padding"></div>
			<div class="padding"></div>
			
			<div class="inner">
				
				<p>
			    <?php if ( get_field('kontakt_tel', 'options') ) { ?>
			    <span class="span30">
			    	<span class="icon icon-tel"></span>
			    </span>
			    <?php the_field('kontakt_tel', 'options'); ?><br />
			    <?php } ?>
			    
			    <?php if ( get_field('kontakt_mob', 'options') ) { ?>
			    <span class="span30">
			    	<span class="icon icon-mob"></span>
			    </span>
			    <?php the_field('kontakt_mob', 'options'); ?><br />
			    <?php } ?>
			    
			    <?php if ( get_field('kontakt_fax', 'options') ) { ?>
			    <span class="span30">
			    	<span class="icon icon-fax"></span>
			    </span>
			    <?php the_field('kontakt_fax', 'options'); ?><br />
			    <?php } ?>
			    
			    <?php if ( get_field('kontakt_mail', 'options') ) { ?>
			    <span class="span30">
			    	<span class="icon icon-mail"></span>
			    </span>
			    <?php $mymail = get_field('kontakt_mail', 'options') ?>
			    <a href="mailto:<?php echo antispambot( $mymail ); ?>" title="Email"><?php echo antispambot( $mymail ); ?></a>
			    <?php } ?>
			</p>
				
			</div>
			
			<div class="padding"></div>
			<div class="padding"></div>
			<div class="padding"></div>
			<div class="padding"></div>
			
		</div>
		
	</div>
-->
	
</div>
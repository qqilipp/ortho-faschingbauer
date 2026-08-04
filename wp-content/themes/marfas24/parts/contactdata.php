<p>
    <a href="<?php bloginfo('home'); ?>" title="<?php the_field('kontakt_firma', 'options'); ?> - <?php the_field('kontakt_name', 'options'); ?>, <?php the_field('kontakt_plzort', 'options'); ?>">
    	<strong>
    		<?php the_field('kontakt_firma', 'options'); ?>
    	</strong>
    </a>
    <br />
    <?php the_field('kontakt_name', 'options'); ?><br />
    <?php if ( get_field('kontakt_slogan', 'options') ) {
    	the_field('kontakt_slogan', 'options'); 
    }?>
</p>

<p>
    <span class="span30">
    	<span class="icon icon-map"></span>
    </span>
    <?php the_field('kontakt_adresse', 'options'); ?><br />
    <span class="span30">
    	
    </span>
    <?php the_field('kontakt_plzort', 'options'); ?>
</p>

<p>
    <?php if ( get_field('kontakt_tel', 'options') ) { ?>
    <span class="span30">
    	<span class="icon icon-tel"></span>
    </span>
	<?php $tel = get_field('kontakt_tel', 'options'); 
		$telformat = str_replace(' ', '', $tel);
	    $telformat = str_replace('/', '', $telformat); 
	    $telformat = preg_replace('/^0/', '+43', $telformat); ?>
	<a href="tel:<?php echo $telformat; ?>"><?php echo $tel; ?></a><br />
    <?php } ?>
    
    <?php if ( get_field('kontakt_mob', 'options') ) { ?>
    <span class="span30">
    	<span class="icon icon-mob"></span>
    </span>
    <?php $mob = get_field('kontakt_mob', 'options'); 
		$mobformat = str_replace(' ', '', $mob);
	    $mobformat = str_replace('/', '', $mobformat); 
	    $mobformat = preg_replace('/^0/', '+43', $mobformat); ?>
	<a href="tel:<?php echo $mobformat; ?>"><?php echo $mob; ?></a><br />
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
    <a href="mailto:<?php echo antispambot( $mymail ); ?>"><?php echo antispambot( $mymail ); ?></a>
    <?php } ?>
</p>
<?php if( get_field('info_show', 'option') == 1 ) { ?>
<?php if( get_field('info_text', 'option') ) { ?>
<div id="infobar" class="bgdark">
	
	<div class="outer">
					
		<div class="wrap">
			
			<div class="padding"></div>
						
			<div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12">
				
				<?php if( get_field('info_titel', 'option') ) { ?>
				<h4><?php the_field('info_titel', 'option'); ?></h4>
				<?php } ?>
				
				<?php if( get_field('info_titel', 'option') ) { ?>
				<p>
					<?php the_field('info_text', 'option');?>
				</p>
				<?php } ?>
				
				<?php if( get_field('info_link', 'option') == 1 ) { ?>
				<p class="nomargin">
					<span class="button">
						<a class="infobox_hide" href="<?php the_field('info_linkziel', 'option'); ?>">
							<?php the_field('info_linktext', 'option'); ?>	
						</a>
					</span>
				</p>
				<?php } ?>
				
			</div>
			
			<div class="padding"></div>
						
		</div>
						
	</div>
		
</div>	
<?php } ?>
<?php } ?>
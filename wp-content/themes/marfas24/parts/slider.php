<?php $hoehe = get_field('hoehe'); ?>
	
<div class="slider">	
	<div class="bgwhite">
		<div class="outer full">
			<div class="wrap full">
				<?php // $colset = 'col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12'; ?>
				<div class="<?php // echo( $colset ); ?>">
					<?php $sliderrows = count( get_field( 'bilder' ) ); 
					if( is_countable( $sliderrows ) ) {
						$sliderrows = count( $sliderrows ); } ?>
					<div class="slides<?php if( $sliderrows > 1 ) { ?> owl-theme owl-carousel owl-mainslider<?php } ?>">
					<?php while( has_sub_field('bilder') ) { ?>
					
					  	<div>			    	
					    	<?php $sliderimgid 	= get_sub_field('bild');
								if( $hoehe == 'low') {
									$sliderimg 		= $sliderimgid['sizes']['sliderlow'];
								} else {
									$sliderimg 		= $sliderimgid['sizes']['slider'];	
								}
								$sliderimg_s 	= $sliderimgid['sizes']['slider_s'];    // slider_s, slider_s_high
								$slidertitel 	= get_sub_field('titel');
								$slidertext 	= get_sub_field('text');
								$sliderlink 	= get_sub_field('link'); ?>
					    	
					    	<div class="slide">					    		
					    		<picture>
									<source 
										media="(max-width: 480px)" 
										srcset="<?php echo $sliderimg_s; ?>">						
									<img 
										src="<?php echo $sliderimg; ?>" 
										alt="<?php if( !empty( $slideralt ) ) { echo $slideralt; } else { echo $sliderimgid['alt']; } ?>">
					    		</picture>
					    		
					    		<?php if( !empty($slidertitel) || !empty($slidertext) ) { ?>
					    		<div class="sliderolay">						    		
						    		<div class="slidertext">
						    			<div class="outer">
							    			<div class="bgtransparent wrap">
							    				<div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12">
													
													<?php if( !empty($sliderlink) ) { ?>
										    		<a href="<?php echo $sliderlink; ?>" title="Lesen Sie mehr: <?php echo $slidertitel; ?>">
										    		<?php } ?>
									    			
									    			<?php if( !empty($slidertitel) ) { ?>
									    			<h4><?php echo $slidertitel; ?></h4>
									    			<?php } ?>
									    			
									    			<?php if( !empty($slidertext) ) { ?>
									    			<p><?php echo $slidertext; ?></p>
													<?php } ?>
													
													<?php if( !empty($sliderlink) ) { ?>
										    		</a>
										    		<?php } ?>
													
							    				</div>
							    			</div>
						    			</div>						    			
						    		</div>						    		
					    		</div>
					    		<?php } ?>
					    	</div>
					  	</div>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
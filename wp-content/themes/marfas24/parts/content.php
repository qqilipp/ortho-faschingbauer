
<?php if( have_rows('content') ) { ?>
<?php $sectioncount = 0;
	$lastbg = '';
	while ( have_rows('content') ) : the_row(); ?>

<?php // Headline 
	if( get_row_layout() == 'headline' ) { 
		$sectioncount++; ?>



	
	<?php $thisbg 	= get_sub_field('hintergrund'); 
		$breite 	= get_sub_field('breite');	
		if( $breite == 'normal' ) {
		   $colset1 = 'col-xs-0 col-s-0 col-sm-1 col-m-2 col-ml-2 col-l-2 col-xl-2' ;
		   $colset2 = 'col-xs-12 col-s-12 col-sm-10 col-m-8 col-ml-8 col-l-8 col-xl-8';
		} elseif( $breite == 'wide' ) {
		   $colset1 = 'col-xs-0 col-s-0 col-sm-0 col-m-1 col-ml-1 col-l-1 col-xl-1' ;
		   $colset2 = 'col-xs-12 col-s-12 col-sm-12 col-m-10 col-ml-10 col-l-10 col-xl-10';
		} ?>
	
	<div class="<?php echo $thisbg; ?> s_headline">	
		<div class="outer">			
			<div class="wrap">
            
           

			
				<div class="padding"></div>
			
				<div class="<?php echo $colset1; ?>"></div>
				
				<div class="<?php echo $colset2; ?>">
					
					<?php if( get_sub_field('topline') ) { ?>
						<p class="topline <?php the_sub_field('ausrichtung'); ?>"><?php the_sub_field('topline'); ?></p>
					<?php } ?>
					
					<?php if( $sectioncount == 1 ) { ?>
					<h2 class="pagetitle <?php the_sub_field('ausrichtung'); ?> largeh">
						<?php the_sub_field('headline'); ?>
						<?php if( get_sub_field('subline') ) { ?>
						<span class="subline"><?php the_sub_field('subline'); ?></span>
						<?php } ?>
					</h2>
					<?php } else { ?>
					<h3 class="sectiontitle <?php the_sub_field('ausrichtung'); ?> largeh">
						<?php the_sub_field('headline'); ?>
						<?php if( get_sub_field('subline') ) { ?>
						<span class="subline"><?php the_sub_field('subline'); ?></span>
						<?php } ?>
					</h3>
					<?php } ?>

					
					
					<div class="padding"></div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
		
	<?php unset( $lastbg );
		$lastbg = get_sub_field('hintergrund'); ?>
		
		
		
		
<?php } // Text 
	elseif( get_row_layout() == 'text' ) { 
		$sectioncount++; ?>
	
	<?php $thisbg 	= get_sub_field('hintergrund'); 
		$breite 	= get_sub_field('breite');	
		if( $breite == 'normal' ) {
		   $colset1 = 'col-xs-0 col-s-0 col-sm-1 col-m-2 col-ml-2 col-l-2 col-xl-2' ;
		   $colset2 = 'col-xs-12 col-s-12 col-sm-10 col-m-8 col-ml-8 col-l-8 col-xl-8';
		} elseif( $breite == 'wide' ) {
		   $colset1 = 'col-xs-0 col-s-0 col-sm-0 col-m-1 col-ml-1 col-l-1 col-xl-1' ;
		   $colset2 = 'col-xs-12 col-s-12 col-sm-12 col-m-10 col-ml-10 col-l-10 col-xl-10';
		} ?>
		
	<div class="<?php echo $thisbg; ?> s_text">
	
		<div class="outer">
			
			<div class="wrap">
			
				<div class="padding"></div>
				<?php if( $thisbg != $lastbg  ) { ?>
				<div class="padding"></div>
				<?php } ?>
			
				<div class="<?php echo $colset1; ?>"></div>
				
				<div class="<?php echo $colset2; ?>">
					
					<div class="<?php if( $breite == 'wide' ) { ?>textcol<?php } ?>">
					
						<?php if( get_sub_field('topline') ) { ?>
						<p class="topline <?php the_sub_field('ausrichtung'); ?>"><?php the_sub_field('topline'); ?></p>
						<?php } ?>
						
						<?php if( get_sub_field('headline') || get_sub_field('subline') ) { ?>
						<?php if( $sectioncount == 1 ) { ?>
						<h2 class="pagetitle <?php the_sub_field('ausrichtung'); ?> <?php the_sub_field('groesse'); ?>">
							<?php the_sub_field('headline'); ?>
							<?php if( get_sub_field('subline') ) { ?>
							<span class="subline"><?php the_sub_field('subline'); ?></span>
							<?php } ?>
						</h2>
						<?php } else { ?>
						<h3 class="sectiontitle <?php the_sub_field('ausrichtung'); ?> <?php the_sub_field('groesse'); ?>">
							<?php the_sub_field('headline'); ?>
							<?php if( get_sub_field('subline') ) { ?>
							<span class="subline"><?php the_sub_field('subline'); ?></span>
							<?php } ?>
						</h3>
						<?php } ?>
						<?php } ?>
						
						<?php if( get_sub_field('topline') || get_sub_field('headline') || get_sub_field('subline') ) { ?> 
						<div class="padding"></div>
						<?php } ?>
						
						<?php the_sub_field('text'); ?>
						
					</div>
					
				</div>
				
				<div class="padding"></div>
				<?php if( $thisbg != $lastbg  ) { ?>
				<div class="padding"></div>
				<?php } ?>
				
			</div>
			
		</div>
		
	</div>
	
	<?php unset( $lastbg );
		$lastbg = $thisbg; ?>
	



<?php } // Bild 
	elseif( get_row_layout() == 'bild' ) { 
		$sectioncount++; ?>
	
	<?php $thisbg 	= get_sub_field('hintergrund'); 
		$breite 	= get_sub_field('breite');
		$hoehe 		= get_sub_field('hoehe'); ?>
		
	<div class="<?php echo $thisbg; ?> s_bild">
	
		<div class="outer">
			
			<div class="wrap <?php if( $breite == 'full' ) { ?>full<?php } ?>">
				
				<div class="<?php if( $breite == 'wide' ) { ?>col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12<?php } ?>">
					
					<?php $sliderrows = get_sub_field( 'bilder' ); 
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
								$slideralt 		= $sliderimgid['alt'];
								$sliderlink 	= get_sub_field('link');
						    ?>
					    	
					    	<div class="slide">
					    		
					    		<picture>
									<source 
										media="(max-width: 480px)" 
										srcset="<?php echo $sliderimg_s; ?>">						
									<img 
										src="<?php echo $sliderimg; ?>" 
										alt="<?php if( !empty( $slideralt ) ) { echo esc_html( $slideralt ); } ?>">
					    		</picture>
					    		
					    		<?php if( !empty($slidertitel) || !empty($slidertext) ) { ?>
					    		<div class="mobsliderolay"></div>
					    		<div class="sliderolay">						    		
						    		<div class="slidertext">
						    			<div class="outer">
							    			<div class="bgtransparent wrap">
							    				<div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12">
													
									    			<?php if( !empty($slidertext) ) { ?>
									    			<p><?php echo $slidertext; ?></p>
													<?php } ?>
									    			
									    			<?php if( !empty($slidertitel) ) { ?>
									    			<?php if( $sectioncount == 1 ) { ?>
									    			<h2><?php echo $slidertitel; ?></h2>
									    			<?php } else { ?>
									    			<h4><?php echo $slidertitel; ?></h4>
									    			<?php } ?>
									    			<?php } ?>
									    			
									    			<?php if( get_sub_field('showlink') == 1 ) { ?>
										    		<span class="button">
										    			<a href="<?php the_sub_field('link'); ?>">
											    			<?php the_sub_field('linktext'); ?>
											    		</a>
										    		</span>
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
	<?php unset( $lastbg );
		unset( $colimgid );
		unset( $colimg ); 
		unset( $colimg_s );
		$lastbg = 'bgnotset'; ?>
		
		
		

		
<?php } // Text + Bild
	elseif( get_row_layout() == 'textbild' ) { 
		$sectioncount++; ?>
	
	<?php $thisbg 	= get_sub_field('hintergrund');
		$breite 	= get_sub_field('breite');
		$anordnung 	= get_sub_field('anordnung');
		$showlink 	= get_sub_field('showlink');
		// Colset
		if( $anordnung == 'textbild' ) {
			if( $breite == 'normal' ) {
				$colset1 = 'col-xs-0 col-s-0 col-sm-0 col-m-0 col-ml-0 col-l-0 col-xl-0';		// Bild hide
				$colset2 = 'col-xs-12 col-s-12 col-sm-6 col-m-7 col-ml-7 col-l-7 col-xl-7';		// Text
				$colset3 = 'col-xs-12 col-s-12 col-sm-6 col-m-5 col-ml-5 col-l-5 col-xl-5' ;	// Bild 
			} elseif( $breite == 'wide' ) {
				$colset1 = 'col-xs-0 col-s-0 col-sm-0 col-m-0 col-ml-0 col-l-0 col-xl-0'; 		// Bild hide
				$colset2 = 'col-textcol';
				$colset3 = 'col-imgcol';
			}
		} elseif( $anordnung == 'bildtext' ) {
			if( $breite == 'normal' ) {
				$colset1 = 'col-xs-0 col-s-0 col-sm-6 col-m-5 col-ml-5 col-l-5 col-xl-5';		// Bild mobile hide
				$colset2 = 'col-xs-12 col-s-12 col-sm-6 col-m-7 col-ml-7 col-l-7 col-xl-7';		// Text
				$colset3 = 'col-xs-12 col-s-12 col-sm-0 col-m-0 col-ml-0 col-l-0 col-xl-0'; 	// Bild mobile show
			} elseif( $breite == 'wide' ) {
				$colset1 = 'col-imgcol col-large' ;		// Bild mobile hide
				$colset2 = 'col-textcol';				// Text 
				$colset3 = 'col-imgcol col-small';		// Bild mobile show
			}
		}
		// Image
		if( get_sub_field('bild') ) {
			$colimgid 	= get_sub_field('bild');
			$imgwidth 	= $colimgid['width'];
			$imgheight 	= $colimgid['height'];
			// if( $breite == 'normal' ) {
				if( $imgwidth < $imgheight ) {
					$colimg   	= $colimgid['sizes'][ 'portrait' ]; 
					$colimg_s	= $colimgid['sizes'][ 'portrait_s' ];
				} 
				elseif( $imgwidth > $imgheight ) {
					$colimg   	= $colimgid['sizes'][ 'landscape' ]; 
					$colimg_s	= $colimgid['sizes'][ 'landscape_s' ];
				}
				else {
					$colimg   	= $colimgid['sizes'][ 'square' ]; 
					$colimg_s	= $colimgid['sizes'][ 'square_s' ];
				}
			// 	
			// } else {
			// 	$colimg   	= $colimgid['sizes'][ 'square' ]; 
			// 	$colimg_s	= $colimgid['sizes'][ 'square_s' ];
			// }
			$colimgalt 	= $colimgid['alt'];
		} ?>
		
	<div class="<?php echo $thisbg; ?> s_textbild s_<?php echo $anordnung; ?>">
	
		<div class="outer <?php if( $breite == 'wide' ) { ?>full<?php } ?>">
			
			<div class="wrap <?php if( $breite == 'wide' ) { ?>full<?php } ?>">
				
				<?php if( $breite == 'normal' ) { ?>
				<div class="padding"></div>
				<?php } ?>
					
				<div class="<?php // if( $breite == 'wide' ) { ?>aligner<?php // } ?>">
				
					<div class="<?php echo $colset1; ?>">
						<?php if( get_sub_field('bild') ) { ?>
						<?php if( $breite == 'normal' ) { ?>
						<div class="padding"></div>
						<?php } ?>
						<div class="colimg <?php if( $showlink == 1 ) { ?>galimg<?php } ?>">
							<?php if( $showlink == 1 ) { ?>
							<a href="<?php the_sub_field('link') ?>">
							<?php } ?>
							<picture>
								<source 
									media="(max-width: 480px)" 
									srcset="<?php echo $colimg_s; ?>">						
								<img 
									src="<?php echo $colimg; ?>" 
									alt="<?php echo esc_html( $colimgalt ); ?>">
				    		</picture>
				    		<?php if( $showlink == 1 ) { ?>
							</a>
							<?php } ?>
						</div>	
						<?php if( $breite == 'normal' ) { ?>
						<?php if( get_sub_field('bildbeschreibung') ) { ?>
						<p class="caption">
							<?php the_sub_field('bildbeschreibung'); ?>
						</p>
						<?php } ?>
						<div class="padding"></div>
						<?php } ?>
						<?php } ?>							
					</div>
					
					<div class="<?php echo $colset2; ?>">
						
						<div class="<?php if( $breite == 'wide' ) { ?>wrap<?php } else { ?><?php if( $anordnung == 'textbild' ) { ?>innerr<?php } else { ?>innerl<?php } ?><?php } ?>">
							
							<div class="padding"></div>
						
							<!-- <div class="<?php if( $anordnung == 'textbild' ) { ?>innerr<?php } else { ?>innerl<?php } ?>"> -->
								
								<div class="<?php if( $breite == 'wide' ) { ?>textcol<?php } ?>">
								
									<?php if( get_sub_field('topline') ) { ?>
									<p class="topline <?php the_sub_field('ausrichtung'); ?> <?php the_sub_field('groesse'); ?>"><?php the_sub_field('topline'); ?></p>
									<?php } ?>
									
									<?php if( get_sub_field('headline') ) { ?>
									<?php if( $sectioncount == 1 ) { ?>
									<h2 class="pagetitle <?php the_sub_field('ausrichtung'); ?> <?php the_sub_field('groesse'); ?>">
										<?php the_sub_field('headline'); ?>
										<?php if( get_sub_field('subline') ) { ?>
										<span class="subline"><?php the_sub_field('subline'); ?></span>
										<?php } ?>
									</h2>
									<?php } else { ?>
									<h3 class="sectiontitle <?php the_sub_field('ausrichtung'); ?> <?php the_sub_field('groesse'); ?>">
										<?php the_sub_field('headline'); ?>
										<?php if( get_sub_field('subline') ) { ?>
										<span class="subline"><?php the_sub_field('subline'); ?></span>
										<?php } ?>
									</h3>
									<?php } ?>
									<?php } ?>
									
									<?php if( get_sub_field('topline') || get_sub_field('headline') ) { ?> 
									<div class="padding"></div>
									<?php } ?>
									
									<?php the_sub_field('text'); ?>
									
								</div>
								
 							<!-- </div> -->
							
							<div class="padding"></div>
						
						</div>
						
					</div>
					
					<div class="<?php echo $colset3; ?> ">
						
						<?php if( get_sub_field('bild') ) { ?>						
						<?php if( $breite == 'normal' ) { ?>
						<div class="padding"></div>
						<?php } ?>
						<div class="colimg <?php if( $showlink == 1 ) { ?>galimg<?php } ?>">
							<?php if( $showlink == 1 ) { ?>
							<a href="<?php the_sub_field('link') ?>">
							<?php } ?>
							<picture>
								<source 
									media="(max-width: 480px)" 
									srcset="<?php echo $colimg_s; ?>">						
								<img 
									src="<?php echo $colimg; ?>" 
									alt="<?php echo esc_html( $colimgalt ); ?>">
				    		</picture>
				    		<?php if( $showlink == 1 ) { ?>
							</a>
							<?php } ?>
						</div>						
						<?php if( $breite == 'normal' ) { ?>
						<?php if( get_sub_field('bildbeschreibung') ) { ?>
						<p class="caption">
							<?php the_sub_field('bildbeschreibung'); ?>
						</p>
						<?php } ?>
						<div class="padding"></div>
						<?php } ?>						
						<?php } ?>						
					</div>
					
				</div>
				
				<?php if( $breite == 'normal' ) { ?>
				<div class="padding"></div>
				<?php } ?>
				
			</div>
			
		</div>
		
	</div>
	
	<?php unset( $lastbg );
		unset( $colimgid );
		unset( $colimg ); 
		unset( $colimg_s ); 
		$lastbg = $thisbg; ?>
		
		

<?php } // Text + Text
	elseif( get_row_layout() == 'texttext' ) { 
		$sectioncount++; ?>
	
	<?php $thisbg 	= get_sub_field('hintergrund'); ?>
		
	<div class="<?php echo $thisbg; ?> s_texttext <?php echo $breite; ?>">
	
		<div class="outer">
			
			<div class="wrap">
				
				<div class="padding"></div>
				<?php if( $thisbg != $lastbg  ) { ?>
				<div class="padding"></div>
				<?php } ?>
				
				<?php if( get_sub_field('topline') || get_sub_field('headline') ) { ?> 
				<div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12">
					
					<?php if( get_sub_field('topline') ) { ?>
					<p class="topline <?php the_sub_field('ausrichtung'); ?>"><?php the_sub_field('topline'); ?></p>
					<?php } ?>
					
					<?php if( get_sub_field('headline') ) { ?>
					<?php if( $sectioncount == 1 ) { ?>
					<h2 class="pagetitle <?php the_sub_field('ausrichtung'); ?>"><?php the_sub_field('headline'); ?></h2>
					<?php } else { ?>
					<h3 class="sectiontitle <?php the_sub_field('ausrichtung'); ?>"><?php the_sub_field('headline'); ?></h3>
					<?php } ?>
					<?php } ?>
					
					<div class="padding"></div>
					<div class="padding"></div>
					
				</div>
				<?php } ?>
			
				<div class="col-xs-12 col-s-12 col-sm-12 col-m-6 col-ml-6 col-l-6 col-xl-6">
						
					<div class="innerr texttextcol">
						<?php the_sub_field('text'); ?>
					</div>
						
					<div class="padding"></div>
						
				</div>
						
				<div class="col-xs-12 col-s-12 col-sm-12 col-m-6 col-ml-6 col-l-6 col-xl-6">
						
					<div class="innerl texttextcol">
						<?php the_sub_field('text2'); ?>
					</div>
					
					<div class="padding"></div>
						
				</div>
				
				<div class="padding"></div>
				
			</div>
			
		</div>
		
	</div>
	
	<?php unset( $lastbg );
		$lastbg = $thisbg; ?>
		
	
		

<?php } // Galerie
	elseif( get_row_layout() == 'galerie' ) { ?>
	
	<?php $thisbg = 'bgwhite'; ?>
			
	<div class="<?php echo $thisbg; ?> s_galerie">
	
		<div class="outer">
			
			<div class="wrap">
				
				<div class="padding"></div>
				<?php if( $thisbg != $lastbg  ) { ?>
				<div class="padding"></div>
				<?php } ?>
				
				<?php if( get_sub_field('topline') || get_sub_field('headline') ) { ?> 
				<div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12">
					
					<?php if( get_sub_field('topline') ) { ?>
						<p class="topline textcenter"><?php the_sub_field('topline'); ?></p>
					<?php } ?>
					
					<?php if( get_sub_field('headline') ) { ?>
						<h3 class="sectiontitle textcenter"><?php the_sub_field('headline'); ?></h3>
					<?php } ?>
					
					<div class="padding"></div>
					<div class="padding"></div>
					
				</div>
				<?php } ?>
				
			</div>
			
			<div class="wrap">
				
				<div class="heights">
				
					<?php while( has_sub_field('bilder') ) { ?>				
					<div class="col-xs-6 col-s-6 col-sm-6 col-m-3 col-ml-3 col-l-3 col-xl-3">
						
						<div class="galitem height">
							<?php $galimgid = get_sub_field('bild');
								$galimg 	= $galimgid['sizes'][ 'square' ];
								$galimg_s	= $galimgid['sizes'][ 'square_s' ];
								$galimg_l 	= $galimgid['sizes'][ 'large' ]; 
								$galimgalt 	= $galimgid['alt']; ?>										
							<div class="galimg">
								<a rel="lightbox" href="<?php echo $galimg_l; ?>">
									<picture>
										<source 
											media="(max-width: 480px)" 
											srcset="<?php echo $galimg_s; ?>">						
										<img 
											src="<?php echo $galimg; ?>" 
											alt="<?php echo esc_html( $galimgalt ); ?> <?php the_sub_field('beschreibung'); ?>">
						    		</picture>
								</a>
							</div>
							<?php if( get_sub_field('bildbeschreibung') ) { ?>
							<p class="caption">
								<?php the_sub_field('bildbeschreibung'); ?>
							</p>
							<?php } ?>
						</div>
						
						<div class="padding"></div>
						
					</div>				
					<?php } ?>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="padding"></div>
		
	</div>
	
	<?php unset( $lastbg );
		$lastbg = $thisbg; ?>
		
		
		

<?php } // Teaser
	elseif( get_row_layout() == 'teaser' ) { ?>
	
	<?php $thisbg = get_sub_field('hintergrund'); ?>
		
	<div class="<?php echo $thisbg; ?> s_teaser">
	
		<div class="outer">
			
			<div class="wrap">
				
				<div class="padding"></div>
				<?php if( $thisbg != $lastbg  ) { ?>
				<div class="padding"></div>
				<?php } ?>
				
				<?php if( get_sub_field('topline') || get_sub_field('headline') ) { ?> 
				<div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12">
					
					<?php if( get_sub_field('topline') ) { ?>
						<p class="topline textcenter"><?php the_sub_field('topline'); ?></p>
					<?php } ?>
					
					<?php if( get_sub_field('headline') ) { ?>
						<h3 class="sectiontitle textcenter"><?php the_sub_field('headline'); ?></h3>
					<?php } ?>
					
					<div class="padding"></div>
					<div class="padding"></div>
					
				</div>
				<?php } ?>
				
			</div>
			
			<div class="wrap teasers">
								
				<?php while( has_sub_field('teaser') ) { ?>				
				<div class="col-xs-12 col-s-12 col-sm-12 col-m-6 col-ml-6 col-l-6 col-xl-6">
					
					<div class="teaser">
					
						<a href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('titel'); ?> <?php if( is_front_page() ) { ?>Spezialist Wien<?php } ?>">
							<div class="teaserinner">
							<h4>
								<span class="teaserinfo">Spezialist für </span>
								<?php if( get_sub_field('topline') ) { ?>
								<span class="teasertopline"><?php the_sub_field('topline'); ?></span>
								<?php } ?>
								<?php the_sub_field('titel'); ?>
							</h4>
							<?php if( get_sub_field('text') ) { ?>
							<p><?php the_sub_field('text'); ?></p>
							<?php } ?>	
							</div>							
						</a>
						
					</div>
					
					<div class="padding"></div>
					
				</div>			
				<?php } ?>
					
			</div>
			
		</div>
		
		<div class="padding"></div>
		
	</div>
		
	<?php unset( $lastbg );
		$lastbg = $thisbg; ?>
		
		
		
<?php } // FAQ
	elseif( get_row_layout() == 'faq' ) { ?>
	
	<?php $thisbg = get_sub_field('hintergrund'); ?>
		
	<div class="<?php echo $thisbg; ?> s_faq">
	
		<div class="outer">
			
			<div class="wrap">
				
				<div class="padding"></div>
				
				<?php if( get_sub_field('topline') || get_sub_field('headline') ) { ?> 
				<div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12">
					
					<?php if( get_sub_field('topline') ) { ?>
						<p class="topline textcenter"><?php the_sub_field('topline'); ?></p>
					<?php } ?>
					
					<?php if( get_sub_field('headline') ) { ?>
						<h3 class="sectiontitle textcenter"><?php the_sub_field('headline'); ?></h3>
					<?php } ?>
					
					<div class="padding"></div>
					
				</div>
				<?php } ?>
				
			</div>
			
			<div class="wrap faqs">
								
				<?php while( has_sub_field('faqs') ) { ?>				
				
				<div class="col-xs-0 col-s-0 col-sm-1 col-m-2 col-ml-2 col-l-2 col-xl-2"></div>
				
				<div class="col-xs-12 col-s-12 col-sm-10 col-m-8 col-ml-8 col-l-8 col-xl-8">
					
					<div class="faq">
						
						<h4 class="frage"><?php the_sub_field('frage'); ?></h4>
						
						<div class="antwort">
							<div class="antwortinner">
								<?php the_sub_field('text'); ?>
							</div>
						</div>
											
					</div>
					
				</div>	
				<div class="clear"></div>		
				<?php } ?>
					
			</div>
			
		</div>
		
		<div class="padding"></div>
		
	</div>
		
	<?php unset( $lastbg );
		$lastbg = $thisbg; ?>
		
		
		

<?php } // Tabelle
	elseif( get_row_layout() == 'tabelle' ) { ?>
	
	<?php $thisbg = get_sub_field('hintergrund'); 
		$breite = get_sub_field('breite');	
		if( $breite == 'normal' ) {
		   $colset1 = 'col-xs-1 col-s-1 col-sm-1 col-m-2 col-ml-2 col-l-2 col-xl-2' ;
		   $colset2 = 'col-xs-10 col-s-10 col-sm-10 col-m-8 col-ml-8 col-l-8 col-xl-8';
		} elseif( $breite == 'wide' ) {
		   $colset1 = 'col-xs-0 col-s-0 col-sm-0 col-m-0 col-ml-0 col-l-0 col-xl-0' ;
		   $colset2 = 'col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12';
		} ?>
			
	<div class="<?php echo $thisbg; ?> s_tabelle">
	
		<div class="outer">
			
			<div class="wrap">
				
				<div class="<?php echo $colset1; ?>"></div>
				
				<div class="<?php echo $colset2; ?>">
					
					<div class="padding"></div>
					<?php if( $thisbg != $lastbg  ) { ?>
					<div class="padding"></div>
					<?php } ?>
					
					<?php if( get_sub_field('topline') ) { ?>
					<p class="topline <?php the_sub_field('ausrichtung'); ?>"><?php the_sub_field('topline'); ?></p>
					<?php } ?>
					
					<?php if( get_sub_field('headline') ) { ?>
					<?php if( $sectioncount == 1 ) { ?>
					<h2 class="pagetitle <?php the_sub_field('ausrichtung'); ?>"><?php the_sub_field('headline'); ?></h2>
					<?php } else { ?>
					<h3 class="sectiontitle <?php the_sub_field('ausrichtung'); ?>"><?php the_sub_field('headline'); ?></h3>
					<?php } ?>
					<?php } ?>
					
					<?php if( get_sub_field('topline') || get_sub_field('headline') ) { ?> 
					<div class="padding"></div>
					<?php } ?>
					
					<?php if( get_sub_field('tabelle') ) { ?>
					<table>
						<tbody>
							<?php while( has_sub_field('tabelle') ) { ?>
							<tr class="<?php if( !get_sub_field('col2') ) { ?>coltitle<?php } ?>">
								<td class="col1" <?php if( !get_sub_field('col2') ) { ?>colspan="2"<?php } ?>>
									<?php the_sub_field('col1'); ?>
								</td>
								<?php if( get_sub_field('col2') ) { ?>									
								<td class="col2">
									<?php the_sub_field('col2'); ?>
								</td>
								<?php } ?>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<?php } ?>
					
					<div class="padding"></div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="padding"></div>
		
	</div>
	
	<?php unset( $lastbg );
		$lastbg = $thisbg; ?>
		
		
		

<?php } // CTA
	elseif( get_row_layout() == 'cta' ) { ?>
	
	<?php $thisbg = get_sub_field('hintergrund'); ?>
		
	<div class="<?php echo $thisbg; ?> s_cta cta">
		
		<div class="outer">
		
			<div class="wrap">
				
				<div class="padding"></div>
				<div class="padding"></div>
				
				<div class="aligner">
					
					<div class="col-xs-12 col-s-12 col-sm-8 col-m-8 col-ml-8 col-l-8 col-xl-8">
					
						<p><?php the_sub_field('text'); ?></p>
						
						<div class="padding"></div>
						
					</div>
					
					<div class="col-xs-12 col-s-12 col-sm-4 col-m-4 col-ml-4 col-l-4 col-xl-4 textcenter">
						
						<?php if( get_sub_field('linkziel') == 'kontakt' ) { ?>
						<span class="button">
							<a class="scrolly" href="#kontakt"><?php the_sub_field('linktext'); ?></a>
						</span>
						<?php } else { ?>
						<span class="button">
							<a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('linktext'); ?></a>
						</span>
						<?php } ?>
						
						<div class="padding"></div>
						
					</div>
					
				</div>
				
				<div class="padding"></div>
				
			</div>
			
		</div>
		
	</div>
	
	<?php unset( $lastbg );
		$lastbg = $thisbg; ?>
		
	

	
<?php // ELEMENTE
	} elseif( get_row_layout() == 'elemente' ) { ?>
	
	<?php $element = get_sub_field('element');
			
	if( $element == 'padding' ) { 
		$thisbg 	= get_sub_field('hintergrund'); 
		$thiscol 	= get_sub_field('farbe'); ?>
	<div class="<?php echo $thisbg; ?>"> <?php // outer full ?>
		<div class="padding"></div>
	</div>
	
	<?php } 
		if( $element == 'line' ) { 
			$thisbg 	= get_sub_field('hintergrund'); 
			$thiscol 	= get_sub_field('farbe'); ?>			
	<div class="<?php echo $thisbg; ?> outer">	
		<div class="wrap">
			<div class="col-xs-0 col-s-1 col-sm-2 col-m-2 col-ml-2 col-l-2 col-xl-2"></div>
			<div class="col-xs-12 col-s-10 col-sm-8 col-m-8 col-ml-8 col-l-8 col-xl-8">
				<div class="line <?php echo $thiscol; ?>"></div>
			</div>
		</div>	
	</div>
	
	<?php } 
		if( $element == 'elementid' ) { ?>
	
	<?php } 
		if( $element == 'elementid' ) { ?>
	
	<?php } 
		if( $element == 'elementid' ) { ?>

	<?php } ?>
	
	
<?php // 
	} elseif( get_row_layout() == 'contentid' ) { ?>
	
	
<?php } ?>

<?php endwhile; ?>
<?php } ?>
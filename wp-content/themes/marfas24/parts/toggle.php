<?php if(get_field('faq')) { ?>

<div class="padding"></div>

<section id="faq">

	<dl class="accordion">

	<?php $i = 0; ?>
	<?php while(has_sub_field('faq')) { ?>
	<?php $i++; ?>
	      
		<section id="frage-<?php echo $i; ?>" class="acc_item js-acc_item">
		      
			<dt class="acc_title js-trigger">
				<h4><?php the_sub_field('frage'); ?></h4>
			</dt>
		      
			<dd class="acc_content is-hidden js_acc_content">
		        
		       <p><?php the_sub_field('antwort'); ?></p>
		        	
			</dd>
	        
		</section>
		
	<?php } ?>
	
	</dl>
	
</section>

<?php } ?>
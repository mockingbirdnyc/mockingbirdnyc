<?php while ( have_posts() ) : the_post();?>
	<div class="container contain_default">
		<?php the_title('<h1>','</h1>',TRUE)?>
		<?php the_content();?>
		<?php
			if ( comments_open() ) {
				comments_template();
			}
		?>
	</div>
<?php endwhile;?>
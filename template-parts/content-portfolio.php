<?php
/**
 * The template used for displaying portfolio contents
 *
 * @package Designfly
 */

?>
<div class="portfolio__data">
	<?php the_post_thumbnail(); ?>
	<div class="portfolio__overlay">
		<div class="portfolio__text">
			<span class="dashicons dashicons-editor-unlink"></span>
			<p class="portfolio-item"> <?php esc_html_e( 'View Image', 'designfly' ); ?></p>
		</div>
	</div>
</div>

<!-- Portfolio Modal -->
<div id="myModal" class="modal">
	<span class="close">&times;</span>
	<div class="modal__data">
		<img class="modal-content" id="img01">
		<div id="modal-caption" class="modal-caption"><?php the_title(); ?></div>
	</div>
</div>

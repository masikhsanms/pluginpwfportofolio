<div id="page-pwf-porto">
	<?php 
		$big = 999999999; // need an unlikely integer
		echo paginate_links( array(
		    // 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		    // 'format' => '?paged=%#%',
		    'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
		    'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		    'prev_next' => true,
		    'current' => max( 1, $current ),
		    'total' => $query->max_num_pages
		) );
	 ?>
</div>
<?php wp_reset_postdata(); ?>
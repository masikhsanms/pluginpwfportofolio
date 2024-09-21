<ul class="card-pwf-content">
			<?php 
				if ( $query->have_posts() ) {

		            while ( $query->have_posts() ) {

		                $query->the_post();

		                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 

		            ?>
		            	<li class="item-content-pwf">
		            		<a data-id="<?= get_the_ID(); ?>" href="javascript:void(0)" class="img-view-pwf" ><img src="<?= $featured_img_url; ?>" alt="pwf potofolio" class="pwf-img"></a>
		            		<div class="text-desc-pwf">
		            			<p class="judul-pwf"><?= __(get_the_title(),'lima'); ?></p>
		            			<?= apply_filters('the_content',__(get_the_excerpt(),'lima') ); ?>
		            		</div>
		            		<?php 
		            			$get_meta_custom_url = get_post_meta(get_the_ID(),'_link_download_pwf',true);
		            			
		            			// $path_parts = (empty($get_meta_custom_url ) ) ? pathinfo($featured_img_url) : pathinfo($get_meta_custom_url) ;
		            			// print_r($path_parts['basename']);
		            			$url_img = ( empty($get_meta_custom_url ) ) ? $featured_img_url : $get_meta_custom_url; 
		            		?>
		            		<div class="download-icon">
		            			<a download class="download-lima" href="<?= $url_img; ?>">
		            				<img src="<?= LIMA_PWF_URL.'/img/Download.png'; ?>" class="img-download">
		            			</a>
		            		</div>
		            	</li>
		            <?php } ?>
		            <?php 
		        }
			 ?>
		</ul>
		<div class="modal-pwf-loading"><!-- Place at bottom of page --></div>

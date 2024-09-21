<div class="content-modal-detail">
<?php
$postID = $post->ID; 
$featured_img_url = get_the_post_thumbnail_url($postID,'full'); 
?>
	<img src="<?= $featured_img_url; ?>" alt="pwf potofolio" class="pwf-img"></a>
	<div class="text-desc-pwf">
		<p class="judul-pwf"><?= __($post->post_title,'lima'); ?></p>
		<?= apply_filters('the_content',__(get_the_excerpt($postID),'lima') ); ?>
	</div>
	<?php 
		// $path_parts = pathinfo($featured_img_url);
		$get_meta_custom_url = get_post_meta($postID,'_link_download_pwf',true);

		$url_img = ( empty($get_meta_custom_url ) ) ? $featured_img_url : $get_meta_custom_url; 
	?>
	<div class="download-icon">
		<a download class="download-lima" href="<?= $url_img; ?>">
			<!-- <i class="fa fa-cloud-download" aria-hidden="true"></i> -->
			<img src="<?= LIMA_PWF_URL.'/img/donwloadnew.png'; ?>" class="img-download">
		</a>
	</div>

</div>
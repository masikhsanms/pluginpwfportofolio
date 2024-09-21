<?php 
class LimaFrontPwf
{
	
	function __construct()
	{
		$this->hook();
		$this->filter();
	}

	public function hook()
	{
		add_shortcode('lima-pwf-portofolio',[$this,'lima_pwf_shortcode']);

		add_action('wp_ajax_get_handle_tab',[$this,'get_handle_tab']);
		add_action('wp_ajax_nopriv_get_handle_tab',[$this,'get_handle_tab']);

		add_action('wp_ajax_get_paginate_lima',[$this,'get_paginate_lima']);
		add_action('wp_ajax_nopriv_get_paginate_lima',[$this,'get_paginate_lima']);

		add_action('wp_ajax_get_data_portofolio',[$this,'get_data_portofolio']);
		add_action('wp_ajax_nopriv_get_data_portofolio',[$this,'get_data_portofolio']);

		// add_action('wp_ajax_get_img_curl',[$this,'get_img_curl']);
		// add_action('wp_ajax_nopriv_get_img_curl',[$this,'get_img_curl']);		
	}

	public function get_img_curl()
	{
		// print_r($_POST);
		$url = $_POST['url'];
		$path = pathinfo($url);
		$name = $path['basename'];
		$upload_dir = wp_upload_dir();
		$img = $upload_dir['path'].'/'.$name;
		// $save_content_to_path = file_put_contents($img, file_get_contents($url));
		
	    if(!file_exists($name)) die("I'm sorry, the file doesn't seem to exist.");

	    $type = filetype($name);
	    // Get a date and timestamp
	    $today = date("F j, Y, g:i a");
	    $time = time();
	    // Send file headers
	    header("Content-type: $type");

	    //** If you think header("Content-type: $type"); is giving you some problems,
	    //** try header('Content-Type: application/octet-stream');

	    //** Note filename= --- if using $_GET to get the $file, it needs to be "sanitized".
	    //** I used the basename function to handle that... so it looks more like:
	    //** header('Content-Disposition: attachment; filename=' . basename($_GET['mygetvar']));

	    header("Content-Disposition: attachment;filename=$name");
	    header("Content-Transfer-Encoding: binary"); 
	    header('Pragma: no-cache'); 
	    header('Expires: 0');
	    
	    // print_r($type);
	    // Send the file contents.
	    flush();
	    readfile($name);

		die();
	}

	public function filter()
	{
		add_filter( 'excerpt_length', [$this,'lima_excerpt_length']);
	}

	public function lima_pwf_shortcode()
	{
		ob_start();
		
		$tab_categori = $this->get_pwf_category();

		// $query = $this->get_pwf_posts();

		include LIMA_TEMPLATE_DIR.'/shortcode/pwf-portofolio.php';
		return ob_get_clean();
	}

	public function get_pwf_category()
	{
		 $cats = get_terms('kategori_pwf');
		 $cat_opt = '<ul class="tb-pwf">';
		 foreach($cats as $cat){
		 	if ($cat->count > 1) {
		 		
		     $cat_opt .= '<li class="item-pwf"><a data-id="'.$cat->term_id.'" class="link-pwf" href="javascript:void(0)" ><span class="pwf-count">'.$cat->count.'</span>'.$cat->name.'</a></li>';
		 	}
		 }
		 $cat_opt .= '</ul>';
		 return $cat_opt;
	}

	public function get_pwf_posts($term_id,$paged)
	{
		$args = array(
			'post_type' => 'portofolio_pwf',
			'post_status' => 'publish',
			'posts_per_page' => 12,
			'paged' => $paged, 
			'tax_query' => array(
		        array(
		            'taxonomy' => 'kategori_pwf',
		            'terms' => $term_id,
		            'field' => 'term_id',
		        )
    		)
		);

		return $query = new WP_Query( $args );
	}

	public function generate_pagination_html($query,$current=1){
		ob_start();
		include LIMA_TEMPLATE_DIR.'/shortcode/pagination-grid.php';
	}

	public function lima_excerpt_length( $length ) {
    	return 10;
	}

	public function get_handle_tab()
	{
		$termid = $_POST['termid'];
		$paged = 1;

		$query = $this->get_pwf_posts($termid,$paged);

		// print_r($query);
		$result_html = $this->content_grid_lima($query);

		$pagination = $this->generate_pagination_html($query);	

		wp_die();
	}

	public function content_grid_lima($query)
	{
		ob_start();
		include LIMA_TEMPLATE_DIR.'/shortcode/pwf-content-portofolio.php';
		// return ob_get_clean();
	}

	public function get_paginate_lima()
	{
		$paged = $_POST['page'];
		$id_term = $_POST['id_term'];

		$query = $this->get_pwf_posts($id_term,$paged);

		// print_r($query);
		$result_html = $this->content_grid_lima($query);

		$pagination = $this->generate_pagination_html($query,$paged);	
		die();
	}

	public function get_data_portofolio()
	{
		$postid = $_POST['id_post'];
		
		$post = get_post($postid);

		$detail_modal = $this->detail_post_modal($post);
		// print_r($post);
		
		die();
	}

	public function detail_post_modal($post)
	{
		ob_start();
		include LIMA_TEMPLATE_DIR.'/shortcode/modal-detail.php';
	}

}

$LimaFrontPwf = new LimaFrontPwf();
?>
<?php 
class LimaPwfAdmin
{
	
	function __construct()
	{
		$this->hook();
	}

	public function hook()
	{
		add_action( 'init', [$this,'pwf_menu'], 0 );
		add_action('admin_menu', [$this,'a_qoute_admin_action']);
		add_action('add_meta_boxes', [$this,'link_custom_download']);
		add_action('save_post', [$this,'save_meta_custom_link'] );
	}

	public function link_custom_download()
	{
		$screens = 'portofolio_pwf';
	    add_meta_box(
	        'lima_download_id',          
	        'Custom Link URL Download', 
	        [$this,'callback_html_download'],
	        $screens  
	    );
	}

	public function callback_html_download( $post )
	{
		ob_start();
		
		$postid	= $post->ID;
		$getmeta = get_post_meta($postid,'_link_download_pwf',true) ;
		$url = ( !empty($getmeta) ) ? $getmeta : '' ;

		include LIMA_TEMPLATE_DIR.'/admin/link-custom-html.php';
		// return ob_get_clean();
	}

	public function save_meta_custom_link( $post_id )
	{
		$url = ( isset($_POST['_link_download_pwf']) ) ? $_POST['_link_download_pwf'] : '';
		if (isset($url) || empty($url)) {
			update_post_meta($post_id,'_link_download_pwf',$url);
		}
	}

	public function pwf_menu()
	{
		// Set UI labels for Custom Post Type
	    $labels = array(
	        'name'                => _x( 'Portofolio', 'Post Type General Name', 'lima' ),
	        'singular_name'       => _x( 'Portofolio', 'Post Type Singular Name', 'lima' ),
	        'menu_name'           => __( 'Portofolio', 'lima' ),
	        'parent_item_colon'   => __( 'Parent Portofolio', 'lima' ),
	        'all_items'           => __( 'All Portofolio', 'lima' ),
	        'view_item'           => __( 'View Portofolio', 'lima' ),
	        'add_new_item'        => __( 'Add New Portofolio', 'lima' ),
	        'add_new'             => __( 'Add New', 'lima' ),
	        'edit_item'           => __( 'Edit Portofolio', 'lima' ),
	        'update_item'         => __( 'Update Portofolio', 'lima' ),
	        'search_items'        => __( 'Search Portofolio', 'lima' ),
	        'not_found'           => __( 'Not Found', 'lima' ),
	        'not_found_in_trash'  => __( 'Not found in Trash', 'lima' ),
	    );

	    $supports = [
	    				'title',
	    				'editor', 
	    				'thumbnail',
	    				// 'tag' 
	    				// 'excerpt', 
	    				// 'author', 
	    				// 'comments', 
	    				// 'revisions', 
	    				// 'custom-fields' 
	    			];

	    $tax = 'kategori_pwf';
	     
		// Set other options for Custom Post Type
	    $args = array(
	        'label'               => __( 'Portofolio', 'lima' ),
	        'description'         => __( 'Portofolio news and reviews', 'lima' ),
	        'labels'              => $labels,
	        'supports'            => $supports,
	        'hierarchical'        => false,
	        'public'              => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_nav_menus'   => true,
	        'show_in_admin_bar'   => true,
	        'menu_icon'			  => 'dashicons-images-alt2',
	        'menu_position'       => 5,
	        'can_export'          => true,
	        'has_archive'         => true,
	        'exclude_from_search' => false,
	        'publicly_queryable'  => true,
	        'capability_type'     => 'post',
	        'show_in_rest' => true,
	        'taxonomies' => array('kategori_pwf'), // this is IMPORTANT 
	        'rewrite' => array( 'slug' => 'portofolio_pwf', 'with_front'=> false ),
	    );
	     
	    // Registering your Custom Post Type
	    register_post_type( 'portofolio_pwf', $args );

	    // Registering your TAXONOMY Custom Post Type
	    register_taxonomy( $tax, array('portofolio_pwf'), array(
	        'hierarchical' => true, 
	        'label' => 'Kategori', 
	        'singular_label' => 'Kategori', 
	        'rewrite' => array( 'slug' => $tax, 'with_front'=> false )
	        )
    	);

    	register_taxonomy_for_object_type( $tax, 'post' );
	}

	public function a_qoute_admin_action(){
	    add_submenu_page(
	        'edit.php?post_type=portofolio_pwf',
	        'Pengaturan', //page title
	        'Pengaturan', //menu title
	        'manage_options', //capability,
	        'peangtuaran_pwf',//menu slug
	        [$this,'pwf_callback_pengaturan'] //callback function
	    );
	}

	public function pwf_callback_pengaturan()
	{
		include LIMA_TEMPLATE_DIR.'/admin/pengaturan.php';	
	}
}

$LimaPwfAdmin = new LimaPwfAdmin();
?>
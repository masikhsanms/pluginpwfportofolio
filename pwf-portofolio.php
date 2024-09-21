<?php 
/*
* Plugin Name: PWF Portofolio
* Description: Poftofolio With Filter, Showing image and filter Tab Content 2020
* Version: 1.0
* Plugin URI: https://limamultimedia.com
* Author: LimaMultimedia
* Author URI: https://limamultimedia.com
*/

define('LIMA_PLUGIN_VERSION', rand(0,999));
define( 'LIMA_PWF_DIR', plugin_dir_path( __FILE__ ));
define( 'LIMA_PWF_URL', plugin_dir_url( __FILE__ ));
define( 'LIMA_TEMPLATE_DIR', plugin_dir_path( __FILE__ ).'/templates/');

include 'functions.php';
include 'download.php';

$classes = ['pwf-admin','pwf-front'];
foreach ($classes as  $class) {
	include 'classes/class-'.$class.'.php';
}

add_action('admin_enqueue_scripts','lima_vc_load_scripts');
add_action('wp_enqueue_scripts','lima_vc_load_scripts');
function lima_vc_load_scripts(){
	
	wp_enqueue_style('lima-css',plugins_url('css/lima.css',__FILE__),array(),LIMA_PLUGIN_VERSION,'all');

	wp_enqueue_style('fa-font','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',array(),LIMA_PLUGIN_VERSION,'all');
	
	wp_enqueue_script('modal-lima',plugins_url('js/lima-modal.js',__FILE__),array('jquery'),LIMA_PLUGIN_VERSION,true);

	//ENQUEUE AND WP LOCALIZE
	wp_enqueue_script('lima-js',plugins_url('js/lima.js',__FILE__),array('jquery'),LIMA_PLUGIN_VERSION,true);
	wp_enqueue_script('lima-download-js',plugins_url('js/jquery.fileDownload.js',__FILE__),array('jquery'),LIMA_PLUGIN_VERSION,true);


	wp_localize_script( 'lima-js', 'lima',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        )
    );
}

?>
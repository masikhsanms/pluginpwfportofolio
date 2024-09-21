<?php 

//Tidak Dipakai
function get_download_manual(){

	if (isset($_GET['url_img'])) {
		
		$get_url = urldecode( $_GET['url_img'] );
		$path = pathinfo($get_url);
		$name = $path['basename'];		
		$type = filetype($name);
		$curl = file_get_contents( $get_url);
		
		$urlhost = site_url(); 

		header("Access-Control-Allow-Origin: $urlhost");
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Methods: GET');
		header('Access-Control-Allow-Headers: content-type or other');
		header("content-type:$type");

		// print_r($curl);
	    header("Content-Disposition: attachment;filename=$name");
	    header("Content-Transfer-Encoding: binary"); 
	    header('Pragma: no-cache'); 
	    header('Expires: 0');
	    
	    // print_r($type);
	    // Send the file contents.
	    set_time_limit(0);
    	ob_clean();
	    flush();
	    readfile($name);
	}
}
// add_action('init','get_download_manual');	
?>
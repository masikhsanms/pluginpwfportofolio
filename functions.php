<?php 

add_action('wp_footer','pwf_modal');
function pwf_modal(){
	?>
	<!-- The Modal -->
	<div id="pwfModal" class="modal-pwf">

	  <!-- Modal content -->
	  <div class="modal-content-pwf">
	  	<span class="plus"><i class="fa fa-plus-circle" style="font-size:24px"></i></span>
	  	<span class="min"><i class="fa fa-minus-circle" style="font-size:24px"></i></span>
	    <span class="close"><i class="fa fa-times-circle" style="font-size:24px"></i></span>
	    <p>Some text in the Modal..</p>
	  </div>

	</div>
	<?php
}

?>
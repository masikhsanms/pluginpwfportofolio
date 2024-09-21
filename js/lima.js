jQuery(document).ready(function(){
	lima_tab_click();
	paginate_lima_post();
	load_lib_first();
	handle_detail_modal();
	max_btn();
	min_btn_pwf();
	close_btn_pwf();
	// download_btn_pwf();
});

var $ = jQuery;

function load_lib_first(){
	
	$('body .tab-content-pwf').find('li.item-pwf:first-child a').trigger("click");

}

function lima_tab_click(){
	$('body').find('.tab-content-pwf ').on('click','.item-pwf a',function(){
		var id_term = $(this).data('id'),
			data = {action:'get_handle_tab','termid':id_term},
			$this = $(this);
		
		$(this).parent().addClass('active').siblings().removeClass('active');
		
		$('.body-portofolio-pwf').find('.rows-lima').addClass("loading");

		$.ajax({
			url:lima.ajaxurl,
			data:data,
			type:'POST',
			// dataType:,
			success: function(response)
			{
				$('.body-portofolio-pwf').find('.rows-lima').removeClass("loading");
				$this.closest('.body-portofolio-pwf').find('.rows-lima').html(response);
				$this.closest('.body-portofolio-pwf').find('.hidd-term').val(id_term);
				// console.log(response);
				
			}
		});
	});
}

function find_page_number(element) {
    element.find('span').remove();
    return parseInt(element.html());
}

function getnumber_url(urls){
	var url = urls;
	var arr = url.split('/');
	var pageNum = arr[arr.indexOf('page') + 1];
	
	if (pageNum == '') {
		pageNum = 1;
	}else{
		pageNum;
	}

	return pageNum;
}

function paginate_lima_post(){
	$('body').on('click', '#page-pwf-porto a.page-numbers', function(e){
		e.preventDefault();
	$("#page-pwf-porto span").replaceWith(function(){
		    return this.outerHTML.replace("<span", "<a").replace("</span", "</a")
		});		
		$('#page-pwf-porto a.page-numbers').removeClass('current');
        $(this).addClass('current');

        let url = $(this).attr('href');

        $("html, body").animate({scrollTop: 0}, 1000);

		// let page = find_page_number(jQuery(this).clone());
		let page = getnumber_url(url);
		
		let idTerm = $('.hidd-term').val();
		let $this = $(this);
		let data = {action: 'get_paginate_lima', 'page':page,'id_term':idTerm};

		// lima_block_element('.merge-child-grid');
		$('.body-portofolio-pwf').find('.rows-lima').addClass("loading");
		
		$.ajax({
			url:lima.ajaxurl,
			data:data,
			type:'POST',
			// dataType:'json',
			success: function(response){
				
				// console.log(response);
				$('.body-portofolio-pwf').find('.rows-lima').removeClass("loading");
				$this.closest('.body-portofolio-pwf').find('.rows-lima').html(response);
			},
			error: function(xhr, status, error){
				let pess_err = xhr.status + ' ' + xhr.statusText;
				$('.body-portofolio-pwf').find('.rows-lima').removeClass("loading");
				alert('Error -' + pess_err);

			}
		});
	});
}

function handle_detail_modal(){
	$('body').on('click','.img-view-pwf',function(){
		$(this).closest('body').find('#pwfModal').css('display','block');	
		
		let id_post = $(this).data('id'),
			$this = $(this),
			data = {action:'get_data_portofolio','id_post':id_post};
		
		$('.body-portofolio-pwf').find('.rows-lima').addClass("loading");
		
		$.ajax({
			url:lima.ajaxurl,
			data:data,
			type:'POST',
			// dataType:'json',
			success: function(response){
				
				$('.body-portofolio-pwf').find('.rows-lima').removeClass("loading");
				// console.log(response);
				$('body').find('.modal-content-pwf p').html(response);
			},
			error: function(xhr, status, error){
				let pess_err = xhr.status + ' ' + xhr.statusText;
				// $('.body-portofolio-pwf').find('.rows-lima').removeClass("loading");
				alert('Error -' + pess_err);

			}
		});
	});
}

function max_btn(){
	$('body').find('#pwfModal').on('click','.plus i',function(){
    	 $(this).closest('#pwfModal').find('.modal-content-pwf').css('transform' ,'scale(1.2)');
    	// alert('test');
    }); 
}
function min_btn_pwf(){
	$('body').find('#pwfModal').on('click','.min i',function(){
    	 $(this).closest('#pwfModal').find('.modal-content-pwf').css('transform' ,'scale(1)');
    	// alert('test');
    }); 
}

function close_btn_pwf(){
	$('body').find('#pwfModal').on('click','.close i',function(){
    	 $(this).closest('#pwfModal').find('.modal-content-pwf').css('transform' ,'scale(1)');
    	// alert('test');
    }); 
}

/*
function download_btn_pwf(){
	$('body').on('click','a.download-lima',function(){
		// window.location.href = 'download.php';
		// console.log(location.origin'download.php');

		// let url = $(this).data('id'),
		// 	data = {action:'get_img_curl','url':url};

		// console.log(url);
		// load(url);
		// downloadFile(url);

		
		$.ajax({
			url:lima.ajaxurl,
			data: data,
			type:'POST',
			success: function(response){
				console.log(response);
				// location.href = response;
				// SaveToDisk(fileURL, fileName);
			},
			error: function(xhr, status, error){
				alert('LIMA Error - '+ xhr.status);
			}
		}); 
	});
}

 // function downloadFile(urlToSend) {
 //     var req = new XMLHttpRequest();
 //     req.open("GET", urlToSend, true);
 //     req.setRequestHeader( 'Access-Control-Allow-Origin', '*');
 //     req.responseType = "blob";
 //     req.onload = function (event) {
 //         var blob = req.response;
 //         var fileName = req.getResponseHeader("fileName") //if you have the fileName header available
 //         var link=document.createElement('a');
 //         link.href=window.URL.createObjectURL(blob);
 //         link.download=fileName;
 //         link.click();
 //     };

 //     req.send();
 // }
 */
$(window).load(function(){
	
	var baseUrl = $('#base_url').val();
	var csrfToken = $('meta[name="csrf-token"]').attr('content');
	
	$('.image_section').hide();
	$('.audio_section').hide();
	$('.video_section').hide();
	$('.meta_section').show();
	
	var story_type = $('#story_type').val();
	
	if(story_type == "video"){
		$('.image_section').hide();
		$('.video_section').show();
	}else if(story_type == "image" || story_type == "features"){
		$('.image_section').show();
		$('.video_section').hide();
	}
	
	var contributor_type_id = $('#column_contributor_type_id').val();
	if(contributor_type_id == 20){
		$('.column_contributor_name').show();
	}else{
		$('.column_contributor_name').hide();
	}
	
	
		
		var type = $('#feature_type').val();
		
		if(type == "video"){
			$('.image_section').hide();
			$('.audio_section').hide();
			$('.video_section').show();
			$('.meta_section').hide();
		}else if(type == "news" || type == "features"){
			$('.image_section').show();
			$('.audio_section').hide();
			$('.video_section').hide();
			$('.meta_section').show();
		}else if(type == "audio"){
			$('.image_section').show();
			$('.audio_section').show();
			$('.video_section').hide();
			$('.meta_section').hide();
		}
	
	var link_type = 'custom-links';
	var menu_id = $("#menu_id").val();
	if(menu_id != "" && menu_id != null){
		
		$.ajax({
			url : baseUrl+'/admin/menu/ajaxGetMenuLinks',
			dataType : 'html',
			type:'post',
			data : {ajax_request : 'menuLinks',link_type: link_type,menu_id : menu_id, '_token' : csrfToken},
			success:function(data){
				if(data != ''){
					$('#'+link_type).html(data);
					$('#'+link_type).addClass('active');
					$('#'+link_type).attr('aria-expanded',true);
				}
				
			}
		})
	}
})

$(document).ready(function(){
	
	var baseUrl = $('#base_url').val();	
	var csrfToken = $('meta[name="csrf-token"]').attr('content');
	
	$('body').on('click','.addNewMidMajors',function(){
		var number = $('#total_midmajors').val();
		number = parseInt(number) + 1;
		$('#total_midmajors').val(number);
		$('.newMidMajors').append('<div class="form-group row "><div class="col-sm-1"><input type="text" class="form-control" name="data['+number+'][cid]" value="'+number+'"></div><div class="col-sm-2"><input type="text" class="form-control" name="data['+number+'][team]" ></div><div class="col-sm-2"><input type="text" class="form-control" name="data['+number+'][record]"></div><div class="col-sm-2"><input type="text" class="form-control" name="data['+number+'][points]"></div><div class="col-sm-2"><input type="text" class="form-control" name="data['+number+'][previous]"></div><div class="col-sm-2"><input type="text" class="form-control" name="data['+number+'][conference]"></div><input type="hidden" class="form-control" name="data['+number+'][id]" value="2"><input type="hidden" class="form-control" name="data['+number+'][record_status]"><input type="hidden" class="form-control"  name="data['+number+'][record_status]" value="new"><div class="col-sm-1"><a  class="delete_recent_mid_major" href="javascript:void(0)"><i class="fa fa-trash"></i></a></div></div>');
	});
	
	
	$('body').on('click','.delete_recent_mid_major',function(){
		if(confirm('Are you sure?') == true){
			$(this).parent().parent().remove();
			var number = $('#total_midmajors').val();
			number = parseInt(number) - 1;
			$('#total_midmajors').val(number);
		}
		
	})
	
	
	$('body').on('change','#story_type',function(){
		var type = $(this).val();
		
		if(type == "video"){
			$('.image_section').hide();
			$('.video_section').show();
		}else if(type == "image" || type == "features"){
			$('.image_section').show();
			$('.video_section').hide();
		}
	})
	
	
	$('body').on('click','.menuLinks',function(){
		var link_type = $(this).attr('link_type');
		var menu_id = $("#menu_id").val();
		
		if(link_type != "" && link_type != null){
			
			$.ajax({
				url : baseUrl+'/admin/menu/ajaxGetMenuLinks',
				dataType : 'html',
				type:'post',
				data : {ajax_request : 'menuLinks',link_type: link_type,menu_id : menu_id, '_token' : csrfToken},
				success:function(data){
					if(data != ""){
						
						$('#search_menupages').hide();
						if(link_type != "custom-links"){
							$('#search_menupages').show();
						}
						$('#'+link_type).html(data);
					}
				}
			})
		}
	})
	
	
	$('body').on('change', '#menuTypes', function(){
		var menu_id = $(this).val();
		
		if(menu_id != "" && menu_id != null){
			window.location.href = baseUrl+'/admin/menu/manage-menu/'+menu_id;
		}else{
			alert('Please select a menu');
		}
	})
	
	$('body').on('click','#all_check_menulinks', function(){
		if($(this).is(":checked")){
			
			$.each($('.menupage_links'), function(){
				if($(this).css('display') != 'none'){
					$(this).children('input').prop('checked',true);
				}
			})
		}else{
			$('.menupage_links input').prop('checked',false);
		}
		
	})
	
	
	$('body').on('keyup','#search_menupages', function(){
        var searchText = $(this).val().toLowerCase();
		$('#all_check_menulinks').prop('checked',false);
		$('.menupage_links input').prop('checked',false);
        // Show only matching TR, hide rest of them
        $.each($(".menupage_links"), function() {
            if($(this).text().toLowerCase().indexOf(searchText) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    }); 
	
	
	
	$('body').on('click','.viewContact',function(){
		var contact_id = $(this).attr('contact_id');
		
		if(contact_id != "" && contact_id != null){
			
			$.ajax({
				url : baseUrl+'/admin/contacts/ajaxContactDetail',
				dataType : 'json',
				type:'post',
				data : {ajax_request : 'contactDetail',contact_id: contact_id, '_token' : csrfToken},
				success:function(result){
					if(result.res == 1){
						$("#contact_p_name").html(result.response.name);
						$("#contact_p_phone").html(result.response.phone);
						$("#contact_p_email").html(result.response.email);
						$("#contact_p_city").html(result.response.city);
						$("#contact_p_address").html(result.response.address);
						$("#contact_p_state").html(result.response.state);
						$("#contact_p_zipcode").html(result.response.zip_code);
						$("#contact_p_country").html(result.response.country);
						$("#contact_p_question").html(result.response.questions);
						
						$('#viewContactPopup').modal('show');
					}
				}
			})
		}
	})
	


	$('body').on('change','#feature_type',function(){
		var type = $(this).val();
		
		if(type == "video"){
			$('.image_section').hide();
			$('.audio_section').hide();
			$('.video_section').show();
			$('.meta_section').hide();
		}else if(type == "news" || type == "features"){
			$('.image_section').show();
			$('.audio_section').hide();
			$('.video_section').hide();
			$('.meta_section').show();
		}else if(type == "audio"){
			$('.image_section').show();
			$('.audio_section').show();
			$('.video_section').hide();
			$('.meta_section').hide();
		}else{
			$('.image_section').hide();
			$('.audio_section').hide();
			$('.video_section').hide();
			$('.meta_section').show();
		}
	})
	
	
	$('body').on('change','#column_contributor_type_id',function(){
		var contributor_type_id = $(this).val();
		if(contributor_type_id == 20){
			$('.column_contributor_name').show();
		}else{
			$('.column_contributor_name').hide();
		}
	})
	
	
})



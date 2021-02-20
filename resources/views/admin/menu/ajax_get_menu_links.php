<?php 
	if(!empty($menuLinks)){
		
		if(isset($menuLinks['link_type']) && !empty($menuLinks['link_type'])){ 
?>
<form class="form-horizontal"  method="POST" action='<?php echo URL::to('admin/menus/save_menu_links') ?>'  enctype="multipart/form-data" >
 <input type="hidden" name="_token" value="<?php echo $menuLinks['token']; ?>">			
	<div>
		<div class="form-group row">
		  <!-- <label class="col-sm-2 col-form-label">Link Text</label> -->
		   <div class="col-sm-12">
		  <input type="text" class="form-control" name="link_text" placeholder="Enter Link Text" required="required">
		  </div>
		</div>
		<div class="form-group row">
		  <!-- <label class="col-sm-2 col-form-label">URL</label> -->
		   <div class="col-sm-12">
		  <input type="text" class="form-control" name="url" placeholder="Enter URL" required="required" value="http://">
		   <input type="hidden"  name="link_type" value="<?php echo $menuLinks['link_type']; ?>">
		  </div>
		</div>
	</div>
	<?php } ?>
			
	<div class="form-group row">
	<?php if($menuLinks['link_type'] == "custom-links"){ ?>
	   <label class="col-sm-2 col-form-label"></label>
	<?php } ?>
	   <div class="col-sm-10">
	   <input type="hidden" name="menu_id" value="<?php echo $menuLinks['menu_id']; ?>">
	   <button class="btn btn-info" type="submit">Add To Menu</button>
	  </div>
	</div>


</form>

			
<?php 
	}
?>
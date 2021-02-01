<?php
	main_header(['product-mngnt']);	
	// var_dump($prod_details);
?>
<!-- ############ PAGE START-->
<link rel="stylesheet" href="<?= base_url()?>assets/css/global.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url()?>assets/css/tables.css" type="text/css" />
<div class="padding">	
	<div class="row">		
		<div class="box box-body">
			<a class="btn btn-primary pull-right" href="<?=@base_url().'product-mngmt'?>" id=""> <i class="fa fa-arrow-left"></i>	Back</a>
			<h2>Update product </h2>		
				<div class="row">
                    <div class="col-md-6">
						<form role="form">
							<div class="form-group">
								<label class="bold-font">Product name:	</label>
								<input type="text" class="form-control" data-field="product-auth" hidden  value="<?=@$prod_details->auth_token?>" >
								<input type="text" class="form-control" data-field="product-name" placeholder="enter product name" value="<?=@$prod_details->product_name?>" >
							</div>
						</form>
                    </div>
                    <div class="col-md-6">

						<form role="form">
							<div class="form-group">
								<label class="bold-font">Product category:</label>
									<select class="form-control form-info" data-field="product_category">
										<option value="" selected >SELECT PRODUCT CATEGORY</option>
										<?php foreach ($prod_category as $key => $value):?>
											<option <?=@($prod_details->product_category_id==$value->ID)?"selected":"";?> value="<?=$value->ID?>"><?=$value->product_category_name?></option>
										<?php endforeach;?>
									</select>
							</div>
						</form>
                    </div>
                </div>			
				<div class="row">
                    <div class="col-md-6">
						<form role="form">
							<div class="form-group">
								<label class="bold-font"> Product unit:</label>
									<select class="form-control form-info" data-field="product_unit">
										<option value="" selected >SELECT PRODUCT UNIT</option>
										<?php foreach ($prod_unit as $key => $value):?>
											<option <?=@($prod_details->product_unit_id==$value->ID)?"selected":"";?> value="<?=$value->ID?>"><?=$value->unit_name?></option>
										<?php endforeach;?>
									</select>
							</div>
						</form>
                    </div>
                    <div class="col-md-6">
						<form role="form">
							<div class="form-group">
								<label class="bold-font">Product retail price:</label>
								<input type="number" class="form-control" placeholder="enter product retail price" data-field="product_retail_price" value="<?=@$prod_details->price?>" >
							</div>
						</form>
                    </div>
                </div>		
				<div class="row">
                    <div class="col-md-12">
						<button class="btn btn-success pull-right" id="update_product">Update product</button>
                    </div>
                </div>	
	
									
		</div>				
	</div>			
</div>

<!-- ############ PAGE END-->
<?php
	main_footer();
?>
<script src="<?php echo base_url()?>assets/js/product-mngmt/index.js"></script>
<?php
	main_header(['product-mngnt']);	
?>
<!-- ############ PAGE START-->
<link rel="stylesheet" href="<?= base_url()?>assets/css/global.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url()?>assets/css/tables.css" type="text/css" />
<div class="padding">	
<div id="pageMessages"></div>
	<div class="row">		
		<div class="box box-body">

			<h2>Product Management </h2>		
			
				<div class="row">
                    <div class="col-md-6">
						<form role="form">
							<div class="form-group">
								<label class="bold-font">Product name:	</label>
								<input type="text" class="form-control" data-field="product-name" placeholder="enter product name" value="" >
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
											<option value="<?=$value->ID?>"><?=$value->product_category_name?></option>
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
											<option value="<?=$value->ID?>"><?=$value->unit_name?></option>
										<?php endforeach;?>
									</select>
							</div>
						</form>
                    </div>
                    <div class="col-md-6">
						<form role="form">
							<div class="form-group">
								<label class="bold-font">Product retail price:</label>
								<input type="number" class="form-control" placeholder="enter product retail price" data-field="product_retail_price" value="" >
							</div>
						</form>
                    </div>
                </div>		
				<div class="row">
                    <div class="col-md-12">
						<button class="btn btn-success pull-right" id="add_product">Add product</button>
                    </div>
                </div>	
				<hr>
				<div class="row">

				<div class="col-xs-12 col-sm-12">
                <table class="table m-b-none border-in-table" ui-jp="footable" data-filter="#filter" data-page-size="20">   
                    <thead>                            
                        <tr>			
                            <th data-toggle=true>Product</th>					
                            <th data-hide="phone, tablet">Category</th>
                            <th data-hide="phone, tablet" >Unit</th>	
                            <th data-hide="phone, tablet" >Rmng stock</th>	
                            <th data-hide="phone, tablet" >Retail Price</th>	
                            <th data-hide="phone, tablet" >Date created</th>									                                    
                            <th data-hide="phone, tablet">Action</th>
                        </tr>
                    </thead>
                    <tbody id="loadproduct">
                    </tbody>
                    <tfoot class="hide-if-no-paging">
                    <tr>
                        <td colspan="5" class="text-center">
                            <ul class="pagination"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
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
<?php
	main_header(['order-menu']);	
?>
<style>
.category-menu{
	height:100px;
	width:120px;
	margin-top:10px;
	margin-right:6px;
}
.item{
	height:100px;
	width:120px;
	margin-top:10px;
	margin-right:10px;
	white-space: unset;
}
.box-body{
	min-height: 80vh;
}

#total_row{
	font-size:20px;
	background-color: lightgreen;
}

#total{
	font-size:20px;
	font-weight:bold;
}
#display_total{
	margin-right:10px;
	background-color:green;
	color:white;
	padding: 4px;
}
</style>
<!-- ############ PAGE START-->
<link rel="stylesheet" href="<?= base_url()?>assets/css/global.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url()?>assets/css/tables.css" type="text/css" />
<div class="padding">	
	<div class="row order-row">	
		<div class="col-md-7">
			<div class="box box-body">
				<h3>ORDER SYSTEM</h3>	
				<hr>			
				<h5>CATEGORY</h6>
				<div class="row">
					<div class="col-md-12">
						<?php foreach($prod_category as $key=>$value){?>
							<button class="btn btn-primary category-menu" data-value="<?=@$value->ID?>"> <?=@$value->product_category_name?></button>
						<?php }?>
					</div>
				</div>
				<hr>
				<h5>ITEM</h6>
				<div class="row" >
					<div class="col-md-12" id="display_item">
					</div>
				</div>
			</div>	
		</div>
		
		<div class="col-md-5">
			<div class="box box-body">
				<!-- <button class="btn btn-primary pull-right pay" ><i class="fa fa-money"></i> Pay</button>  -->
				<button type="button" class="btn btn-primary pull-right pay" data-toggle="modal" data-target="#pay">
				<i class="fa fa-money"></i> Pay
				</button>                                                                                                                                                                    
				<h3>PURCHASING LINE
				<span class="pull-right" id="display_total">Total: <span id="display_total_number">0</span></span>
				</h3>	

				<hr>			
				<table class="table m-b-none border-in-table" ui-jp="footable" data-filter="#filter" data-page-size="20">   
					<thead>                            
						<tr>			
							<th >Product</th>			
							<th >Qty</th>
							<th >Price</th>
							<th >Sub-Total</th>				                                    
						</tr>
					</thead>
					<tbody id="loadproduct">

					</tbody>	
					<tr id="total_row" style="">
						<td><b>TOTAL</b></td>
						<td></td>
						<td></td>
						<td><span id="total"></span></td>
        			</tr>
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

<!-- Modal -->
<div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-money"></i> Pay</h5>
      </div>
      <div class="modal-body">
	 	<form role="form">
			<div class="form-group">
				<label class="bold-font">Employee no:</label>
				<input type="number" class="form-control emply-no" data-field="employee-no" placeholder="enter employee no" value="" >
			</div>
		</form>
			<table class="table m-b-none border-in-table" ui-jp="footable" data-filter="#filter" data-page-size="20">   
				<thead>                            
					<tr>			
						<th >Empl. No</th>
						<th >Name</th>
					</tr>
					</thead>
					<tbody id="loademployee">

					</tbody>	
					
				</tfoot>
			</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary proceed-order">Proceed Order</button>
      </div>
    </div>
  </div>
</div>

<!-- ############ PAGE END-->
<?php
	main_footer();
?>
<script src="<?php echo base_url()?>assets/js/order-menu/index.js"></script>
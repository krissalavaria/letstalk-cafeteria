<?php
	main_header(['stock-mngmt']);	
?>
<!-- ############ PAGE START-->
<link rel="stylesheet" href="<?= base_url()?>assets/css/global.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url()?>assets/css/tables.css" type="text/css" />
<div class="padding">	
	<div class="row">		
		<div class="box box-body">
			<h2>Stock management</h2>		
				<hr>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<table class="table m-b-none border-in-table" ui-jp="footable" data-filter="#filter" data-page-size="20">   
							<thead>                            
								<tr>			
									<th data-toggle=true>Product</th>					
									<th data-hide="phone, tablet">Category</th>
									<th data-hide="phone, tablet" >Unit</th>	
									<th data-hide="phone, tablet" >Total stock</th>	
									<th data-hide="phone, tablet" >Retail Price</th>	
									<th data-hide="phone, tablet" >Date created</th>	
									<th data-hide="phone, tablet" >Date last update</th>									                                    
									<!-- <th data-hide="phone, tablet">Action</th> -->
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
<script src="<?php echo base_url()?>assets/js/stock-mngmt/index.js"></script>
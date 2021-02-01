<?php
	main_header(['dashboard']);	
?>
<!-- ############ PAGE START-->
<link rel="stylesheet" href="<?= base_url()?>assets/css/global.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url()?>assets/css/tables.css" type="text/css" />
<div class="padding">	
	<div class="row">		
		<div class="col-md-6">
			<div class="box box-body">
			<h2>CONFIRMED ORDER</h2>		
				<hr>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<table class="table m-b-none border-in-table" ui-jp="footable" data-filter="#filter" data-page-size="20">   
							<thead>                            
								<tr>			
									<th >Order no</th>
									<th >Empl. name</th>
									<th >View</th>
								</tr>
							</thead>
							<tbody id="confirmed_grid">
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
		<div class="col-md-6">
			<div class="box box-body">
			<h2>RESERVED ORDER</h2>		
				<hr>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<table class="table m-b-none border-in-table" ui-jp="footable" data-filter="#filter" data-page-size="20">   
							<thead>                            
								<tr>			
									<th >Order no</th>
									<th >Empl. name</th>
									<th >View</th>
								</tr>
							</thead>
							<tbody id="reserved_grid">
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
	<div class="row">		
		<div class="col-md-6">
			<div class="box box-body">
			<h2>CANCELLED ORDER</h2>		
				<hr>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<table class="table m-b-none border-in-table" ui-jp="footable" data-filter="#filter" data-page-size="20">   
							<thead>                            
								<tr>			
									<th >Order no</th>
									<th >Empl. name</th>
									<th >View</th>
								</tr>
							</thead>
							<tbody id="cancelled_grid">
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
		<div class="col-md-6">
			<div class="box box-body">
			<h2>PAID ORDER</h2>		
				<hr>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<table class="table m-b-none border-in-table" ui-jp="footable" data-filter="#filter" data-page-size="20">   
							<thead>                            
								<tr>			
									<th >Order no</th>
									<th >Empl. name</th>
									<th >View</th>
								</tr>
							</thead>
							<tbody id="paid_grid">
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
</div>

<!-- ############ PAGE END-->
<?php
	main_footer();
?>
<script src="<?php echo base_url()?>assets/js/dashboard/index.js"></script>

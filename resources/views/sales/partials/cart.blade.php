<div class="ibox">
	<div class="ibox-title bg-success">
		<h5 class="full-width">
		<div class="row">
				<div class="col-sm-3 text-white">
					
						<i class="fa fa-shopping-cart fa-lg"></i>
						<span class="total_items_in_cart badge badge-danger">20</span>
						 Items in cart

				</div>

				<div class="col-sm-6">
				    @include('sales.partials.search_product')
				</div>

				<div class="col-sm-1">
				    
				</div>

				<div class="col-sm-2">
					<button class="btn btn-info title-bar-content" type="button">
						<i class="fa fa-shopping-cart fa-lg"></i> New Cart
					</button>
				</div>
		</div>
		</h5>
	</div>

	<div class="ibox-content no-padding">
		<div class="font-bold font-md container-fluid margin-top-20">
			<div class="row">
				<div class="col-sm-1">
					<span>
						Qty
					</span>
				</div>

				<div class="col-sm-3">
					<span>
						Description
					</span>
				</div>

				<div class="col-sm-2">
					<span>
						Unit Price
					</span>
				</div>

				<div class="col-sm-1">
					<span>
						%
					</span>
				</div>

				<div class="col-sm-2">
					<span>
						Total
					</span>
				</div>

				<div class="col-sm-2">
					<span>
						Sales Mode
					</span>
				</div>

				<div class="col-sm-1">
					<a href="::;" class="text-danger">
						<i class="fa fa-trash"></i>
					</a>
				</div>
			</div>
		</div>

		<hr class="no-margin-bottom">
		<div class="main-cart-content container-fluid">
			@for($i=0; $i < 17; $i++)
			<div class="row cart-list">
				<div class="col-sm-1">
					<span class="quantity">
						<input type="text" value="10" class="quantity_input">
					</span>
				</div>

				<div class="col-sm-3">
					<span class="productname">
						Others/Perfect Pencils
					</span>
				</div>

				<div class="col-sm-2">
					<span class="unitprice">
						{{money(15000.00)}}
					</span>
				</div>

				<div class="col-sm-1">
					<span class="discount">
						20%
					</span>
				</div>

				<div class="col-sm-2">
					<span class="total">
						{{money(150000.00)}}
					</span>
				</div>

				<div class="col-sm-2">
					<span class="salesmode">
						Major Distributor
					</span>
				</div>

				<div class="col-sm-1">
					<a href="::;" class="text-danger">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
			@endfor
		</div>

	</div>

</div>

<script type="text/javascript">
$(function(){
  $('.selectpicker').selectpicker({
    style: 'btn-warning'
  });

  $('#searchproduct').typeahead({
  	source : ['item1', 'item2', 'item3']
  });

  $('.main-cart-content').slimScroll({
  	height: '400px'
  });

});
</script>
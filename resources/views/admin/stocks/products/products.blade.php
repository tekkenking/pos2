
<div>
   <a href="#"> <i class="fa fa-arrow-back fa-lg"></i> Back</a>
</div>

<hr>

<table class="table table-striped table-bordered table-dark-head table-hover data-table" aria-describedby="DataTables_Table_0_info" role="grid">
    <thead>
        <tr role="row">
        	<th width="3%">
        		<!--<span multiple-checkbox>All</span>-->
                        <div class="styledcheckbox" multiple-checkbox>
                            <input type="checkbox">
                            <i class="font-21 ion-android-checkbox-outline-blank off"></i>
                            <i class="font-21 ion-android-checkbox-outline on"></i>
                        </div>
        	</th>
        	<th width="30%">Products<br>Barcode</th>
 
        	<th class="text-center"><i class="fa fa-check-circle  font-21"></i></th>

        	<th>Qty/ Reorder LV</th>

        	<th>Unit Price<br>Cost Price <br>Profit Margin</th>
            <th>Dscnt %<br><span class="label font-15 label-warning tiny-margin-top">Dscntd U.P</span></th>
            <th>Total Price<br>Total Cost Price<br>Total Profit Margin</th>
            <th>...</th>
        </tr>
    </thead>
    <tbody>
        
    	@if(!empty($category->products))
    		@foreach( $category->products as $product )
                <tr class="gradeA odd" role="row">
                	<td>
						
						<div class="styledcheckbox">
							<input type="checkbox" name="brandid" value="{{$product->id}}">
							<i class="font-21 ion-android-checkbox-outline-blank off"></i>
							<i class="font-21 ion-android-checkbox-outline on"></i>
						</div>
                		
                	</td>
                	<td>
                		<a href="#">
                			<span class="font-15 text-capitalize">{{$product->name}}</span>
                		</a>
                        <div><em>[No Barcode]</em></div>
                	</td>
                    <td class="text-center">
                    	@if( $product->published === 1 )
                    		<a href="#" class="toggle-status" title="published">
                    			<i class="fa fa-check-circle text-info font-21"></i>
                    		</a>
                    	@else
                    		<a href="#" class="toggle-status" title="not published">
                    			<i class="fa fa-circle text-danger font-21"></i>
                    		</a>
                    	@endif
                    </td>
                    <td>
   						{{$product->quantity}}
                        <div class="pull-right">{{$product->almost_finished}}</div>
                    </td>
                    <td class="font-bold">
                        <div class="font-15">{{money( $product->price )}}</div>
                        <div class="text-danger tiny-margin-top">{{money( $product->costprice )}}</div>
                        <div class="text-navy tiny-margin-top">{!!money($product->price - $product->costprice)!!}</div>
                    </td>
                    <td>
                        <div class="font-15"><span class="discount-percent">{{$product->discount}}</span>%</div>
                        <div class="label label-warning font-15 tiny-margin-top">{{money( $product->discountedprice )}}</div>
                    </td>
                    <td class="font-bold">
    <?php 
        $totalprice = $product->quantity * ( ($product->discountedprice > 0) ? $product->discountedprice : $product->price );
        //tt($totalprice);
    ?>


                        <div class="font-15">{{money( $totalprice )}}</div>
                        <div class="text-danger tiny-margin-top">{{money(20045)}}</div>
                        <div class="text-navy tiny-margin-top"><?php echo money(2003945 - 20045); ?></div>
                    </td>
                    <td>
                        <button class="btn btn-success btn-xs">More</button>
                    </td>
                </tr>
            @endforeach
       	@endif
    </tbody>
</table>

<script type="text/javascript">
$(function(){
    $('.data-table').DataTable({
            "bPaginate": false,
            "aoColumns": [
                        { "bSortable": false }, 
                        { "bSortable": false }, 
                        { "bSortable": false }, 
                        { "bSortable": false }, 
                        { "bSortable": false }, 
                        { "bSortable": false }, 
                        { "bSortable": false }, 
                        { "bSortable": false }
                    ]
                });

    $('.styledcheckbox').styledcheckbox();

    $('table').on('click', '.sweetalert', function(e){
        e.preventDefault();

        var $that = $(this);
        var name = $(this).attr('name');
        var url = $(this).attr('data-href');

        swal({
            title: "Are you sure?",
            text: "You're about to delete <b class='text-capitalize text-danger'>["+name+"]</b> brand including all it's categories and products. This can not be reversed!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            html: true
        }, function(){
            $.get(url, function(data){
                swal({
                    title: "Deleted!", 
                    text: "<b class='text-capitalize text-danger'>["+name+"]</b> including all it's categories and products are deleted", 
                    type: "success",
                    html: true
                }, function(){
                    location.reload(true);
                });
            });
        });
    });

    //$('.toggle-status').toggleStatus();
})
</script>
<style type="text/css">
input[type="number"]{
    padding: 3px;   
    border: 1px solid #356BA1;
	width: 50px;
   
    /*Applying CSS3 gradient*/
    background: -moz-linear-gradient(center top , #FFFFFF,  #EEEEEE 1px, #FFFFFF 20px);    
    background: -webkit-gradient(linear, left top, left 20, from(#FFFFFF), color-stop(5%, #EEEEEE) to(#FFFFFF));
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FBFBFB', endColorstr='#FFFFFF');
    
    /*Applying CSS 3radius*/   
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    
    /*Applying CSS3 box shadow*/
    -moz-box-shadow: 0 0 2px #356BA1;
    -webkit-box-shadow: 0 0 2px #356BA1;
    box-shadow: 0 0 2px #356BA1;
}
input[type="number"]:hover
{
    border:1px solid #cccccc;
}
input[type="number"]:focus
{
    box-shadow:0 0 2px #FFFE00;
}

</style>	
	<form action="sales/addcart" method="post">		
		<input type="hidden" name="pt" value="1" />
		<input type="hidden" name="invoice" value="" />
		
		<select name="p_id" class="chzn-select" required>
			<option ></option>
			<?php if(isset($records)) : foreach ($records as $row) : ?>
			<option value="<?php echo $row->product_id; ?>">
			<?php echo $row->gen_name." - ".$row->product_code." - ".$row->product_name ?>
			</option>
			
			<?php endforeach; ?>				
			<?php endif ?>
		</select>
		<input type="number" name="qty" value="1" min="1"  max="" placeholder="Qty" required />
		

		<input type="hidden" name="date" value="" />
		<Button type="submit" class="btn btn-info" ><i class="icon-plus-sign icon-large"></i> Add</button>
	</form>
	
	
	
	<h3>Read</h3>
	
	<?php if(isset($cart)) : foreach($cart as $row): ?>
	
	<h1><?php echo $row->product_id; ?></h1>
	<h1></h1>
	<h1></h1>
	<?php endforeach; ?>
	<?php endif; ?>
	
	
<?php if ($cart = $this->cart->contents()): ?>
<table class="table table-bordered" id="resultTable" data-responsive="table">
	<thead>
		<tr>
			<th> Product Name </th>
			<th> Generic Name </th>
			<th> Category / Description </th>
			<th> Price </th>
			<th> Qty </th>
			<th> Amount </th>
			<th> Profit </th>
			<th> Action </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($cart as $item): ?>
			<tr class="record">
			<td hidden></td>
			<td><?php echo $item['id']?></td>
			<td><?php echo $item['name']?></td>
			<td><?php echo $item['price']?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="90"><a href="delete.html"><button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> Cancel </button></a></td>
			</tr><tr>
			<th>  </th>
			<th>  </th>
			<th>  </th>
			<th>  </th>
			<th>  </th>
			<td> Total Amount: </td>
			<td> Total Profit: </td>
			<th>  </th>
		</tr>
			<tr>
				<th colspan="5"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
				<td colspan="1"><strong style="font-size: 12px; color: #222222;">$<?php echo $item['subtotal']; ?>
				</strong></td>
				<td colspan="1"><strong style="font-size: 12px; color: #222222;">
		
				</td>
				<th></th>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
<br/>


	<a href="checkout.html">
		<button class="btn btn-success btn-large btn-block">
			<i class="icon icon-save icon-large"></i> SAVE</button>
	</a>
<?php endif; ?>

	<link href="vendors/chosen.min.css" rel="stylesheet" media="screen">
    <script src="vendors/chosen.jquery.min.js"></script>
    <script>
        $(function() {
            $(".chzn-select").chosen();
        });
    </script>

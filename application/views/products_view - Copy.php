<div style="margin-top: -19px; margin-bottom: 21px;">
	<a  href="index.php"><button class="btn btn-danger btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
	<div style="float:right;">	
	<a rel="facebox" href="cart_view.html"><Button type="submit" class="btn btn-success" /><i class="icon-shopping-cart icon-large"></i></button></a>
	</div>
	
	<div style="text-align:center;">
		Total Number of Products:  <font color="green" style="font:bold 22px 'Aleo';">[]&nbsp; |</font>
		<font style="color:rgb(255, 95, 66);; font:bold 22px 'Aleo';">&nbsp;[]</font> Products are below QTY of 10
		<form action="" method="POST">
			<input autocomplete="off" type="number" name="qtyy" min="0" id="" class="btn btn-default" placeholder="Qty Left" style="width: 100px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" />	
			<input class="btn btn-success" type="submit" value="View" />
		</form>
	</div>
</div>

<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Search Product..." autocomplete="off" />
	
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Product</button>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
		<div class="row">
		  <div class="col-md-6">
			<h4>Some Input</h4>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
		  </div>
		  <div class="col-md-6">
			<h4>Some More Input</h4>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
			<p><input class="form-control" type="text"></p>
		  </div>
		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
	<br/><br/>
	
		<table class="hoverTable table" id="resultTable" data-responsive="table" style="text-align: left;">
			<thead>
				<tr>
					<th> Brand Name </th>
					<th> Generic Name </th>
					<th> Category / Description </th>
					<th> Supplier </th>
					<th> Date Received </th>
					<th> Expiry Date </th>
					<th> Original Price </th>
					<th> Selling Price </th>
					<th> QTY </th>
					<th> Qty Left </th>
					<th> Total </th>
					<th> Action </th>
				</tr>
			</thead>
			<tbody>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>
				<a rel="facebox" title="Click to edit the product" href="editproduct.html"><button class="btn btn-warning"><i class="icon-edit"></i></button> </a>
				
				<a href="#" id="" class="delbutton" title="Click to Delete the product"><button class="btn btn-danger"><i class="icon-trash"></i></button></a>
				
				<form action="inin.php" method="post" >
					<input type="hidden" name="pt" value="" />
					<input type="hidden" name="page" value="" />
					<input type="hidden" name="invoice" value="" />
					<input type="hidden" name="product" value="" />
					
					<input type="hidden" name="discount" value="" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" />
					<input type="hidden" name="date" value="" />
					
					<div class="btn btn-info">
					<input class="btn btn-info" type="number" name="qty" value="1" min="1" max="" placeholder="Qty" autocomplete="off" style="width: 60px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" required />			
					
					<Button class="btn btn-info" type="submit"  ><i class="icon-plus-sign icon-large"></i> </button>
					</div>
				</form>
				</td>
				</tr>
			</tbody>
		</table>
	  <!--Pagination Start-->  
	<section class="archive-pagess">
	<ul class="pagination">
		<li class="first" ><a href="products.php" title="first page">First</a></li>
		<li class="last"><a href="products.php" title="last page">Last </a></li>	
	</ul>
	</section>
	  <!--End pagination-->
<div class="clearfix"></div>

		
<script type="text/javascript">
	$(function() {
	$(".delbutton").click(function(){
	//Save the link in a variable called element
	var element = $(this);
	//Find the id of the link that was clicked
	var del_id = element.attr("id");
	//Built a url to send
	var info = 'id=' + del_id;
	 if(confirm("Sure you want to delete this Product? There is NO undo!"))
			  {
	 $.ajax({
	   type: "GET",
	   url: "deleteproduct.php",
	   data: info,
	   success: function(){
	   }
	 });
			 $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
			.animate({ opacity: "hide" }, "slow");
	 }
	return false;
	});
	});
</script>

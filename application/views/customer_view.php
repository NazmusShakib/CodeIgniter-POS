<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="<?php echo base_url(); ?>"><button class="btn btn-danger btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
<div style="text-align:center;">
Total Number of Customers: <font color="green" style="font:bold 22px 'Aleo';">50</font>
</div>
</div>
<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Search Customer..." autocomplete="off" />

 &nbsp;&nbsp;<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="icon-plus-sign icon-large"></i> Add Customer</button>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Customer</h4>
        </div>
        <div class="modal-body">
		<div class="row">
		  <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url(); ?>customer_control/add_customer">
			<div class="form-group">
			  <label class="control-label col-sm-3" for="fname">*Full Name:</label>
			  <div class="col-sm-8">
				<input name="cust_fname" type="text" class="form-control" id="fname" placeholder="Full Name" required>
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-3" for="address">*Address:</label>
			  <div class="col-sm-8">          
				<input name="cust_addr" type="text" class="form-control" id="address" placeholder="Enter address" required>
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-3" for="contact">Contact No:</label>
			  <div class="col-sm-8">          
				<input name="cont_no" type="text" class="form-control" id="contact" placeholder="Enter Contact No">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-3" for="pname">Product Name:</label>
			  <div class="col-sm-8">          
				<input name="prods_names" type="text" class="form-control" id="pname" placeholder="Enter Product Name">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-3" for="memberno">Member No:</label>
			  <div class="col-sm-8">
				<input name="cust_mem_no" type="number" class="form-control" id="memberno" placeholder="Customer Number">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-3" for="note">Note:</label>
			  <div class="col-sm-8">
				<textarea name="cust_note" class="form-control" id="note" cols="40" rows="2"></textarea>
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-3" for="date">Date:</label>
			  <div class="col-sm-8">          
				<input name="cust_ex_date" type="date" class="form-control" id="date" placeholder="Date">
			  </div>
			</div>
			<div class="form-group">        
			  <div class="col-sm-offset-3 col-sm-8">
				<button type="submit" class="btn btn-success btn-large btn-block full-width">Submit</button>
			  </div>
			</div>
		  </form>
		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Popup Model -->
<br><br>

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="17%"> Full Name </th>
			<th width="10%"> Address </th>
			<th width="10%"> Contact Number</th>
			<th width="23%"> Product Name</th>
			<th width="9%"> Total </th>
			<th width="17%"> Note </th>
			<th width="9%"> Due Date </th>
			<th width="14%"> Action </th>
		</tr>
	</thead>
	<tbody>		
		<?php if(isset($records)) : foreach($records as $row):?>
			<tr class="record">
			<td><?php echo $row->customer_name; ?></td>
			<td><?php echo $row->address; ?></td>
			<td><?php echo $row->contact; ?></td>
			<td><?php echo $row->prod_name; ?></td>
			<td><?php echo $row->membership_number; ?></td>
			<td><?php echo $row->note; ?></td>
			<td><?php echo $row->expected_date; ?></td>
			<td>
			
			<button type="button" name="btnupdate" id="btn_edit_popup" class="btn btn-warning btn-mini" ><i class="icon-edit"></i></button>
			<input type="button"  id="cust_edit_id" class="bbn" value="<?php echo $row->customer_id; ?>"/>
			<div id="tmpModal"></div>
			
			<a href="<?php echo base_url(); ?>customer_control/delete/<?php echo $row->customer_id ; ?>" id="" class="delbutton" title="Click To Delete" onclick="return confirm('Are you sure want to delete?');"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i></button></a></td>
			</tr>
		<?php endforeach; ?>
		<?php else : ?>
			<h1>No records were returned...</h1>
		<?php endif ?>
	</tbody>
</table>
<div class="clearfix"></div>

	<script type="text/javascript">
	
	$(function() {
	$(".bbn").click(function(){
	//Save the link in a variable called element
	var element = $(this);
	//Find the id of the link that was clicked
	var del_id = element.attr("id");
	//Built a url to send
	var info = 'id=' + del_id;
	//alert(info);
	vlu = $("#cust_edit_id").attr('value');
	alert(vlu);
	
	
	
/* 	$(document).ready(function(e) {
		$('#cust_edit_id').click(function(){
		
		 */
/* 			//Save the link in a variable called element
			var element = $(this);
			//Find the id of the link that was clicked
			var del_id = element.attr("id");
			//Built a url to send
			var info = 'id=' + del_id;
			alert(info); */
		
		//$var = get_element_by_id('cust_edit_id');
		/* vlu = $("#cust_edit_id").attr('value');
		alert(vlu); */
		
		//var rr = document.getElementById('cust_edit_id').value;
		//Using ajax poster
		// $.post('<?php echo base_url(); ?>Customer_control/edit_pop',function(pp){
			// $('#tmpModal').html(pp);
			// $('#testModal').modal('show');
		
		// })
	//	})
	
	});
});
	
	</script>
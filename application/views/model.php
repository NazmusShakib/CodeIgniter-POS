<!-- Modal -->
			<div class="modal fade" id="testModal" role="dialog" data-backdrop="static">
			<div class="modal-dialog">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Edit Customer</h4>
				</div>
				<div class="modal-body">
				<div class="row">
				  <form class="form-horizontal" role="form" method="POST" action="">
					<div class="form-group">
					  <label class="control-label col-sm-3" for="fname">*Full Name:</label>
					  <div class="col-sm-8">
						<input name="cust_fname" type="text" value="" class="form-control" id="fname" placeholder="Full Name" required>
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label col-sm-3" for="address">*Address:</label>
					  <div class="col-sm-8">          
						<input name="cust_addr" type="text" value="" class="form-control" id="address" placeholder="Enter address" required>
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label col-sm-3" for="contact">Contact No:</label>
					  <div class="col-sm-8">          
						<input name="cont_no" type="text" value="" class="form-control" id="contact" placeholder="Enter Contact No">
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label col-sm-3" for="pname">Product Name:</label>
					  <div class="col-sm-8">          
						<input name="prods_names" type="text" value="" class="form-control" id="pname" placeholder="Enter Product Name">
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label col-sm-3" for="memberno">Member No:</label>
					  <div class="col-sm-8">
						<input name="cust_mem_no" type="number" value="" class="form-control" id="memberno" placeholder="Customer Number">
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label col-sm-3" for="note">Note:</label>
					  <div class="col-sm-8">
						<textarea name="cust_note" class="form-control" id="note" cols="40" rows="2"> </textarea>
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label col-sm-3" for="date">Date:</label>
					  <div class="col-sm-8">          
						<input name="cust_ex_date" type="date" value="" class="form-control" id="date" placeholder="Date">
					  </div>
					</div>
					<div class="form-group">        
					  <div class="col-sm-offset-3 col-sm-8">
						<button type="submit" class="btn btn-success btn-large btn-block full-width">UPDATE</button>
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
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Customer</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Product Name</th>
                    <th>Total</th>
                    <th>Note</th>
                    <th>Due Data</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                <th>Full Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Product Name</th>
                <th>Total</th>
                <th>Note</th>
                <th>Due Date</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>

	
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
    //datatables
    table = $('#table').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Ajax_cust_ctrl/ajax_list')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#cust_Modal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Customer'); // Set Title to Bootstrap modal title
}

function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Ajax_cust_ctrl/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.customer_id);
            $('[name="cust_fname"]').val(data.customer_name);
            $('[name="cust_addr"]').val(data.address);
            $('[name="cont_no"]').val(data.contact);
            $('[name="prods_names"]').val(data.prod_name);
            $('[name="cust_mem_no"]').val(data.membership_number);
            $('[name="cust_note"]').val(data.note);
            $('[name="cust_ex_date"]').val(data.expected_date);
            $('#cust_Modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Customer'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('Ajax_cust_ctrl/ajax_add')?>";
    } else {
        url = "<?php echo site_url('Ajax_cust_ctrl/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#cust_Modal').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('Ajax_cust_ctrl/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#cust_Modal').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
}

</script>
  <!-- Modal -->
  <div class="modal fade" id="cust_Modal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Customer</h4>
        </div>
        <div class="modal-body form">
		  <form id="form" class="form-horizontal" role="form" action="#">
		    <input type="hidden" value="" name="id"/> 
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
				<button id="btnSave" onclick="save()" class="btn btn-success btn-large btn-block full-width">Save</button>
			  </div>
			</div>
		  </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Popup Model -->
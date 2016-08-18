        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Product</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Brand Name</th>
                    <th>Generic Name</th>
                    <th>Category/ Description</th>
                    <th>Supplier</th>
                    <th>Date Rec.</th>
                    <th>Expiry Date</th>
                    <th>Original Price</th>
                    <th>Selling Price</th>
                    <th>QTY</th>
                    <th>QTY Left</th>
                    <th>Total</th>
                    <th style="">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                    <th>Brand Name</th>
                    <th>Generic Name</th>
                    <th>Category/ Description</th>
                    <th>Supplier</th>
                    <th>Date Rec.</th>
                    <th>Expiry Date</th>
                    <th>Original Price</th>
                    <th>Selling Price</th>
                    <th>QTY</th>
                    <th>QTY Left</th>
                    <th>Total</th>
                    <th style="">Action</th>
            </tr>
            </tfoot>
        </table>

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
            "url": "<?php echo site_url('products/ajax_list')?>",
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
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Product'); // Set Title to Bootstrap modal title
}

function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('products/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.product_id);
            $('[name="brand_nam"]').val(data.product_code);
            $('[name="gen_name"]').val(data.gen_name);
            $('[name="categoryDes"]').val(data.product_name);
            $('[name="date_arrival"]').val(data.date_arrival);
            $('[name="exp_date"]').val(data.expiry_date);
            $('[name="sell_price"]').val(data.price);
            $('[name="orginal_price"]').val(data.o_price);
            $('[name="profit"]').val(data.profit);
            $('[name="supp_name"]').val(data.supplier);
            $('[name="quantity"]').val(data.qty);
            $('[name="qtyleft"]').val(data.qty_sold);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Product'); // Set title to Bootstrap modal title
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
        url = "<?php echo site_url('Products/ajax_add')?>";
    } else {
        url = "<?php echo site_url('Products/ajax_update')?>";
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
                $('#modal_form').modal('hide');
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
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('products/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
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

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Product Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
						<div class="row">
							<div class="col-md-6">					
								<div class="form-group">
									<label class="control-label col-md-3">Brand Name</label>
									<div class="col-md-9">
										<input name="brand_nam" placeholder="Brand Name" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Generic Name</label>
									<div class="col-md-9">
										<input name="gen_name" placeholder="Generic Name" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Category/ Description</label>
									<div class="col-md-9">
										<textarea name="categoryDes" placeholder="Category/ Description" class="form-control"></textarea>
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Date Arrival</label>
									<div class="col-md-9">
										<input name="date_arrival" class="form-control" type="date">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Expiry Date</label>
									<div class="col-md-9">
										 <input name="exp_date" placeholder="Expiry Date" class="form-control" type="date">
										<span class="help-block"></span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Selling Price</label>
									<div class="col-md-9">
										 <input name="sell_price" placeholder="Selling Price" class="form-control" type="number">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Original Price</label>
									<div class="col-md-9">
										 <input name="orginal_price" placeholder="Original Price" class="form-control" type="number">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Profit</label>
									<div class="col-md-9">
										 <input name="profit" placeholder="Profit" class="form-control" type="number">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Supplier</label>
									<div class="col-md-9">
										<select name="supp_name" class="form-control">
											<option value="">--Select Gender--</option>
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select>
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Quantity</label>
									<div class="col-md-9">
										 <input name="quantity" placeholder="Quantity" class="form-control" type="number">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">QTY Left</label>
									<div class="col-md-9">
										 <input name="qtyleft" placeholder="Quantity Left" class="form-control" type="number">
										<span class="help-block"></span>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
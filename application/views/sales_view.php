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

.form-actions {
    margin: 0;
    background-color: transparent;
    text-align: center;
}
</style>	
	<form action="sales/addcart" method="post">
	
		<select name="p_id" class="chzn-select" required>
			<option ></option>
			<?php if(isset($records)) : foreach ($records as $row) : ?>
			<option value="<?php echo $row->product_id; ?>">
			<?php echo $row->gen_name." - ".$row->product_code." - ".$row->product_name ?>
			</option>
			
			<?php endforeach; ?>				
			<?php endif; ?>
		</select>
		<input type="number" name="qty" value="1" min="1"  max="" placeholder="Qty" required />
		<Button type="submit" class="btn btn-info" ><i class="icon-plus-sign icon-large"></i> Add</button>
	</form>
	
	<h3>Items: <?= $this->cart->total_items(); ?></h3>
	
<div class="table-responsive">          
<?php echo form_open('sales/cartupdate'); ?>
<table cellpadding="6" class="table table-hover" cellspacing="1" style="width:70%" border="1">

<thead class="thead-inverse">
<tr>
  <th>Product Name</th>
  <th>Generic Name</th>
  <th>Category / Description</th>
  <th>QTY</th>
  <th style="text-align:right">Price</th>
  <th>Profit</th>
  <th style="text-align:right">Sub-Total</th>
  <th>Action</th>
</tr>
</thead>
<tbody>
<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>

	<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

	<tr>
	  <td>
		<?php echo $items['name']; ?>

			<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

				<p>
					<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

						<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

					<?php endforeach; ?>
				</p>

			<?php endif; ?>

	  </td>
	  <td><?php echo $items['gen_name'];?></td>
	  <td><?php echo $items['cat'];?></td>
	  <td><input type="number" name="qty<?php echo $i?>" maxlength="3" value="<?php echo $items['qty'] ;?>"/></td><td style="text-align:right">
	  <?php echo $this->cart->format_number($items['price']); ?></td>
	  <td style="text-align:right"><?php echo $this->cart->format_number($items['profit']); ?></td>
	  <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
	  <td><?php echo anchor('sales/remove/'.$items['rowid'],'X'); ?></td>
	</tr>

<?php $i++; ?>

<?php endforeach; ?>

<tr>
	<td colspan="6" class="right" >
		<strong>Total</strong>
	</td>
  <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
  <td></td>
</tr>
</tbody>
</table>
</div>
<div class="btn-group">
	<?=  anchor('sales/destroy',' Destroy Cart',['class'=>'btn btn-danger','role'=>'button']) ?>
	<?php
		$btncartupdate = array(
			'class' => 'btn btn-primary',
			'name' => '',
			'value' => 'Update Cart',
		);
		echo form_submit($btncartupdate);
	?>
</div>
<?php echo form_close(); ?>

	<?php
		$url_check	='<button class="btn btn-success center-block" type="submit">';
		$url_check	 .= 'Check Out'.'</button>';
	?>
	<?php if  ($this->cart->total_items()!=0):?>
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

	<button class="btn btn-success btn-lg" onclick="add_custm()" > Check Out</button>
	
	<?php endif ;?>
	
	
	<link href="vendors/chosen.min.css" rel="stylesheet" media="screen">
    <script src="vendors/chosen.jquery.min.js"></script>
    <script>
        $(function() {
            $(".chzn-select").chosen();
        });
    
	function add_custm()
	{
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Add Customer Information'); // Set Title to Bootstrap modal title
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

		url = "<?php echo base_url('order')?>";
		
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
                window.location = "<?php echo base_url().'preview'; ?>";
				//reload_table();
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
            alert('Error adding data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
	}
	
	</script>
	
	
	
	
<!-- Check out customer view model	-->

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 glyphicon-asterisk">Customer Name</label>
                            <div class="col-md-9 ">
                                <input name="custm_name" placeholder="Customer Name" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Address</label>
                            <div class="col-md-9">
                                <textarea name="address" placeholder="Address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 glyphicon-asterisk">Cash</label>
                            <div class="col-md-9">
                                 <input name="cash" placeholder="Cash" class="form-control" type="Text" required>
                                <span class="help-block"></span>
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php
/* 	$attributes = array(
		'class'     =>  'blue-button',
		'width'     =>  '800',
		'height'    =>  '600',
		'screenx'   =>  '\'+((parseInt(screen.width) - 800)/2)+\'',
		'screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
	);
	echo anchor_popup('sales/destroy', 'Start Worksheet', $attributes); */
	?>

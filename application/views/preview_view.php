    <style type="text/css">
      .sidebar-nav {
        padding: 9px 0;
      }
	  #customer { overflow: hidden; }
		#customer-title { font-size: 20px; font-weight: bold; float: left; }
		#meta { margin-top: 1px; width: 300px; float: right; }
		#meta td { text-align: right;  }
		#meta td.meta-head { text-align: left; background: #eee; }
		#meta td textarea { width: 100%; height: 20px; text-align: right; }
		tr td {text-align: right;}
    </style>
<div id="content">
	<center>
	<div style="font:bold 25px 'Aleo';">Sales Receipt</div>
		</br>
	</center>
	
	<table>
		<tr>	
		<td>Name :&nbsp;</td><td>..................................</td>
		</tr>
		<tr>	
		<td>Address :&nbsp;</td><td>................................</td>
		</tr>
		<tr>
			<td>Invoice :&nbsp;</td>
			<td></td>
		</tr>
		<tr>
			<td>Date :&nbsp;</td>
			<td><div id="date"></div></td>
		</tr>
	</table>
	
	<div class="clearfix"></div>

	</br></br>
	<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px; text-align:left;" width="70%">
		<thead>
			<tr>
				<th width="90"> Product Code </th>
				<th> Product Name </th>
				<th> Qty </th>
				<th> Price </th>
				<th> Discount </th>
				<th> Amount </th>
			</tr>
		</thead>
		<tbody>
			<?php $total=0; ?>
			<?php if(isset($records)) : foreach ($records as $row):  ?>
				<tr class="record">
				<td><?php echo $row['product_type']; ?></td>
				<td><?php echo $row['product_title']; ?></td>
				<td><?php echo $row['qty']; ?></td>
				<td><?php echo $row['price']; ?></td>
				<td></td>
				<td><?php echo $row['qty'] * $row['price'] ?></td>
					<?php 
						$total = $row['qty'] * $row['price'] + $total;
					?>
				</tr>
			<?php endforeach;?>
			<?php endif;?>				
				<tr>
					<td colspan="5" style=" text-align:right;"><strong style="font-size: 12px;">Total: &nbsp;</strong></td>
					<td colspan="2"><strong style="font-size: 12px;">
					<?php echo $total; //$row['total_price'];?>
					</strong></td>
				</tr>

				<tr>
					<td colspan="5"style=" text-align:right;"><strong style="font-size: 12px; color: #222222;">Cash Tendered:&nbsp;</strong></td>
					<td colspan="2"><strong style="font-size: 12px; color: #222222;">

					</strong></td>
				</tr>

				<tr>
					<td colspan="5" style=" text-align:right;"><strong style="font-size: 12px; color: #222222;">
					<font style="font-size:20px;">&nbsp;
					</strong></td>
					<td colspan="2"><strong style="font-size: 15px; color: #222222;">

					</strong></td>
				</tr>

		</tbody>
	</table>
	</br>
	</br>
	</br>
	<div class="footer">
		<table>
			<tr>
				<td  width="85%"><div class="pull-left">Customer Signature: _ _ _ _ _ _</div></td>
				<td width="20%" style="text-align:right;"> <font style="font-weight: bold;">Sales By: </font></td>
			</tr>
		</table>
	</div>
</div>
	
	
	<div class="pull-right btn-lg" style="margin-right:100px;">
		<a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
	</div>

	<script language="javascript">
		function Clickheretoprint()
		{
		  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
			  disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
		  var content_vlue = document.getElementById("content").innerHTML; 
		  
		  var docprint=window.open("","",disp_setting); 
		   docprint.document.open(); 
		   docprint.document.write('</head><body onLoad="self.print()" style="font-size: 13px; font-family: arial;">');          
		   docprint.document.write(content_vlue); 
		   docprint.document.close(); 
		   docprint.focus(); 
		}
	</script>

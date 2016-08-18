<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<title>
POS
</title>
	 <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/DT_bootstrap.css">
	 <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css">
	 <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
	 <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    .sidebar-nav {
        padding: 9px 0;
    }
	.active{
		background-color: #356BA1;
		border-radius: 0px 50px 0px 0px;
	  }
    </style>
	
	<link href="<?php echo base_url(); ?>style.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>css/simple-sidebar.css" rel="stylesheet">

	<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
	<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>


	
	

<script language="javascript" type="text/javascript">

	/* Visit http://www.yaldex.com/ for full source code
	and get more free JavaScript, CSS and DHTML scripts! */
	<!-- Begin
	var timerID = null;
	var timerRunning = false;
	function stopclock (){
	if(timerRunning)
	clearTimeout(timerID);
	timerRunning = false;
	}
	function showtime () {
	var now = new Date();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds()
	var timeValue = "" + ((hours >12) ? hours -12 :hours)
	if (timeValue == "0") timeValue = 12;
	timeValue += ((minutes < 10) ? ":0" : ":") + minutes
	timeValue += ((seconds < 10) ? ":0" : ":") + seconds
	timeValue += (hours >= 12) ? " P.M." : " A.M."
	document.clock.face.value = timeValue;
	timerID = setTimeout("showtime()",1000);
	timerRunning = true;
	}
	function startclock() {
	stopclock();
	showtime();
	}
	window.onload=startclock;
	// End -->
</script>	
</head>
<body>
<div id="wrapper">
	<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #356BA1 !important; border-bottom:none">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only" >Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>" style="color: #fff;">Point of Sales</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!--li class="activee"><a href="index.html">Home</a></li-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  style="color: #fff;">Action <span class="caret"></span></a>
              <ul class="dropdown-menu" style="background-color: #356BA1;">
                <li><a href="<?php echo base_url();?>" style="color: #fff;"><i class="icon-dashboard icon-2x"></i> DashBoard</a></li>
				<li><a href="sales.html"><i class="icon-shopping-cart icon-2x"></i> Sales</a></li>				
                <li><a href="products.html" style="color: #fff;"><i class="icon-list-alt icon-2x"></i> Products</a></li>
				<li><a href="<?php echo base_url();?>Customer_control" style="color: #fff;"><i class="icon-group icon-2x"></i> Customer</a></li>
                <li><a href="<?php echo base_url();?>Supplier_ctrl" style="color: #fff;"><i class="icon-group icon-2x"></i> Suppliers</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header" style="color: #fff;">Repors</li>
                <li><a href="salesreport.html?d1=0&d2=0" style="color: #fff;"><i class="icon-bar-chart icon-2x"></i> Sales Report</a></li>
                <li><a href="sales_inventory.html" style="color: #fff;"><i class="icon-table icon-2x"></i> Product Inventory</a></li>
				
				<li><a href="user_create.html" style="color: #fff;"><i class="icon-table icon-2x"></i> Create New User</a></li>
			  </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li title=""><a style="color: #fff;"><i class="icon-user icon-large"></i> Welcome:<strong></strong></a></li>
            <li><a style="color: #fff;"><i class="icon-calendar icon-large"></i></a>
			</li>
            <li class="activee"><a href="../index.html" style="color: #fff;"><font color="red"><i class="icon-off icon-large"></i></font> Log Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
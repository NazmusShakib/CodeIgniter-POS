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
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" href="css/font-awesome.min.css">

	 <script src="js/jquery.min.js" type="text/javascript"></script>
	 <!--script src="http://code.jquery.com/jquery-1.11.1.js" type="text/javascript"></script-->
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

</head>
<body>

<button id="btnModal" class="btn btn-warning btn-mini""><i class="icon-edit"></i></button>

<div id="tmpModal"></div>


</body>

<script type="text/javascript">
	$(document).ready(function(e) {
		$('#btnModal').click(function(){
		
		//Using ajax poster
		$.post('model.html',function(pp){
			$('#tmpModal').html(pp);
			$('#testModal').modal('show');
		
		})
		})
	});
</script>

</html>

<?php
	require_once '../phpDatabase/db_functions.php';
	$helper = new DB_FUNCTIONS();
	
	if(isset($_POST['add'])){
		$helper->insertIntoReadersWithFields($_POST['textField1'], $_POST['textField2']);
		header('Location: tableReaders.php?page='.$_GET['page'].'&box=green&message=RowAdded');
	} else if(isset($_POST['edit'])){
		header('Location: tablePois.php?box=green&message=RowEdited');
	} else if(isset($_POST['delete'])){
		foreach($_POST['rowCheckboxes'] as $key=>$row){
			$helper->deleteReaderFromID($row);
		}
		header('Location: tableReaders.php?page='.$_GET['page'].'&box=green&message=RowDeleted');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Administrator</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});
});
</script>  

<![if !IE 7]>

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>
 

<![endif]>

<!--  styled select box script version 2 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script --> 
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
      $("input.file_1").filestyle({ 
          image: "images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
      });
  });
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
 
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script> 


<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
        $(function()
{

// initialise the "Select date" link
$('#date-pick')
	.datePicker(
		// associate the link with a date picker
		{
			createButton:false,
			startDate:'01/01/2005',
			endDate:'31/12/2020'
		}
	).bind(
		// when the link is clicked display the date picker
		'click',
		function()
		{
			updateSelects($(this).dpGetSelected()[0]);
			$(this).dpDisplay();
			return false;
		}
	).bind(
		// when a date is selected update the SELECTs
		'dateSelected',
		function(e, selectedDate, $td, state)
		{
			updateSelects(selectedDate);
		}
	).bind(
		'dpClosed',
		function(e, selected)
		{
			updateSelects(selected[0]);
		}
	);
	
var updateSelects = function (selectedDate)
{
	var selectedDate = new Date(selectedDate);
	$('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
	$('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
	$('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
}
// listen for when the selects are changed and update the picker
$('#d, #m, #y')
	.bind(
		'change',
		function()
		{
			var d = new Date(
						$('#y').val(),
						$('#m').val()-1,
						$('#d').val()
					);
			$('#date-pick').dpSetSelected(d.asString());
		}
	);

// default the position of the selects to today
var today = new Date();
updateSelects(today.getTime());

// and update the datePicker to reflect it...
$('#d').trigger('change');
});
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo">
		<a href>
			<img src="images/shared/logo.png" width="240" height="40" alt>
		</a>
	</div>
	<!-- end logo -->
	
	<!--  start top-search -->

 	<!--  end top-search -->
 	<div class="clear"></div>
	
</div>
<!-- End: page-top -->
	
</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 

		<!-- start nav-right -->
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
		<div class="table">
		
		<ul class="current"><li><a href="#nogo"><b>Tables</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub show">
			<ul class="sub">
				<li><a href="tableReaders.php">Readers</a></li>
				<li><a href="tablePois.php">Points of interest</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		                    
		<ul class="select"><li><a href="#nogo"><b>Exit</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		
		
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Readers</h1>
	</div>
	<!-- end page-heading -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			
				<!--  Start Messages 
				<div id="message-yellow">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="yellow-left">You have a new message. <a href="">Go to Inbox.</a></td>
					<td class="yellow-right"><a class="close-yellow"><img src="images/table/icon_close_yellow.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
			
				

				<div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">Error. <a href="">Please try again.</a></td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>

				

				<div id="message-blue">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="blue-left">Welcome back. <a href="">View my account.</a> </td>
					<td class="blue-right"><a class="close-blue"><img src="images/table/icon_close_blue.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
>
				<div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left">Product added sucessfully. <a href="">Add new one.</a></td>
					<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
				End Messages //-->
				<?php
					if(isset($_GET['message'])){
						if($_GET['message'] == "RowAdded"){
							echo "<div id=\"message-green\">
									<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
									<tr>
										<td class=\"green-left\">Record added successfully.</td>
										<td class=\"green-right\"><a class=\"close-green\"><img src=\"images/table/icon_close_green.gif\"   alt=\"\" /></a></td>
									</tr>
									</table>
									</div>";
						} else if($_GET['message'] == "RowDeleted"){
							echo "<div id=\"message-green\">
									<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
									<tr>
										<td class=\"green-left\">Record(s) deleted successfully.</td>
										<td class=\"green-right\"><a class=\"close-green\"><img src=\"images/table/icon_close_green.gif\"   alt=\"\" /></a></td>
									</tr>
									</table>
									</div>";
						}
					}
				?>
		
		 
				<!--  start product-table ..................................................................................... -->
				<form method="POST" id="mainform" action="">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Area Identification</a>	</th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Reader Serial Number</a></th>
				</tr>
				<?php
					require_once '../phpDatabase/db_functions.php';
					
					$GLOBALS['rec_limit'] = 10;
					$helper = new DB_FUNCTIONS();
					$result = $helper->getAllReaders();
					$GLOBALS['rec_count'] = $result->num_rows;
					if( isset($_GET{'page'} ) )
					{
						$GLOBALS['page'] = $_GET{'page'} + 1;
						$offset = $GLOBALS['rec_limit'] * $GLOBALS['page'] ;
					}
					else
					{
						$GLOBALS['page'] = 0;
						$offset = 0;
					}
					
					$GLOBALS['left_rec'] = $GLOBALS['rec_count'] - ($GLOBALS['page'] * $GLOBALS['rec_limit']);
					$result = $helper->getAllReadersLtd($offset, $GLOBALS['rec_limit']);
					
					
					$alternateRow = false;
					while ($row = $result->fetch_assoc()) {
						if(!$alternateRow){
							echo '<tr>';
						} else {
							echo '<tr class="alternate-row">';
						}
						echo '<td><input type="checkbox" name="rowCheckboxes[]" value="'.$row['reader_ID'].'"/></td>
						<td>'.$row['areaID'].'</td>
						<td>'.$row['sensorSerial'].'</td>
						</tr>';
						$alternateRow = !$alternateRow;
					}
					
					$GLOBALS['page'] = $page; 
	
				?>
				</table>
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
					<tr>
						<td><input id="text_field" type="text" name="textField1"></td>
						<td><input id="text_field1" type="text" name="textField2"></td>
					</tr>
				</table>
				<!--  end product-table................................... --> 
			</div>
			<!--  end content-table  -->
		
			<!--  start actions-box ............................................... -->
			<div id="actions-box">
				<a href="" class="action-slider"></a>
				<div id="actions-box-slider">
					<input id="action-new" type="submit" value="Add" name="add"/>
					<input id="action-edit" type="submit" value="Edit" name="edit"/>
					<input id="action-delete" type="submit" value="Delete" name="delete"/>
				</div>
				<div class="clear"></div>
			</div>
			</form>
			<!-- end actions-box........... -->
			
			<!--  start paging..................................................... -->
			<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
			<tr>
			<td>
				<?php
					$page = $GLOBALS['page'];
					if( $page > 0 )
					{
						if($GLOBALS['left_rec'] < $GLOBALS['rec_limit']){
							$last = $page - 2;
							echo "<a href=\"tableReaders.php?page=$last\" class=\"page-left\"></a>";
						} else {
							$last = $page - 2;
							echo "<a href=\"tableReaders.php?page=$last\" class=\"page-left\"></a>";
							echo "<a href=\"tableReaders.php?page=$page\" class=\"page-right\"></a>";
						}
						
					}
					else if( $page == 0 )
					{
						echo "<a href=\"tableReaders.php?page=$page\" class=\"page-right\"></a>";
					}
					else if( $GLOBALS['left_rec'] < $GLOBALS['rec_limit'] )
					{
						$last = $page - 2;
						echo "<a href=\"tableReaders.php?page=$last\" class=\"page-left\"></a>";
					}
				?>
			</td>
			</tr>
			</table>
			<!--  end paging................ -->
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	
	Administrator Page</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>
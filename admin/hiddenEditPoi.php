<?php
	require_once '../phpDatabase/db_functions.php';
	require_once 'simple_html_dom.php';
	$helper = new DB_FUNCTIONS();
	
	$result = "initial";
	
	if(isset($_POST['edit_inner'])){
		$helper->updatePoi($_GET['poiID'], $_POST['name_textInput'], $_POST['description_textArea'],
			$_POST['category_select']);
		$dom = new DOMDocument();
		
		$counter = 0; 				
		
		$html = file_get_html('hiddenEditPoi.php');
		$ret = $html->find('#sortable1');
		foreach($ret as $result){
			$counter++;
		}
		if ($_FILES['image_upload']["error"] > 0){
			echo "<font size = '5'><font color=\"#e31919\">Error: NO CHOSEN FILE <br />";
			echo"<p><font size = '5'><font color=\"#e31919\">INSERT TO DATABASE FAILED";
			$result = "no if";
		} else { 
			move_uploaded_file($_FILES["image_upload"]["tmp_name"],"images/landingCovers/" . $_FILES["image_upload"]["name"]);
			$file="images/landingCovers/".$_FILES["image_upload"]["name"];
			$result = $helper->storeImagePath($_GET['poiID'], $file);
		}
		header('Location: tablePois.php?box=green&message=RowEdited&cat='.$_POST['category_select'].'&count='.sizeof($html->find('#sortable1')));
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
<!--<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>-->

 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!--  checkbox styling script -->




<script type="text/javascript">
$(document).ready(function() {
	$( "#sortable1, #sortable2" ).sortable({
	connectWith: ".connectedSortable"
	}).disableSelection();
});
</script>

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


<script>
function resetForm() {
    document.getElementById("edit_form").reset();
	document.getElementById("poi_input_name").setAttribute("value", "");
	document.getElementById("poi_input_description").innerHTML = '';
}
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

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
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Add product</h1></div>


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
	
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
		<!-- start id-form -->
	<?php
	$categoryNames = ["Restaurant", "Bank", "Shopping", "Gate", "Toilets"];
	require_once '../phpDatabase/db_functions.php';
	$poiID = $_GET['poiID'];
	$helper = new DB_FUNCTIONS();
	$poi = $helper->getPoiByID($poiID);
	$poi = $poi->fetch_assoc();
	$assocs = $helper->getPoiAssociations($poi['poi_ID']);
	
	echo '<form id="edit_form" method="POST" action="" enctype="multipart/form-data"><table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">PoI name:</th>
			<td><input name="name_textInput" id="poi_input_name" type="text" class="inp-form" value="'.$poi['poiName'].'" /></td>
			<td></td>
		</tr>
		<tr>
		<th valign="top">Category:</th>
		<td>	
		<select name="category_select" class="styledselect_form_1">';
		for($i=0;$i<5;$i++){
			echo '<option value="'.($i + 1).'"';
			if($poi['poiCategory'] == $i + 1){
				echo 'selected="selected"';
			}
			echo '>'.$categoryNames[$i].'</option>';
		}	
		echo '</select>
		</td>
		<td></td>
		</tr> 
	<tr>
		<th valign="top">Description:</th>
		<td><textarea name="description_textArea" id="poi_input_description" rows="" cols="" class="form-textarea">'.$poi['poiDescription'].'</textarea></td>
		<td></td>
	</tr>
	<tr>
		<th valign="top">Associations:</th><td>
		<ul id="sortable1" class="connectedSortable">';
			foreach($assocs as $readerID){
			echo '<li class"ui-state-default">'.$readerID['reader_FK'].'</li>';
		}
		echo '</ul><ul id="sortable2" class="connectedSortable">';
		$allReaders = $helper->getAllReaders();
		while($row = $allReaders->fetch_assoc()){
			echo '<li class"ui-state-default2">'.$row['reader_ID'].'</li>';
		}
		echo '</ul>
		</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
	<th>Large Image:</th>
	<td><input type="file" class="file_1" name="image_upload"/></td>
	<td>
	<div class="bubble-left"></div>
	<div class="bubble-inner">JPEG, GIF 20MB max per image</div>
	<div class="bubble-right"></div>
	</td>
	</tr>
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" value="" class="form-submit" name="edit_inner"/>
			<input type="reset" value="" class="form-reset" onClick="resetForm()" />
		</td>
		<td></td>
	</tr>
	</table></form>';
?>
	<!-- end id-form  -->

	</td>
</tr>
<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
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

<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .bg-1 { 
      background-color: #1abc9c;
      color: #ffffff;
  }
  .bg-2 { 
      background-color: #474e5d;
      color: #ffffff;
  }
  .bg-3 { 
      background-color: #ffffff;
      color: #555555;
  }

  </style>
<style>
BODY {
	FONT-FAMILY: arial,sans-serif
}
TD {
	FONT-FAMILY: arial,sans-serif
}
A {
	FONT-FAMILY: arial,sans-serif
}
P {
	FONT-FAMILY: arial,sans-serif
}
.h {
	FONT-FAMILY: arial,sans-serif
}
.h {
	FONT-SIZE: 20px
}
.q {
	COLOR: #0000cc
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #f1f1f1;
}

li {
    float: left;
}

li a {
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

div.content {
    margin-left: 15%;
    padding: 1px 16px;
    height: 1000px;
}
input[type=text] {
    width: 50%;
    box-sizing: 50px;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    padding: 12px 20px 12px 40px;
}

    #custom-search-form {
        margin:0;
        margin-top: 5px;
        padding: 0;
		
    }
 
    #custom-search-form .search-query {
        padding-right: 3px;
        padding-right: 4px \9;
        padding-left: 3px;
        padding-left: 4px \9;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
		position: fixed;
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
 
    #custom-search-form button {
        border: 0;
        background: none;
        /** belows styles are working good */
        padding: 2px 5px;
        margin-top: 2px;
        position: fixed;
        left: -10px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

#sidebar {
    position:absolute fixed;
    width:10%;
	height: 100%;
}
#sidebartext {
    position:absolute;
    top:0; bottom:0; left:10;
    width:180px;
}
 
    .search-query:focus + button {
        z-index: 3;   
    }
.container { 
  width:40%;
  padding:100px 200px 0px 0;
}	
.sidenav {
  height:100px;
  width:100%;
  position:fixed;
  top:0;
    z-index:1;
}
.sidenav1 {
  height:100%;
  width:200;
  position:fixed;
  top:100;
  z-index:1;
}

.sidenav2 {
  height:100%;
  width:25%;
  position:fixed;
  top:100;
  right:0;
  color:grey;
  z-index:1;
}
.container2 {
	position:relative;
	align:center;
	width:40%;
	left:260px;
	padding:100px 0 0 0;
	z-index:0;
}
.container1 {
  width:40%;
  height:100%;
  position:relative;
  top:100;
  left:225;
}
</style>
</head>
<BODY text=#000000 vLink=#551a8b aLink=#ff0000 link=#0000cc bgColor=#ffffff>
<ul class="sidenav">
  <li><a href="search.html"><img alt=Twoogle src="top.png" style="width:200px;height:50px;"></a></li>
  </br><font align="left"><form name="cse" id="demo" method="GET" action="search.php"><input name="q" class="form-group" type="text" size="200" value="<?php echo (urldecode($_GET['q'])); ?>"/>
  <input name="start" type=hidden value="0"/>
  <input name="rows" type=hidden value="10"/>
  <input name="page" type=hidden value="1"/>
  <button type="submit" class="btn btn-info btn-lg btn-lg" onclick="search()" title="search">
      <span class="glyphicon glyphicon-search"></span> Search
    </button></form></font>	
</ul>
</br></br>

<div class="sidenav1">
<div id="sidebartext">
<h2 class="left">Advanced Search</h2>
<div class="panel panel-info"><div class="panel-heading">
<a href="#Lfilters" data-toggle="collapse">Language Filter</a></div>
<?php
		$rows=$_GET['rows'];
		$page=$_GET['page'];
		$start=$_GET['start'];
		$end=$start+$rows;
		$x=0;
		$q=$_GET['q'];
		$q=preg_replace('/#/', '', $q);
		$q=preg_replace('/ /', '%20', $q);
		// $q=str_replace("","%27",$q);
		if(strlen($q)==0){
			echo '<script type="text/javascript">
           window.location = "search.html"
      </script>';
		}
		function querryparser($q1, $rows1,$start1,$fqq1) {
			if(strlen($fqq1)==0){
				$qp='http://54.191.184.205:8984/solr/twoogle/select?defType=twoogle&facet.field=tweet_lang&facet.field=state&facet.field=country&facet=on&indent=on&q='.$q1.'&rows='.$rows1.'&start='.$start1.'&wt=xml';
			}
			else{
				$qp='http://54.191.184.205:8984/solr/twoogle/select?defType=twoogle&facet.field=tweet_lang&facet.field=state&facet.field=country&facet=on&indent=on&q='.$q1.'&rows='.$rows1.'&start='.$start1.'&wt=xml&fq=tweet_lang:'.$fqq1;
			}
			return $qp;
		}
		
		function querryparser_lang($q1) {
				$qp='http://54.191.184.205:8984/solr/twoogle/select?defType=twoogle&facet.field=tweet_lang&facet.field=state&facet.field=country&facet=on&indent=on&q='.$q1.'&wt=xml';
				return $qp;
		}
		
		if(isset($_GET['fq'])){
			$fq1=$_GET['fq'];
			$fqq=$fq1[0];
			for($jj=1;$jj<sizeof($_GET['fq']);$jj++)
			{
				$fqq=$fqq.' '.$fq1[$jj];
			}}
		else{$fqq='';$fq1=array();}
		$xml = simplexml_load_file(querryparser($q, $rows,$start,$fqq)) or  die('Error: Cannot create object');
		$xml1=$xml;
		//$xml1 = simplexml_load_file(querryparser_lang($q)) or  die('Error: Cannot create object');
		//$xml_lang=simplexml_load_file('http://54.191.184.205:8984/solr/twoogle/select?defType=twoogle&facet.field=tweet_lang&facet=on&indent=on&q='.$q.'&wt=xml')  die('Error: Cannot create object');
		$x=$xml->result['numFound'];
		if($end>$x){$end=$x;}
		$totalpages=floor($x/$rows);
		if($x%$rows>0){$totalpages++;}
		// echo 'http://54.244.26.98:8984/solr/IRBM25/select?indent=on&q='.$q.'&rows='.$rows.'&start='.$start.'&wt=xml&fq=lang:'.$fqq;
echo '<div id="Lfilters" class="collapse in"><div class="panel-body"><form action="search.php">
<input name="defType" type=hidden value="twoogle"/>
<input type="hidden" name="q" value='.$q.'>
<input type="hidden" name="rows" value='.$rows.'>
<input type="hidden" name="start" value='.(($page-1)*$rows).'>
<input type="hidden" name="page" value='.($page).'>';
$j=0;
foreach($xml1->lst[1]->lst[1]->lst[0]->children() as $lang){
	$a=(string)$lang->attributes()->name;
	if(sizeof($fq1)==0){
		$langg[$a]=(string)$lang;
	}
	else{
	if(in_array($a,$fq1)){
	$langg[$a]=(string)$lang;
	}
	else{
		$langg[$a]='0';
	}}
}


if (in_array("en", $fq1)) {echo '<input type="checkbox" name="fq[]" id="fq1" value="en" checked onclick=submit()>English ('.$langg['en'].')<br>';}
else{echo '<input type="checkbox" name="fq[]" id="fq1" value="en" onclick=submit()>English ('.$langg['en'].')<br>';}
if (in_array("de", $fq1)) {echo '<input type="checkbox" name="fq[]" id="fq2" value="de" checked onclick=submit()>German ('.$langg['de'].')<br>';}
else{echo '<input type="checkbox" name="fq[]" id="fq2" value="de" onclick=submit()>German ('.$langg['de'].')<br>';}
if (in_array("ru", $fq1)) {echo '<input type="checkbox" name="fq[]" id="fq3" value="ru" checked onclick=submit()>Russian ('.$langg['ru'].')<br>';}
else{echo '<input type="checkbox" name="fq[]" id="fq3" value="ru" onclick=submit()>Russian ('.$langg['ru'].')<br>';}
if (in_array("es", $fq1)) {echo '<input type="checkbox" name="fq[]" id="fq3" value="es" checked onclick=submit()>Spanish ('.$langg['es'].')<br>';}
else{echo '<input type="checkbox" name="fq[]" id="fq3" value="es" onclick=submit()>Spanish ('.$langg['es'].')<br>';}
if (in_array("fr", $fq1)) {echo '<input type="checkbox" name="fq[]" id="fq3" value="fr" checked onclick=submit()>French ('.$langg['fr'].')<br>';}
else{echo '<input type="checkbox" name="fq[]" id="fq3" value="fr" onclick=submit()>French ('.$langg['fr'].')<br>';}
echo '</form></div></div></div>';

echo '<br>
</div>';
echo '</div>

<div class="sidenav2">
<h2 class="left">Analytics</h2>
<div class="panel panel-info"><div class="panel-heading">
<a href="#Lang" data-toggle="collapse">Languages</a></div>
<div id="Lang" class="collapse"><div class="panel-body">';
$values = [];

//pushing some variables to the array so we can output something in this example.
array_push($values, array("year" => "English", "newbalance" => $langg['en']));
array_push($values, array("year" => "German", "newbalance" => $langg['de']));
array_push($values, array("year" => "Russian", "newbalance" => $langg['ru']));
array_push($values, array("year" => "Spanish", "newbalance" => $langg['es']));
array_push($values, array("year" => "French", "newbalance" => $langg['fr']));

//counting the length of the array
$countArrayLength = count($values);


$aa=0;
foreach($xml1->lst[1]->lst[1]->lst[1]->children() as $state){
	$a=(string)$state->attributes()->name;
	$states[$aa]=(string)$a;
	$statesno[$aa]=(string)$state;
	$aa=$aa+1;
}
$values1 = [];

//pushing some variables to the array so we can output something in this example.
array_push($values1, array("year" => $states[0], "newbalance" => $statesno[0]));
array_push($values1, array("year" => $states[1], "newbalance" => $statesno[1]));
array_push($values1, array("year" => $states[2], "newbalance" => $statesno[2]));
array_push($values1, array("year" => $states[3], "newbalance" => $statesno[3]));
array_push($values1, array("year" => $states[4], "newbalance" => $statesno[4]));


//counting the length of the array
$countArrayLength1 = count($values1);

$aaa=0;
foreach($xml1->lst[1]->lst[1]->lst[2]->children() as $cont){
	$a=(string)$cont->attributes()->name;
	$conts[$aaa]=(string)$a;
	$contno[$aaa]=(string)$cont;
	$aaa=$aaa+1;
}
$values2 = [];

//pushing some variables to the array so we can output something in this example.
array_push($values2, array("year" => $conts[0], "newbalance" => $contno[0]));
array_push($values2, array("year" => $conts[1], "newbalance" => $contno[1]));
array_push($values2, array("year" => $conts[2], "newbalance" => $contno[2]));
array_push($values2, array("year" => $conts[3], "newbalance" => $contno[3]));
array_push($values2, array("year" => $conts[4], "newbalance" => $contno[4]));

$str = `python test_senti.py`;
$arr = explode("\n", $str);
// $arr=['243','201','556'];
//counting the length of the array
$countArrayLength1 = count($values1);

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Year');
    data.addColumn('number', 'Balance');

    data.addRows([

    <?php
    for($i=0;$i<$countArrayLength;$i++){
        echo "['" . $values[$i]['year'] . "'," . $values[$i]['newbalance'] . "],";
    } 
    ?>
    ]);

    var options = {
        title: 'Languages',
		pieHole: 0.3,
		pieSliceTextStyle: {fontSize:9},
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
}


function drawChart1() {

    var data1 = new google.visualization.DataTable();
    data1.addColumn('string', 'Year1');
    data1.addColumn('number', 'Balance1');

    data1.addRows([

    <?php
    for($i=0;$i<$countArrayLength1;$i++){
        echo "['" . $values1[$i]['year'] . "'," . $values1[$i]['newbalance'] . "],";
    } 
    ?>
    ]);

    var options1 = {
        title: 'States',
		pieHole: 0.3,
		pieSliceTextStyle: {fontSize:9},
    };

    var chart1 = new google.visualization.PieChart(document.getElementById('piechart'));
    chart1.draw(data1, options1);
}


function drawChart2() {

    var data1 = new google.visualization.DataTable();
    data1.addColumn('string', 'Year1');
    data1.addColumn('number', 'Balance1');

    data1.addRows([

    <?php
    for($i=0;$i<$countArrayLength1;$i++){
        echo "['" . $values2[$i]['year'] . "'," . $values2[$i]['newbalance'] . "],";
    } 
    ?>
    ]);

    var options1 = {
        title: 'Countries',
		pieHole: 0.3,
		is3D: true,
		pieSliceTextStyle: {fontSize:0.1}
    };

    var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
    chart1.draw(data1, options1);
}

function drawChart4() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Positive",<?php echo $arr[0] ?>, "green"],
        ["Neutral", <?php echo $arr[1] ?>, "silver"],
        ["Negative", <?php echo $arr[2] ?>, "red"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Sentimental Analysis",
        width: 200,
        height:200,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
</script>

<div class="grid-container"> 
<div class="grid-100 grid-parent">
    <div id="donutchart" style="width: 100%; height: auto"></div>
</div>   
</div>
</div>
</div>
</div>


<?php

echo '<div class="panel panel-info"><div class="panel-heading">
<a href="#state" data-toggle="collapse">States</a></div>
<div id="state" class="collapse"><div class="panel-body">';

?>
<script type="text/javascript">
google.charts.setOnLoadCallback(drawChart1);
</script>

<div class="grid-container"> 
<div class="grid-100 grid-parent">
    <div id="piechart" style="width: 100%; height: auto"></div>
</div>  

</div>

</div>
</div>
</div>


<?php

echo '<div class="panel panel-info"><div class="panel-heading">
<a href="#country" data-toggle="collapse">Countries</a></div>
<div id="country" class="collapse in"><div class="panel-body">';

?>
<script type="text/javascript">
google.charts.setOnLoadCallback(drawChart2);
</script>

<div class="grid-container"> 
<div class="grid-100 grid-parent">
    <div id="piechart1" style="width: 80%; height: auto"></div>
</div>  

</div>

</div>
</div>
</div>


<?php

echo '<div class="panel panel-info"><div class="panel-heading">
<a href="#sa" data-toggle="collapse">Sentimental Analysis</a></div>
<div id="sa" class="collapse"><div class="panel-body">';

?>
<script type="text/javascript">
google.charts.setOnLoadCallback(drawChart4);
</script>

<div class="grid-container"> 
<div class="grid-100 grid-parent">
    <div id="barchart_values" style="width: 100%; height: auto"></div>
</div>  

</div>

</div>
</div>
</div>









</div>
<div class="container2">
<div class="left">
<table class="table">
<div class="panel panel-primary">
      <div class="panel-heading"><p>Displaying <?php		
		echo ++$start;
		echo ' to '.$end.' documents of total '.$x.' in page '.$page.' of total '.$totalpages.' pages.';
      ?></p></div></div>
	  <?php		 
         foreach($xml->result->children() as $comps) {
			echo '<div class="media">
				<div class="media-body">
				<div class="panel panel-info">
				<div class="panel-heading">';
				foreach($comps->children() as $comp){
					if((string) $comp->attributes()->name=="user_name")
					{
					echo $comp->str;
					}
				}
				echo '&nbsp;&nbsp;<font size="2" color="grey"><i>@';
				foreach($comps->children() as $comp){
					if((string) $comp->attributes()->name=="screen_name")
					{
					echo $comp->str;
					}
				}
				echo '</i></font>';
				echo '</div>
				<div class="media-left"><img src="';
				foreach($comps->children() as $comp){
					if((string) $comp->attributes()->name=="profile_image")
					{
					echo $comp->str;
					}
				}
				echo '" class="media-object" alt="profile_pic" height="70" width="70"/></div><div class="media-left">
				<p>';
				foreach($comps->children() as $comp){
					if((string) $comp->attributes()->name=="tweet_text")
					{
						$temp=$comp->str;
					echo $comp->str;
					}
				}
				for($i=strlen($temp);$i<=140;$i++)
					{
						echo '&nbsp;';
					}
				echo '</p><div class="" align="right">';
				echo '<span class="label label-primary"><span class="glyphicon glyphicon-retweet"></span>';
				echo ' ';
				foreach($comps->children() as $comp){
					if((string) $comp->attributes()->name=="retweet_count")
					{
					echo (string)$comp->long;
					}
				}
				echo '</span>';
				echo '&nbsp;';
				echo '<span class="label label-success"><span class="glyphicon glyphicon-user"></span>';
				echo ' ';
				foreach($comps->children() as $comp){
					if((string) $comp->attributes()->name=="followers_count")
					{
					echo (string)$comp->long;
					}
				}
				echo '</span>';
				echo '</br><font size="0.25"> </font>';
				echo '</div></div></div></div>';
			echo '</div>';
		}
      ?>
	  <?php		 

      ?>
	  
</table>
</div>
<div class="sidenav2">
</div>

<?php
echo '<center><ul class="pagination">';
$flag=1;
if($totalpages<=10 or $page<=6){
if($totalpages<=10){$startpage=1;
	$endpage=$totalpages;
	$flag=0;}
else{$startpage=1;
$endpage=10;
}	
}
else
{
	echo '<li><a href="search.php?defType=twoogle&facet.field=tweet_lang&facet=on&q='.$q.'&rows='.$rows.'&start=0&page=1">1&lt;&lt;&lt;</a></li>';
	echo '<li><a href="search.php?defType=twoogle&facet.field=tweet_lang&facet=on&q='.$q.'&rows='.$rows.'&start='.(($page-2)*$rows).'&page='.($page-1).'">&lt;Previous</a></li>';
	$startpage=$page-5;
	$endpage=$page+4;
	if($endpage>=$totalpages){
		$startpage=$totalpages-9;
		$endpage=$totalpages;
		$flag=0;
	}
}

for($i=$startpage;$i<=$endpage;$i++){
	if($i==$page){echo '<li class="active"><a>'.$i.'</a></li>';}
	else {echo '<li><a href="search.php?defType=twoogle&facet.field=tweet_lang&facet=on&q='.$q.'&rows='.$rows.'&start='.(($i-1)*$rows).'&page='.$i.'">'.$i.'</a></li>';}
}
if($flag==1){
	echo '<li><a href="search.php?defType=twoogle&facet.field=tweet_lang&facet=on&q='.$q.'&rows='.$rows.'&start='.(($page)*$rows).'&page='.($page+1).'">Next&gt;&gt;&gt;</a></li>';
}
echo '</center></ul>';


?>
</br>
</br>
</br>
</div>
</BODY>
</HTML>
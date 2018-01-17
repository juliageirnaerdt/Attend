<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php $page_title ="Attend"; ?>
	<?php $fb_page_id = "339755068127"; ?>

	<?php $year_range = 2;

// automatically adjust date range
// human readable years
	$since_date = date('2016-01-01', strtotime('-' . $year_range . ' years'));
	$until_date = date('2021-01-01', strtotime('+' . $year_range . ' years'));

// unix timestamp years
	$since_unix_timestamp = strtotime($since_date);
	$until_unix_timestamp = strtotime($until_date);

// or you can set a fix date range:
// $since_unix_timestamp = strtotime("2016-01-08");
// $until_unix_timestamp = strtotime("2020-06-28"); 

	$access_token = "1994230297502387|9Pr3rScWL5pt9syo3rbDLFqalvk";

	$fields="id,name,description,place,timezone,start_time,cover";

	$json_link = "https://graph.facebook.com/v2.7/{$fb_page_id}/events/attending/?fields={$fields}&access_token={$access_token}&since={$since_unix_timestamp}&until={$until_unix_timestamp}";

	$json = file_get_contents($json_link);

	$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);?>
	
	<div class="page-header">

		<h1><?php echo $page_title; ?></h1>

	</div>



	<table class="table table-hover table-responsive table-bordered">

<?php	// count the number of events
$event_count = count($obj['data']);

for($x=0; $x<$event_count; $x++){
	// facebook page events will be here

		// set timezone
	date_default_timezone_set($obj['data'][$x]['timezone']);

	$start_date = date( 'l, F d, Y', strtotime($obj['data'][$x]['start_time']));
	$start_time = date('g:i a', strtotime($obj['data'][$x]['start_time']));

	$pic_big = isset($obj['data'][$x]['cover']['source']) ? $obj['data'][$x]['cover']['source'] : "https://graph.facebook.com/v2.7/{$fb_page_id}/picture?type=large";

	$eid = $obj['data'][$x]['id'];
	$name = $obj['data'][$x]['name'];
	$description = isset($obj['data'][$x]['description']) ? $obj['data'][$x]['description'] : "";

// place
	$place_name = isset($obj['data'][$x]['place']['name']) ? $obj['data'][$x]['place']['name'] : "";
	$city = isset($obj['data'][$x]['place']['location']['city']) ? $obj['data'][$x]['place']['location']['city'] : "";
	$country = isset($obj['data'][$x]['place']['location']['country']) ? $obj['data'][$x]['place']['location']['country'] : "";
	$zip = isset($obj['data'][$x]['place']['location']['zip']) ? $obj['data'][$x]['place']['location']['zip'] : "";

	$location="";

	echo "<tr>";
	echo "<td rowspan='6' style='width:20em;'>";
	echo "<img src='{$pic_big}' width='200px' />";
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td style='width:15em;'>What:</td>";
	echo "<td><b>{$name}</b></td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>When:</td>";
	echo "<td>{$start_date} at {$start_time}</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>Where:</td>";
	echo "<td>{$location}</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>Description:</td>";
	echo "<td>{$description}</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>Facebook Link:</td>";
	echo "<td>";
	echo "<a href='https://www.facebook.com/events/{$eid}/' target='_blank'>View on Facebook</a>";
	echo "</td>";
	echo "</tr>";


	if($place_name && $city && $country && $zip){
		$location="{$place_name}, {$city}, {$country}, {$zip}";
	}else{
		$location="Location not set or event data is too old.";
	}
}
?>
</table>



<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

</head>
<body>


	<div class="container">

		<!-- events will be here -->

	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</body>
</html>
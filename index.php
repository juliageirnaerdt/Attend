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

	$access_token = "1994230297502387";

	$fields="id,name,description,place,timezone,start_time,cover";

	$json_link = "https://graph.facebook.com/v2.7/{$fb_page_id}/events/attending/?fields={$fields}&access_token={$access_token}&since={$since_unix_timestamp}&until={$until_unix_timestamp}";

	$json = file_get_contents($json_link);

	$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);?>

<div class="page-header">

	<h1><?php echo $page_title; ?></h1>

</div>



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
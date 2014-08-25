<?php

require_once "cal.php";

$year = ( $_GET['year'] ? $_GET['year'] : date('Y') );
$month = ( $_GET['month'] ? $_GET['month'] : date('m') );
$day = ( $_GET['day'] ? $_GET['day'] : date('d') );

$cal = new Calendar($year, $month, $day);

?>

<style>
#wrap { margin: 0 auto; width: 300px; }
form { display: inline-block; }
</style>

<div id="wrap">
<form method="get">
	<select name="day">
		<option<?= ( $day == 01 ? ' selected' : '' ) ?>>01</option>
		<option<?= ( $day == 02 ? ' selected' : '' ) ?>>02</option>
		<option<?= ( $day == 03 ? ' selected' : '' ) ?>>03</option>
		<option<?= ( $day == 04 ? ' selected' : '' ) ?>>04</option>
	</select>
	<select name="month">
		<option value="01"<?= ( $month === '01' ? ' selected' : '' ) ?>>Jan</option>
		<option value="02"<?= ( $month === '02' ? ' selected' : '' ) ?>>Feb</option>
		<option value="03"<?= ( $month === '03' ? ' selected' : '' ) ?>>Mar</option>
		<option value="04"<?= ( $month === '04' ? ' selected' : '' ) ?>>Apr</option>
		<option value="05"<?= ( $month === '05' ? ' selected' : '' ) ?>>May</option>
		<option value="06"<?= ( $month === '06' ? ' selected' : '' ) ?>>Jun</option>
		<option value="07"<?= ( $month === '07' ? ' selected' : '' ) ?>>Jul</option>
		<option value="08"<?= ( $month === '08' ? ' selected' : '' ) ?>>Aug</option>
		<option value="09"<?= ( $month === '09' ? ' selected' : '' ) ?>>Sep</option>
		<option value="10"<?= ( $month === '10' ? ' selected' : '' ) ?>>Oct</option>
		<option value="11"<?= ( $month === '11' ? ' selected' : '' ) ?>>Nov</option>
		<option value="12"<?= ( $month === '12' ? ' selected' : '' ) ?>>Dec</option>
	</select>
	<select name="year">
		<option<?= ( $year == 2015 ? ' selected' : '' ) ?>>2015</option>
		<option<?= ( $year == 2014 ? ' selected' : '' ) ?>>2014</option>
		<option<?= ( $year == 2013 ? ' selected' : '' ) ?>>2013</option>
		<option<?= ( $year == 2012 ? ' selected' : '' ) ?>>2012</option>
	</select>
	<button>Go</button>
</form>
<form><button>&bull;</button></form>

<?= $cal->print_calendar(false) ?>

</div>
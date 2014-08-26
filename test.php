<?php

require_once "cal.php";

$year = ( $_GET['year'] ? $_GET['year'] : date('Y') );
$month = ( $_GET['month'] ? $_GET['month'] : date('n') );
$day = ( $_GET['day'] ? $_GET['day'] : date('d') );

$cal = new Calendar($year, $month, $day);

?>

<style>
#wrap { margin: 0 auto; width: 300px; }
form { display: inline-block; }
</style>

<div id="wrap">
<div>
<a href="<?= $cal->prev_url() ?>">Previous</a> |
<a href="<?= $cal->next_url() ?>">Next</a>
</div>
<form method="get">
	<select name="day">
		<option<?= ( $day == 1 ? ' selected' : '' ) ?>>1</option>
		<option<?= ( $day == 2 ? ' selected' : '' ) ?>>2</option>
		<option<?= ( $day == 3 ? ' selected' : '' ) ?>>3</option>
		<option<?= ( $day == 4 ? ' selected' : '' ) ?>>4</option>
	</select>
	<select name="month">
		<option value="1"<?= ( $month === '1' ? ' selected' : '' ) ?>>Jan</option>
		<option value="2"<?= ( $month === '2' ? ' selected' : '' ) ?>>Feb</option>
		<option value="3"<?= ( $month === '3' ? ' selected' : '' ) ?>>Mar</option>
		<option value="4"<?= ( $month === '4' ? ' selected' : '' ) ?>>Apr</option>
		<option value="5"<?= ( $month === '5' ? ' selected' : '' ) ?>>May</option>
		<option value="6"<?= ( $month === '6' ? ' selected' : '' ) ?>>Jun</option>
		<option value="7"<?= ( $month === '7' ? ' selected' : '' ) ?>>Jul</option>
		<option value="8"<?= ( $month === '8' ? ' selected' : '' ) ?>>Aug</option>
		<option value="9"<?= ( $month === '9' ? ' selected' : '' ) ?>>Sep</option>
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
<form><button>Today</button></form>

<?= $cal->print_calendar(false) ?>

</div>
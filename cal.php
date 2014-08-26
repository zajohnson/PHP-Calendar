<?php
class Calendar {
	public $year;
	public $month;
	public $day;
	public $today;
	public $first_day;
	public $day_of_week;
	public $days_in_month;

	/**
	 * Setup the calendar.
	 * 
	 * Set the calendar settings and prepare for methods.
	 * 
	 * @param string $year The year to show on calendar. 
	 * @param string $month The month to show on calendar. 
	 * @param string $day The day to highlight on the calendar.
	 */
	public function __construct( $year = null, $month = null, $day = null ) {
		$timestamp = time();
		
		$this->year = ( $year == null ? date('Y') : $year );
		$this->month = ( $month == null ? date('n') : $month );
		$this->day = ( $day == null ? date('j') : $day );
		
		$this->today = date('Y-n-j', time());
		$this->this_day = $this->year . '-' . $this->month . '-' . $this->day;
		
		//Here we generate the first day of the month
		$this->first_day = mktime(0,0,0, $this->month, 1, $this->year);

		//Here we find out what day of the week the first day of the month falls on
		$this->day_of_week = date('D', $this->first_day);
		
		//Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero
		switch($this->day_of_week){ 
			case "Sun": $this->blank = 0; break; 
			case "Mon": $this->blank = 1; break; 
			case "Tue": $this->blank = 2; break; 
			case "Wed": $this->blank = 3; break; 
			case "Thu": $this->blank = 4; break; 
			case "Fri": $this->blank = 5; break; 
			case "Sat": $this->blank = 6; break; 
		}
		
		//We then determine how many days are in the current month
		$this->days_in_month = cal_days_in_month(0, $this->month, $this->year);
	}
	
	/**
	 * Get the month and year.
	 * 
	 * @return string $title The previous month
	 */
	public function get_title() {
		$title = date('F, Y', $this->first_day);
		return $title;
	}
	
	/**
	 * Link to previous month.
	 * 
	 * @return string The previous month query string.
	 */
	public function prev_url() {
		$year = $this->year;
		$month = $this->month;
		
		if( $this->month == 1 ) {
			$month = 12;
			$year--;
		} else {
			$month--;
		}
		
		return '?year=' . $year . '&month=' . $month;
	}
	
	/**
	 * Link to next month.
	 * 
	 * @return string The next month query string.
	 */
	public function next_url() {
		$year = $this->year;
		$month = $this->month;
		
		if( $this->month == 12 ) {
			$month = 1;
			$year++;
		} else {
			$month++;
		}
		
		return '?year=' . $year . '&month=' . $month;
	}

	/**
	 * Print out the calendar.
	 * 
	 * Print out the table containg all the month's data.
	 * 
	 * @return string $output The calendar's output.
	 */
	public function print_calendar( $show_title = true ) {
		$output = '';
	
		//Here we start building the table heads 
		$output .= "<table>";
		
		if( $show_title )
			$output .= "<tr><th colspan=7>" . $this->get_title() . "</th></tr>";
		
		$output .= "<tr><td width=42>S</td><td width=42>M</td><td width=42>T</td><td width=42>W</td><td width=42>T</td><td width=42>F</td><td width=42>S</td></tr>";

		//This counts the days in the week, up to 7
		$day_count = 1;

		$output .= "<tr>";

		//first we take care of those blank days
		while ( $this->blank > 0 ) { 
			$output .= "<td></td>";
			$this->blank--;
			$day_count++;
		} 

		//sets the first day of the month to 1
		$day_num = 1;

		//count up the days, untill we've done all of them in the month
		while ( $day_num <= $this->days_in_month ) {
		
			$this_day = $this->year . '-' . $this->month . '-' . $day_num;
			
			$indicate = $day_num;
			
			if( $this_day == $this->today ) // this cell is today
				$indicate = "<i>$indicate</i>";
			
			if( $this_day == $this->this_day ) // this cell is this_day (the day focusing on)
				$indicate = "<mark>$indicate</mark>";
			
			$output .= '<td><a href="?year=' . $this->year . '&month=' . $this->month . '&day=' . $day_num . '">' . $indicate . '</a></td>';
			$day_num++;
			$day_count++;

			//Make sure we start a new row every week
			if ($day_count > 7) {
				$output .= "</tr><tr>";
				$day_count = 1;
			}
		}

		//Finaly we finish out the table with some blank cells if needed
		while ( $day_count > 1 && $day_count <= 7 ) { 
			$output .= "<td> </td>";
			$day_count++;
		}

		$output .= "</tr></table>";
		
		return $output;
	}
} // end class Calendar()
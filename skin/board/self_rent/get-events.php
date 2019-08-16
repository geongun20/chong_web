<?php
include_once('./_common.php');

//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timezone" GET parameter will force all ISO8601 date stings to a given timezone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
require dirname(__FILE__) . '/utils.php';

// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
	die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
// Since no timezone will be present, they will parsed as UTC.
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

// Parse the timezone parameter if it is present.
$timezone = null;
if (isset($_GET['timezone'])) {
	$timezone = new DateTimeZone($_GET['timezone']);
}

// 날짜구하기
function wz_get_addday($day, $add) {
    $day    = preg_replace('/[^0-9]/', '', $day);
    $y      = substr( $day, 0, 4 );
    $m      = substr( $day, 4, 2 );
    $d      = (int)substr( $day, 6, 2 );

    if ($add >= 0) { 
        return date("Y-m-d", mktime(0,0,0, $m, ($d+$add), $y));    
    }
    else {
        if ($d > $add) { 
            return date("Y-m-d", mktime(0,0,0, $m, ($d+$add), $y));
        } 
        else {
            return date("Y-m-d", mktime(0,0,0, $m, ($d-$add), $y));
        }
    }  
}

// Read and parse our events JSON file into an array of event data arrays.
$frdate = $_GET['start'];
$todate = $_GET['end'];

$frdate = str_replace('-', '', $frdate);
$todate = str_replace('-', '', $todate);

$input_arrays = array();
$query = "select * from {$write_table} WHERE wr_1 <= '".$todate."' AND wr_2 > '".$frdate."' and wr_1 <> '' and wr_2 <> '' ";
$res = sql_query($query);
while($row = sql_fetch_array($res)) {
    
    $rows = array();
    $rows['title']  = $row['wr_subject'];
    $rows['start']  = date('Y-m-d', strtotime($row['wr_1']));
    $rows['end']    = date('Y-m-d', strtotime($row['wr_2']));
    $rows['textColor']  = $row['wr_3'];
    $rows['color']      = $row['wr_4'];
    $rows['allDay']     = true;
    $rows['progress']   = '';
    $rows['repeat']     = '';
    $rows['url'] = G5_BBS_URL.'/board.php?w=u&bo_table='.$bo_table.'&wr_id='.$row['wr_id'];

    if ($rows['start'] != $rows['end']) { 
        $rows['end'] = wz_get_addday($rows['end'], 1);
    } 

    $input_arrays[] = $rows;
}

// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

	// Convert the input array into a useful Event object
	$event = new Event($array, $timezone);

	// If the event is in-bounds, add it to the output
	if ($event->isWithinDayRange($range_start, $range_end)) {
		$output_arrays[] = $event->toArray();
	}
}

// Send JSON to the client.
echo json_encode($output_arrays);
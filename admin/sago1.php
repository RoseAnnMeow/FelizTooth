<?php
/* Monday - Sunday */
$days1 = array(1, 2, 3, 4, 5, 6, 7);

/* Monday - Wednesday and Sunday */
$days2 = array(1, 2, 3, 7);

/* Wednesday and Sunday */
$days3 = array(3, 7);

/* Monday - Wednesday and Friday - Sunday */
$days4 = array(1, 2, 3, 5, 6, 7);

/* Monday - Wednesday, Friday and Sunday */
$days5 = array(1, 2, 3, 5, 7);

/* Monday, Wednesday, Friday and Sunday */
$days6 = array(1, 3, 5, 7);

function displayDays($days = array()) {

    // 1: Create periods and group them in arrays with starting and ending days
    $periods = array();

    $periodIndex = 0;

    $previousDay = -1;
    $nextDay = -1;

    foreach($days as $placeInList => $currentDay) {     
        // If previous day and next day (in $days list) exist, get them.
        if ($placeInList > 0) {
            $previousDay = $days[$placeInList-1];
        }
        if ($placeInList < sizeof($days)-1) {
            $nextDay = $days[$placeInList+1];
        }

        if ($currentDay-1 != $previousDay) {
        // Doesn't follow directly (in week) previous day seen (in our list) = starting a new period
            $periodIndex++;
            $periods[$periodIndex] = array($currentDay);
        } elseif ($currentDay+1 != $nextDay) {
        // Follows directly previous day, and isn't followed directly (in week) by next day (in our list) = ending the period       
            $periods[$periodIndex][] = $currentDay;
            $periodIndex++;
        }
    }
    $periods = array_values($periods);


    // Arrived here, your days are grouped differently in bidimentional array.
    // print_r($periods); // If you want to see the new array's structure

    // 2: Display periods as we want.
    $text = '';
    foreach($periods as $key => $period) {
        if ($key > 0) {
        // Not first period
            if ($key < sizeof($periods)-1) {
            // Not last period either
                $text .= ', ';
            } else {
            // Last period
                $text .= ' and ';
            }
        }

        if (!empty($period[1])) {
        // Period has starting and ending days
            $text .= jddayofweek($period[0]-1, 1).' - '.jddayofweek($period[1]-1, 1);
        } else {
        // Period consists in only one day
            $text .= jddayofweek($period[0]-1, 1);
        }
    }

    echo $text.'<br />';
}

displayDays($days1);
displayDays($days2);
displayDays($days3);
displayDays($days4);
displayDays($days5);
displayDays($days6);
?>
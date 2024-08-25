<?php

if (!function_exists('generate_calendar')) {
    function generate_calendar($year, $month)
    {
        $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        // First day of the month and the number of days in the month
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numberDays = date('t', $firstDayOfMonth);

        // Get some information about the first day of the month
        $dateComponents = getdate($firstDayOfMonth);

        // What day of the week does the first day of the month fall on?
        $dayOfWeek = $dateComponents['wday'];

        // Create the table tag opener and day headers
        $calendar = "<table class='calendar'>";
        $calendar .= "<tr>";

        foreach ($daysOfWeek as $day) {
            $calendar .= "<th class='header'>$day</th>";
        }

        $calendar .= "</tr><tr>";

        // The variable $dayOfWeek will make sure that there must be only 7 columns on the calendar
        if ($dayOfWeek > 0) {
            $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
        }

        $currentDay = 1;

        // The rest of the days
        while ($currentDay <= $numberDays) {
            // If the seventh column (Saturday) is reached, start a new row
            if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }

            $calendar .= "<td class='day'>$currentDay</td>";

            // Increment counters
            $currentDay++;
            $dayOfWeek++;
        }

        // Complete the row of the last week in the month, if necessary
        if ($dayOfWeek != 7) {
            $remainingDays = 7 - $dayOfWeek;
            $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";
        }

        $calendar .= "</tr>";
        $calendar .= "</table>";

        return $calendar;
    }
}

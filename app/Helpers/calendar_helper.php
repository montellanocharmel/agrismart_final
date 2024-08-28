<?php

if (!function_exists('generate_calendar')) {
    function generate_calendar($year, $month)
    {
        $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numberDays = date('t', $firstDayOfMonth);

        $dateComponents = getdate($firstDayOfMonth);

        $dayOfWeek = $dateComponents['wday'];

        $calendar = "<table class='calendar'>";
        $calendar .= "<tr>";

        foreach ($daysOfWeek as $day) {
            $calendar .= "<th class='header'>$day</th>";
        }

        $calendar .= "</tr><tr>";

        if ($dayOfWeek > 0) {
            $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
        }

        $currentDay = 1;

        while ($currentDay <= $numberDays) {
            if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }

            $calendar .= "<td class='day'>$currentDay</td>";

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

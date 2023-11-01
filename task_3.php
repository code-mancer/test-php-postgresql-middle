<?php

function countTuesdaysBetweenDates($startDate, $endDate) {
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);

    $interval = new DateInterval('P1D'); // Интервал в один день

    $count = 0;

    while ($start <= $end) {
        if ($start->format('N') === '2') {
            $count++;
        }

        $start->add($interval);
    }

    return $count;
}

$startDate = '2023-01-01';
$endDate = '2023-12-31';

$count = countTuesdaysBetweenDates($startDate, $endDate);
echo "Количество вторников между $startDate и $endDate: $count\n";
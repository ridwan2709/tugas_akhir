<?php

function x_week_range($date) {
  $ts = strtotime($date);
  $start = (date('w', $ts) == 1) ? $ts : strtotime('last monday', $ts);
  return array(date('Y-m-d', $start), date('Y-m-d', strtotime('next sunday', $start)));
}

function to_abj($num) {
    $number = round($num);
    switch ($number) {
        case 4:
            return 'A';
        case 3:
            return 'B';
        case 2:
            return 'C';
        case 1:
            return 'D';
        default:
            if ($num > 0) return 'D';
            return '-';
            break;
    }
}

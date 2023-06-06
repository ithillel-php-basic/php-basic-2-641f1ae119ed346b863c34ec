<?php

function task_quantity($arr_tasks, $project)
{
    $num = 0;
    foreach ($arr_tasks as $item) {
        if ($item["project_name"] == $project) {
            $num++;
        }
    }
    return $num;
}

function task_time($date)
{
    $timestamp_date = strtotime($date);
    $date_now = time();
    $date_difference = $timestamp_date - $date_now;
    $date_difference = $date_difference / 3600;
    $date_difference = floor($date_difference);
    return $date_difference;
}

function task_time_output($date_difference)
{
    if ($date_difference < 0) {
        return;
    } else if ($date_difference <= 24) {
        if ($date_difference == 0) {
            return $date_difference . " годин";
        } else if ($date_difference == 1) {
            return $date_difference . " година";
        }
        return $date_difference . " години";
    } else {
        $date_difference = $date_difference / 24;
        $date_difference = floor($date_difference);
        if ($date_difference <= 4) {
            return $date_difference . " дня";
        }
        return $date_difference . " днів";
    }
}
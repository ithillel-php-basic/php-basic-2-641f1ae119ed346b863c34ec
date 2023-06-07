<?php

function dataOutputTask($query, $conn, $author_id, $project_id) {
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt == false) {
        die('Ошибка подготовки выражения: ' . mysqli_error($conn));
    }
    $stmt_bind_param = mysqli_stmt_bind_param($stmt, "ii", $author_id, $project_id);
    if ($stmt_bind_param == false) {
        die('Ошибка связывания параметров: ' . mysqli_stmt_error($conn));
    }
    $stmt_execute = mysqli_stmt_execute($stmt);
    if ($stmt_execute == false) {
        die('Ошибка выполнения запроса: ' . mysqli_stmt_error($conn));
    }
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
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
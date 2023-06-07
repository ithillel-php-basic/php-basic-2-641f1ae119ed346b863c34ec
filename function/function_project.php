<?php

function dataOutputProject($query, $conn, $author_id){
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt == false) {
        die('Ошибка подготовки выражения: ' . mysqli_error($conn));
    }
    $stmt_bind_param = mysqli_stmt_bind_param($stmt, "i", $author_id);
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


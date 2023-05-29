<?php
require_once "helpers.php";

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'hillel_db';

$conn = mysqli_connect($host, $user, $password, $dbname);
if($conn === false){
    die("FAIL TO CONNECT");
}

function dataOutput($query, $conn, $author_id){
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $author_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}

$author_id = 2;
$query_project = "SELECT name FROM project WHERE author_id = ?";
$query_tasks = "SELECT t.title, t.deadline, p.name AS project_name, t.status
                FROM task t
                JOIN project p ON t.project_id = p.id
                WHERE t.author_id = ?;";

$arr_project = dataOutput($query_project, $conn, $author_id);
$arr_project = array_column($arr_project, "name");
$arr_tasks = dataOutput($query_tasks, $conn, $author_id);

$title = "Завдання та проекти | Дошка";
$mainName = "Дмитрий";
$mainImagePath = "static/img/user2-160x160.jpg";

foreach ($arr_project as $project_items) {
    $safe_arr_project[] = htmlspecialchars($project_items);
}

unset ($project_items);

foreach ($arr_tasks as $task_name => $task_items) {
    foreach ($task_items as $item_name => $item_value){
        if ($item_value !== null){
            $safe_arr_tasks[$task_name][$item_name] = htmlspecialchars($item_value);
        }else {
            $safe_arr_tasks[$task_name][$item_name] = $item_value;
        }
    }
}

unset ($task_items);
unset ($task_name);
unset ($item_name);

function task_quantity($arr_tasks,$project){
    $num=0;
    foreach($arr_tasks as $item) {
        if($item["project_name"] == $project){
            $num++;
        }
    }
    return $num;
}

$content_kanban = renderTemplate("kanban.php",['arr_tasks' => $safe_arr_tasks]);
$content_main = renderTemplate("main.php",['content_kanban' => $content_kanban, 'mainName' => $mainName, 'mainImagePath' => $mainImagePath, 'arr_project' => $safe_arr_project, 'arr_tasks' => $safe_arr_tasks]);
$content_layout = renderTemplate("layout.php",['content_main' => $content_main, 'title' => $title]);

print($content_layout);

function task_time($date){
    $timestamp_date = strtotime($date);
    $date_now = time();
    $date_difference = $timestamp_date - $date_now;
    $date_difference = $date_difference / 3600;
    $date_difference = floor($date_difference);
    return $date_difference;
}

function task_time_output($date_difference){
    if($date_difference < 0){
        return;
    }else if($date_difference <= 24){
            if($date_difference == 0){
                return $date_difference." годин";
            }else if($date_difference == 1){
                return $date_difference." година";
            }
            return $date_difference ." години";
    }else{
        $date_difference = $date_difference / 24;
        $date_difference = floor($date_difference);
            if($date_difference <= 4) {
                return $date_difference ." дня";
            }
            return $date_difference ." днів";
    }
}


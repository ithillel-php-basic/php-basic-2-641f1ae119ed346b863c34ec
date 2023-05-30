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

$author_id = 2;
$query_project = "SELECT id, name FROM project WHERE author_id = ?";
$query_tasks = "SELECT title, deadline, project_id, status FROM task WHERE author_id = ?;";

$arr_project_primary = dataOutput($query_project, $conn, $author_id);
$arr_tasks_primary = dataOutput($query_tasks, $conn, $author_id);

foreach ($arr_tasks_primary as $task) {
    $projectId = $task['project_id'];
    $projectName = '';
    foreach ($arr_project_primary as $project) {
        if ($project['id'] == $projectId) {
            $projectName = $project['name'];
            break;
        }
    }

    $arr_tasks[] = [
        'title' => $task['title'],
        'deadline' => $task['deadline'],
        'project_name' => $projectName,
        'status' => $task['status'],
    ];
}

$arr_project = array_column($arr_project_primary, "name");


$title = "Завдання та проекти | Дошка";
$mainName = "Дмитрий";
$mainImagePath = "static/img/user2-160x160.jpg";


function task_quantity($arr_tasks,$project){
    $num=0;
    foreach($arr_tasks as $item) {
        if($item["project_name"] == $project){
            $num++;
        }
    }
    return $num;
}

$content_kanban = renderTemplate("kanban.php",['arr_tasks' => $arr_tasks]);
$content_main = renderTemplate("main.php",['content_kanban' => $content_kanban, 'mainName' => $mainName, 'mainImagePath' => $mainImagePath, 'arr_project' => $arr_project, 'arr_tasks' => $arr_tasks]);
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


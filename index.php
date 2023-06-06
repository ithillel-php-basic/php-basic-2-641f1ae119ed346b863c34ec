<?php
require_once "helpers.php";
require_once "database/database_connect.php";
require_once "function/function_task.php";

function dataOutput($query, $conn, $author_id, $project_id = '') {
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt == false) {
        die('Ошибка подготовки выражения: ' . mysqli_error($conn));
    }

    if ($project_id == '') {
        $stmt_bind_param = mysqli_stmt_bind_param($stmt, "i", $author_id);
        if ($stmt_bind_param == false) {
            die('Ошибка связывания параметров: ' . mysqli_stmt_error($conn));
        }
    } else {
        $stmt_bind_param = mysqli_stmt_bind_param($stmt, "ii", $author_id, $project_id);
        if ($stmt_bind_param == false) {
            die('Ошибка связывания параметров: ' . mysqli_stmt_error($conn));
        }
    }

    $stmt_execute = mysqli_stmt_execute($stmt);
    if ($stmt_execute == false) {
        die('Ошибка выполнения запроса: ' . mysqli_stmt_error($conn));
    }

    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($project_id != '' && $rows == null) {
        http_response_code(404);
        exit();
    }else {
        return $rows;
    }
}

$author_id = 1;
$status_project_button = 0;
$query_project = "SELECT id, name FROM project WHERE author_id = ?";
$query_tasks = "SELECT title, deadline, project_id, status FROM task WHERE author_id = ?";

$arr_project = dataOutput($query_project, $conn, $author_id);
$arr_tasks_primary = dataOutput($query_tasks, $conn, $author_id);

if (isset($_GET["project_id"])) {
    $query_tasks .= " AND project_id = ?";
    $project_id = $_GET["project_id"];
    $arr_tasks_primary = dataOutput($query_tasks, $conn, $author_id, $project_id);
    $status_project_button =  $project_id;
}

foreach ($arr_tasks_primary as $task) {
    $projectId = $task['project_id'];
    $projectName = '';
    foreach ($arr_project  as $project) {
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

$title = "Завдання та проекти | Дошка";
$mainName = "Дмитрий";
$mainImagePath = "static/img/user2-160x160.jpg";

$content_kanban = renderTemplate("kanban.php",['arr_tasks' => $arr_tasks]);
$content_main = renderTemplate("main.php",['content_kanban' => $content_kanban, 'mainName' => $mainName, 'mainImagePath' => $mainImagePath, 'arr_project' => $arr_project, 'arr_tasks' => $arr_tasks,'status_project_button' => $status_project_button]);
$content_layout = renderTemplate("layout.php",['content_main' => $content_main, 'title' => $title]);

print($content_layout);

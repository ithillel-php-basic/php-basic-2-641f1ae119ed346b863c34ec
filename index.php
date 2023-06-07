<?php
require_once "helpers.php";
require_once "database/database_connect.php";
require_once "function/function_task.php";
require_once "function/function_project.php";

function rowsNothing($rows)
{
    if ($rows == null) {
        http_response_code(404);
        exit();
    }
}

$author_id = 2;
$status_project_button = 0;
$query_project = "SELECT id, name FROM project WHERE author_id = ?";
$query_tasks = "SELECT title, deadline, project_id, status FROM task WHERE author_id = ? AND project_id = ?";
$query_task_count ="SELECT COUNT(*) AS task_count FROM task WHERE author_id = ? AND project_id = ?";

$arr_project = dataOutputProject($query_project, $conn, $author_id);
rowsNothing($arr_project);

$arr_tasks_primary = array();

foreach ($arr_project as $project) {
    foreach ($project as $key => $item) {
        if ($key == "id") {
            $project_id = $item;
            $new_tasks = dataOutputTask($query_tasks, $conn, $author_id, $project_id);
            rowsNothing($new_tasks);
            foreach ($new_tasks as $new_task) {
                $arr_tasks_primary[] = $new_task;
            }
        }
    }
}

if (isset($_GET["project_id"])) {
    $project_id = $_GET["project_id"];
    $arr_tasks_primary = dataOutputTask($query_tasks, $conn, $author_id, $project_id);
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
$content_main = renderTemplate("main.php",['content_kanban' => $content_kanban, 'mainName' => $mainName, 'mainImagePath' => $mainImagePath, 'arr_project' => $arr_project, 'arr_tasks' => $arr_tasks,'status_project_button' => $status_project_button, 'query_task_count' => $query_task_count, 'conn' => $conn, 'author_id' => $author_id]);
$content_layout = renderTemplate("layout.php",['content_main' => $content_main, 'title' => $title]);

print($content_layout);

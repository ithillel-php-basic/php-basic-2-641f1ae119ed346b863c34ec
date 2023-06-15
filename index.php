<?php
require_once "helpers.php";
require_once "database/database_connect.php";
require_once "function/function_task.php";
require_once "function/function_project.php";

$conn = databaseConnect();
function rowsEmpty($rows)
{
    if (empty($rows)) {
        http_response_code(404);
        exit();
    }
}

$author_id = 1;
$status_project_button = 0;

$arr_project = getProjects($conn, $author_id);
$arr_tasks_primary = getTasks($conn, $author_id);


if (isset($_GET["project_id"])) {
    $project_id = $_GET["project_id"];
    $arr_tasks_primary = getTasks($conn, $author_id, $project_id);
    rowsEmpty($arr_tasks_primary);
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
        'file' => $task['file'],
    ];
}

$title = "Завдання та проекти | Дошка";
$mainName = "Дмитрий";
$mainImagePath = "static/img/user2-160x160.jpg";

$content = renderTemplate("kanban.php",['arr_tasks' => $arr_tasks]);
$content_main = renderTemplate("main.php",['content' => $content, 'mainName' => $mainName, 'mainImagePath' => $mainImagePath, 'arr_project' => $arr_project, 'arr_tasks' => $arr_tasks, 'status_project_button' => $status_project_button]);
$content_layout = renderTemplate("layout.php",['content_main' => $content_main, 'title' => $title]);

print($content_layout);

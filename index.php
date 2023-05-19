<?php
require_once "helpers.php";

$arr_project=["Вхідні", "Навчання", "Робота", "Домашні справи", "Авто"];
$arr_tasks=[["task" =>"Співбесіда в IT компанії","date" =>"01.07.2023","type" =>"Робота","status" =>"backlog"],
    ["task" =>"Виконати тестове завдання","date" =>"25.07.2023","type" =>"Робота","status" =>"backlog"],
    ["task" =>"Зробити завдання до першого уроку","date" =>"27.04.2023","type" =>"Навчання","status" => "done"],
    ["task" =>"Зустрітись з друзями","date" =>"20.05.2023","type" => "Вхідні","status" => "to-do"],
    ["task" =>"Купити корм для кота","date" =>"null","type" => "Домашні справи","status" => "in-progress"],
    ["task" =>"Замовити піцу","date" =>"null","type" => "Домашні справи","status" =>"to-do"]];
$title = "Завдання та проекти | Дошка";
$mainName = "Дмитрий";
$mainImagePath = "static/img/user2-160x160.jpg";

foreach ($arr_project as $project_items) {
    $safe_arr_project[] = htmlspecialchars($project_items);
}

unset ($project_items);

foreach ($arr_tasks as $task_name => $task_items) {
    foreach ($task_items as $item_name => $item_value) {
        $safe_arr_tasks[$task_name][$item_name] = htmlspecialchars($item_value);
    }
}

unset ($task_items);
unset ($task_name);
unset ($item_name);

$i=0;
function task_quantity($arr_tasks,$safe_arr_project, $key){
    $num=0;
    foreach($arr_tasks as $item) {
        if($item["type"] == $safe_arr_project[$key]){
            $num++;
        }
    }
    return $num;
}

$content_kanban = renderTemplate("kanban.php",['arr_tasks' => $safe_arr_tasks]);
$content_main = renderTemplate("main.php",['content_kanban' => $content_kanban, 'mainName' => $mainName, 'mainImagePath' => $mainImagePath,'i' => $i, 'arr_project' => $safe_arr_project, 'arr_tasks' => $safe_arr_tasks]);
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
            }else {
                return $date_difference ." години";
            }
    }else{
        $date_difference = $date_difference / 24;
        $date_difference = floor($date_difference);
            if($date_difference <= 4) {
                return $date_difference ." дня";
            }else{
                return $date_difference ." днів";
            }
    }
}


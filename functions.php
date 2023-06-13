<?php

require "db.php";

function createTodo($req) {
    global $con;
    $todo = mysqli_real_escape_string($con, $req["todo"]);
    $todo_time = mysqli_real_escape_string($con, $req["todo_time"]);

    echo "$todo\n$todo_time";

    $query = "INSERT INTO `todo` (`todo`, `todo_time`) VALUES ('$todo', '$todo_time')";
    $executed = mysqli_query($con, $query);

    if ($executed) {
        header("location: todo.php");
    }

    print_r($req);
}

function getTodo() {
    global $con;
    $query = "SELECT * FROM `todo`";
    $executed = mysqli_query($con, $query);
    return $executed;
}

function changeStatus($id, $status) {
    global $con;
    if ($status === "undone") {
        $query = "UPDATE `todo` SET `status` = 0 WHERE `id` = $id";
        $executed = mysqli_query($con, $query);

        if ($executed) {
            header("location: todo.php");
        }
    }

    if ($status === "done") {
        $query  = "UPDATE `todo` SET `status` = 1 WHERE `id` = $id";
        $executed = mysqli_query($con, $query);
        if ($executed) {
            header('location: todo.php');
        }
    }
}

function deleteTodo($id) {
    global $con;
    $query = "DELETE FROM `todo` WHERE `id` = '$id'";
    $executed = mysqli_query($con, $query);

    if ($executed) {
        header("location: todo.php");
    }
}

function getSingleTodo($id){
    global $con;
    $query = "SELECT * FROM `todo` WHERE `id` = '$id'";
    $execute_query = mysqli_query($con, $query);
    $get_todo = mysqli_fetch_assoc($execute_query);
    return $get_todo;
}
function updateTodo($request){
    global $con;
    $id = mysqli_real_escape_string($con,$request['id']);
    $todo = mysqli_real_escape_string($con,$request['todo']);
    $todo_time = mysqli_real_escape_string($con,$request['todo_time']);

    $query = "UPDATE `todo` SET `todo` = '$todo', `todo_time` = '$todo_time' WHERE `id` = '$id'";
    $execute_query = mysqli_query($con, $query);
    if($execute_query){
        header('location: todo.php');
    }
}


?>
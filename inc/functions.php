<?php
require("connection.php");
session_start();
ini_set('display_errors', 1);

function getAlldepartements()
{
    $sql = "SELECT * FROM departments";
    $news_req = mysqli_query(dbconnect(), $sql);
    $departments = array();
    while ($result = mysqli_fetch_assoc($news_req)) {
        $departments[] = $result;
    }
    mysqli_free_result($news_req);
    return $departments;
}

function getAllManagersNow($dept_no)
{
    $sql = "SELECT * FROM dept_manager JOIN employees ON dept_manager.emp_no = employees.emp_no WHERE dept_no='$dept_no' AND from_date <= NOW() AND to_date >= NOW()";
    $news_req = mysqli_query(dbconnect(), $sql);
    $managers = array();
    while ($result = mysqli_fetch_assoc($news_req)) {
        $managers[] = $result;
    }
    mysqli_free_result($news_req);
    return $managers;
}

function getAllEmployees($dept_no)
{
    $sql = "SELECT * FROM current_dept_emp_full WHERE dept_no='$dept_no'";
    $news_req = mysqli_query(dbconnect(), $sql);
    $employees = array();
    while ($result = mysqli_fetch_assoc($news_req)) {
        $employees[] = $result;
    }
    mysqli_free_result($news_req);
    return $employees;
}

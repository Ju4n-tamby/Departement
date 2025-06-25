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
    $sql = "SELECT c.*, e.first_name, e.last_name, e.gender, e.birth_date FROM current_dept_emp c JOIN employees e ON e.emp_no=c.emp_no WHERE dept_no='$dept_no' LIMIT 20";
    $news_req = mysqli_query(dbconnect(), $sql);
    $employees = array();
    while ($result = mysqli_fetch_assoc($news_req)) {
        $employees[] = $result;
    }
    mysqli_free_result($news_req);
    return $employees;
}

function getDepartement($dept_no)
{
    $sql = "SELECT * FROM departments WHERE dept_no='$dept_no'";
    $news_req = mysqli_query(dbconnect(), $sql);
    $department = null;
    if ($result = mysqli_fetch_assoc($news_req)) {
        $department = $result;
    }
    mysqli_free_result($news_req);
    return $department;
}

function getEmployee($emp_no)
{
    $sql = "SELECT c.*, e.first_name, e.last_name, e.gender, e.birth_date, e.hire_date, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age FROM current_dept_emp c JOIN employees e ON e.emp_no=c.emp_no WHERE e.emp_no='$emp_no'";
    $news_req = mysqli_query(dbconnect(), $sql);
    $employee = null;
    if ($result = mysqli_fetch_assoc($news_req)) {
        $employee = $result;
    }
    mysqli_free_result($news_req);
    return $employee;
}

function getJob($emp_no)
{
    $sql = "SELECT title FROM titles WHERE emp_no='$emp_no'";
    $news_req = mysqli_query(dbconnect(), $sql);
    $job = null;
    if ($result = mysqli_fetch_assoc($news_req)) {
        $job = $result['title'];
    }
    mysqli_free_result($news_req);
    return $job;
}

function getSalaires($emp_no)
{
    $sql = "SELECT salary, from_date, to_date FROM salaries WHERE emp_no='$emp_no' GROUP BY from_date";
    $news_req = mysqli_query(dbconnect(), $sql);
    $salaires = array();
    while ($result = mysqli_fetch_assoc($news_req)) {
        $salaires[] = $result;
    }
    mysqli_free_result($news_req);
    return $salaires;
}

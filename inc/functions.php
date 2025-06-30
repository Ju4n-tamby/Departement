<?php
require("connection.php");
session_start();
ini_set('display_errors', 1);

function getAlldepartements()
{
  $sql = "SELECT * FROM departments ORDER BY dept_name ASC";
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

function getAllEmployees($dept_no, $page)
{
  $debut = ($page - 1) * 20;

  $sql = "SELECT c.*, e.first_name, e.last_name, e.gender, e.birth_date FROM current_dept_emp c JOIN employees e ON e.emp_no=c.emp_no WHERE dept_no='$dept_no' ORDER BY e.first_name LIMIT $debut, 20";
  $news_req = mysqli_query(dbconnect(), $sql);
  $employees = array();
  while ($result = mysqli_fetch_assoc($news_req)) {
    $employees[] = $result;
  }
  mysqli_free_result($news_req);
  return $employees;
}

function countEmployees($dept_no)
{
  $sql = "SELECT COUNT(*) as count FROM current_dept_emp c JOIN employees e ON e.emp_no=c.emp_no WHERE dept_no='$dept_no'";
  $news_req = mysqli_query(dbconnect(), $sql);
  $count = 0;
  if ($result = mysqli_fetch_assoc($news_req)) {
    $count = $result['count'];
  }
  mysqli_free_result($news_req);
  return $count;
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
  $sql = "SELECT c.*, e.first_name, e.last_name, e.gender, e.birth_date, e.hire_date, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age FROM current_dept_emp c JOIN employees e ON e.emp_no=c.emp_no WHERE e.emp_no='$emp_no' LIMIT 1";
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
  $sql = "SELECT title, from_date, to_date FROM titles WHERE emp_no='$emp_no' ORDER BY from_date";
  $news_req = mysqli_query(dbconnect(), $sql);
  $jobs = [];
  while ($result = mysqli_fetch_assoc($news_req)) {
    $jobs[] = $result;
  }
  mysqli_free_result($news_req);
  return $jobs;
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

function countSearched($dept_no, $nom, $age_min, $age_max)
{
  $conditions = [];
  $db = dbconnect();

  if ($dept_no !== '') {
    $dept_no = mysqli_real_escape_string($db, $dept_no);
    $conditions[] = "c.dept_no = '$dept_no'";
  }

  if ($nom !== '') {
    $nom = mysqli_real_escape_string($db, $nom);
    $conditions[] = "(e.first_name LIKE '%$nom%' OR e.last_name LIKE '%$nom%')";
  }

  if ($age_min !== null) {
    $age_min = (int)$age_min;
    $conditions[] = "TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) >= $age_min";
  }

  if ($age_max !== null) {
    $age_max = (int)$age_max;
    $conditions[] = "TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) <= $age_max";
  }

  $where = '';
  if (!empty($conditions)) {
    $where = 'WHERE ' . implode(' AND ', $conditions);
  }

  $sql = "SELECT COUNT(DISTINCT e.emp_no) AS total
            FROM current_dept_emp c
            JOIN employees e ON e.emp_no = c.emp_no
            $where";

  $result = mysqli_query($db, $sql);
  $count = 0;

  if ($row = mysqli_fetch_assoc($result)) {
    $count = (int)$row['total'];
  }

  mysqli_free_result($result);
  return $count;
}

function getAllEmployeesBySearch($dept_no, $nom, $age_min, $age_max, $page)
{
  $db = dbconnect();
  $conditions = [];
  $debut = ($page - 1) * 20;

  if ($dept_no !== '') {
    $dept_no = mysqli_real_escape_string($db, $dept_no);
    $conditions[] = "c.dept_no = '$dept_no'";
  }

  if ($nom !== '') {
    $nom = mysqli_real_escape_string($db, $nom);
    $conditions[] = "(e.first_name LIKE '%$nom%' OR e.last_name LIKE '%$nom%')";
  }

  if ($age_min !== null) {
    $age_min = (int)$age_min;
    $conditions[] = "TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) >= $age_min";
  }

  if ($age_max !== null) {
    $age_max = (int)$age_max;
    $conditions[] = "TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) <= $age_max";
  }

  $where = '';
  if (!empty($conditions)) {
    $where = 'WHERE ' . implode(' AND ', $conditions);
  }

  $sql = "SELECT e.emp_no, e.first_name, e.last_name, e.gender, c.dept_no, d.dept_name,
                   TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) AS age
            FROM current_dept_emp c
            JOIN employees e ON e.emp_no = c.emp_no
            JOIN departments d ON c.dept_no = d.dept_no
            $where
            ORDER BY e.first_name ASC
            LIMIT $debut, 20";

  $result = mysqli_query($db, $sql);
  $employees = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row;
  }

  mysqli_free_result($result);
  return $employees;
}

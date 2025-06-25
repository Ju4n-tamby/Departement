<?php 
require_once('../inc/functions.php');

$dept_no = $_GET['dept_no'] ?? '';
$nom = trim($_GET['nom'] ?? '');
$age_min = $_GET['age_min'] ?? null;
$age_max = $_GET['age_max'] ?? null;

$criteres = [];
$page = isset($_GET['page']) ? $_GET['page'] : 1;

if ($dept_no !== '') $criteres['dept_no'] = $dept_no;
if ($nom !== '') $criteres['nom'] = $nom;
if ($age_min !== '') $criteres['age_min'] = $age_min;
if ($age_max !== '') $criteres['age_max'] = $age_max;
$criteres['page'] = $page;

header('Location: ../pages/recherche.php?' . http_build_query($criteres));
exit;
?>

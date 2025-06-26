<?php
require('../inc/functions.php');
$emp_no = $_GET['emp_no'] ?? null;
$employee = getEmployee($emp_no);
$departement = getDepartement($employee['dept_no']);
$salaires = getSalaires($emp_no);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Fiche employé · <?= htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css" />
</head>

<body class="bg-light">

  <header class="bg-danger border-bottom shadow-lg py-4 mb-4">
    <div class="container text-center">
      <h1 class="display-6 fw-semibold mb-0">
        <i class="bi bi-person-circle text-light me-2"></i> Employé N°<?= $employee['emp_no'] ?>
      </h1>
    </div>
  </header>

  <main class="container">

    <nav class="mb-4">
      <a href="listeemployees.php?dept_no=<?= $employee['dept_no'] ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Retour
      </a>
    </nav>

    <section class="card shadow-sm border-0 p-4 mb-5">
      <article class="row align-items-center">
        <figure class="col-md-4 text-center mb-4 mb-md-0">
          <img src="../assets/bootstrap-icons/icons/person-circle.svg" alt="Avatar" class="w-100 rounded-circle border border-3 border-secondary" style="max-width: 180px;">
        </figure>
        <figcaption class="col-md-8">
          <div class="mb-3">
            <span class="fw-bold text-success">Nom :</span>
            <span class="ms-2"><?= htmlspecialchars($employee['first_name']) ?></span>
          </div>
          <div class="mb-3">
            <span class="fw-bold text-success">Prénom :</span>
            <span class="ms-2"><?= htmlspecialchars($employee['last_name']) ?></span>
          </div>
          <div class="mb-3">
            <span class="fw-bold text-success">Genre :</span>
            <span class="ms-2">
              <?= match ($employee['gender']) {
                'M' => '<i class="bi bi-gender-male text-primary"></i> Homme',
                'F' => '<i class="bi bi-gender-female text-danger"></i> Femme',
                default => '<i class="bi bi-gender-ambiguous text-muted"></i> Autre',
              }; ?>
            </span>
          </div>
          <div class="mb-3">
            <span class="fw-bold text-success">Âge :</span>
            <span class="ms-2 text-muted"><?= $employee['age'] ?> ans</span>
          </div>
          <div class="mb-3">
            <span class="fw-bold text-success">Département :</span>
            <a href="listeemployees.php?dept_no=<?= $employee['dept_no'] ?>" class="ms-2 text-decoration-none">
              <i class="bi bi-building me-1"></i><?= htmlspecialchars($departement['dept_name']) ?>
            </a>
          </div>
        </figcaption>
      </article>

      <hr class="my-5" />

      <article class="row gy-4">
        <section class="col-lg-6">
          <h2 class="text-center text-secondary fw-bold mb-4">Informations supplémentaires</h2>
          <div class="mb-3">
            <span class="fw-bold">Date de naissance :</span>
            <span class="ms-2"><?= $employee['birth_date'] ?></span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Date d'embauche :</span>
            <span class="ms-2 text-muted">
              <i class="bi bi-calendar-event me-1"></i><?= date('d/m/Y', strtotime($employee['hire_date'])) ?>
            </span>
          </div>
          <div class="mb-3">
            <span class="fw-bold">Emploi :</span>
            <span class="ms-2"><?= getJob($emp_no) ?></span>
          </div>
        </section>

        <section class="col-lg-6">
          <div class="bg-dark text-white rounded p-3">
            <h2 class="text-center text-danger fw-bold mb-4">Historique des salaires</h2>
            <?php
            $count = count($salaires);
            for ($i = 0; $i < $count; $i++) {
              $actuel = $salaires[$i]['salary'];
              $periode = $salaires[$i]['from_date'] . ' – ' . $salaires[$i]['to_date'];
              $classe = 'text-success';
              $variation = '';

              if ($i > 0) {
                $prev = $salaires[$i - 1]['salary'];
                if ($actuel > $prev) {
                  $variation = '<i class="bi bi-arrow-up-circle-fill text-success ms-2" title="Augmentation"></i>';
                  $classe = 'text-success fw-semibold';
                } elseif ($actuel < $prev) {
                  $variation = '<i class="bi bi-arrow-down-circle-fill text-danger ms-2" title="Diminution"></i>';
                  $classe = 'text-danger fw-semibold';
                } else {
                  $variation = '<i class="bi bi-dash-circle-fill text-muted ms-2" title="Stable"></i>';
                  $classe = 'text-muted';
                }
              }
            ?>
              <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                <span class="<?= $classe ?>">
                  <?= number_format($actuel, 0, ',', ' ') ?> <?= $variation ?>
                </span>
                <span class="text-light small fst-italic"><?= $periode ?></span>
              </div>
            <?php } ?>
          </div>
        </section>
      </article>
    </section>
  </main>

</body>

</html>

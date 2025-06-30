<?php
require('../inc/functions.php');
$dept_no = $_GET['dept_no'] ?? null;
$departement = getDepartement($dept_no);

if (!$departement) {
  header('Location: accueil.php');
  exit;
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$employees = getAllEmployees($dept_no, $page);
$totalEmployees = countEmployees($dept_no);
$nbPages = $totalEmployees / 20;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Employés du département</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css" />
</head>

<body class="bg-light">

  <header class="bg-danger border-bottom shadow-lg py-4 mb-4">
    <nav class="container text-center">
      <div class="container text-center">
        <nav class="display-6 fw-semibold mb-0">
          <i class="bi bi-people-fill text-light me-2"></i>
          Employés - <?= htmlspecialchars($departement['dept_name']) ?>
        </nav>
      </div>

      <nav class="mt-3">
        <a href="recherche.php?dept_no=<?= urlencode($dept_no) ?>" class="btn btn-outline-dark">
          <i class="bi bi-search me-1"></i> Rechercher un employé
        </a>
      </nav>
    </nav>
  </header>

  <main class="container">

    <article class="mb-3">
      <a href="accueil.php" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Retour aux départements
      </a>
    </article>

    <section class="card shadow-sm">
      <nav class="card-body">

        <article class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-danger text-center">
              <tr>
                <th><i class="bi bi-hash"></i> Numéro</th>
                <th><i class="bi bi-person"></i> Nom & Prénom</th>
                <th><i class="bi bi-gender-ambiguous"></i> Genre</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($employees)) : ?>
                <?php foreach ($employees as $employee) : ?>
                  <tr>
                    <td class="text-center">
                      <a href="fiche.php?emp_no=<?= $employee['emp_no'] ?>" class="text-decoration-none text-dark">
                        <?= htmlspecialchars($employee['emp_no']) ?>
                      </a>
                    </td>

                    <td>
                      <a href="fiche.php?emp_no=<?= $employee['emp_no'] ?>" class="text-decoration-none text-dark d-flex align-items-center">
                        <i class="bi bi-person-circle text-secondary me-2"></i>
                        <?= htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']) ?>
                      </a>
                    </td>

                    <td class="text-center">
                      <a href="fiche.php?emp_no=<?= $employee['emp_no'] ?>" class="text-decoration-none">
                        <?php
                        if ($employee['gender'] == 'M') {
                          echo '<i class="bi bi-gender-male text-primary fs-5" title="Homme"></i>';
                        } else {
                          echo '<i class="bi bi-gender-female text-danger fs-5" title="Femme"></i>';
                        }
                        ?>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="3" class="text-center text-muted fst-italic">
                    Aucun employé trouvé dans ce département.
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </article>

      </nav>
    </section>

    <nav class="container mt-4 d-flex justify-content-evenly">
      <a
        href="listeemployees.php?dept_no=<?= urlencode($dept_no) ?>&page=<?= max(1, $page - 1) ?>"
        class="btn btn-outline-secondary <?= $page <= 1 ? 'disabled' : '' ?>">
        <i class="bi bi-arrow-left me-1"></i> Précédent
      </a>

      <span>Page <?= $page ?></span>

      <a
        href="listeemployees.php?dept_no=<?= urlencode($dept_no) ?>&page=<?= max(1, $page + 1) ?>"
        class="btn btn-outline-danger <?= $page >= $nbPages ? 'disabled' : '' ?>">
        Suivant <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </nav>
  </main>

  <!-- Pied de page -->
  <footer class="text-center text-muted py-4 small mt-5">
    &copy; <?= date('Y') ?> · Tous droits réservés
  </footer>

</body>

</html>

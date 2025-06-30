<?php
require('../inc/functions.php');

$departements = getAllDepartements();

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$employes = [];
$dept_no = $_GET['dept_no'] ?? '';
$nom = $_GET['nom'] ?? '';
$age_min = $_GET['age_min'] ?? null;
$age_max = $_GET['age_max'] ?? null;

if ($dept_no != '' || $nom != '' || $age_min != null || $age_max != null) {
  $employes = getAllEmployeesBySearch($dept_no, $nom, $age_min, $age_max, $page);
}
$count = countSearched($dept_no, $nom, $age_min, $age_max);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Recherche · Employés</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css" />
</head>

<body class="bg-light">

  <header class="bg-danger shadow-lg border-bottom py-4 mb-4">
    <div class="container text-center">
      <h1 class="display-6 fw-semibold">
        <i class="bi bi-search me-2 text-light"></i>Recherche d'employés
      </h1>
      <p class="text-muted">Affinez votre recherche par nom, département ou âge</p>
    </div>
  </header>

  <main class="container">

    <article class="mb-3">
      <a href="accueil.php" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Retour aux départements
      </a>
    </article>

    <form action="../traitement/search-traitement.php" method="GET" class="card p-4 shadow-sm mb-5">
      <div class="row g-3">
        <div class="col-md-4">
          <label for="dept_no" class="form-label">Département</label>
          <select name="dept_no" id="dept_no" class="form-select">
            <option value="">-- Tous les départements --</option>
            <?php foreach ($departements as $dept): ?>
              <option value="<?= $dept['dept_no'] ?>" <?= $dept['dept_no'] == $dept_no ? 'selected' : '' ?>>
                <?= htmlspecialchars($dept['dept_name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-4">
          <label for="nom" class="form-label">Nom ou prénom</label>
          <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom ou prénom" value="<?= htmlspecialchars($nom) ?>">
        </div>

        <div class="col-md-2">
          <label for="age_min" class="form-label">Âge min</label>
          <input type="number" name="age_min" id="age_min" class="form-control" value="<?= htmlspecialchars($age_min) ?>" min="0">
        </div>

        <div class="col-md-2">
          <label for="age_max" class="form-label">Âge max</label>
          <input type="number" name="age_max" id="age_max" class="form-control" value="<?= htmlspecialchars($age_max) ?>" min="0">
        </div>
      </div>

      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-danger">
          <i class="bi bi-search me-1"></i> Rechercher
        </button>
      </div>
    </form>

    <section class="card shadow-sm p-4">
      <h2 class="h5 mb-4 text-secondary">Résultats : <?= $count ?> employé(s) trouvé(s)</h2>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-danger text-center">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom & prénom</th>
              <th scope="col">Genre</th>
              <th scope="col">Âge</th>
              <th scope="col">Département</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($employes as $emp): ?>
              <tr>
                <td class="text-center fw-bold"><a href="fiche.php?emp_no=<?= $emp['emp_no'] ?>" class="text-decoration-none text-dark"><?= $emp['emp_no'] ?></a></td>
                <td>
                  <a href="fiche.php?emp_no=<?= $emp['emp_no'] ?>" class="text-decoration-none text-dark">
                    <i class="bi bi-person me-1 text-secondary"></i>
                    <?= htmlspecialchars($emp['first_name'] . ' ' . $emp['last_name']) ?>
                  </a>
                </td>
                <td class="text-center"><a href="fiche.php?emp_no=<?= $emp['emp_no'] ?>" class="text-decoration-none text-dark">
                    <?php
                    if ($employee['gender'] == 'M') {
                      echo '<i class="bi bi-gender-male text-primary fs-5" title="Homme"></i>';
                    } else {
                      echo '<i class="bi bi-gender-female text-danger fs-5" title="Femme"></i>';
                    }
                    ?></a>
                </td>
                <td class="text-center"><a href="fiche.php?emp_no=<?= $emp['emp_no'] ?>" class="text-decoration-none text-dark"><?= $emp['age'] ?> ans</a></td>
                <td class="text-center">
                  <a href="fiche.php?emp_no=<?= $emp['emp_no'] ?>" class="text-decoration-none text-dark">
                    <?= htmlspecialchars($emp['dept_name'] ?? '-') ?></a>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if (empty($employes)): ?>
              <tr>
                <td colspan="5" class="text-center text-muted fst-italic">Aucun employé ne correspond à ces critères.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>

    <nav class="container mt-4 d-flex justify-content-evenly">
      <a
        href="../traitement/search-traitement.php?dept_no=<?= urlencode($dept_no) ?>&nom=<?= urlencode($nom) ?>&age_min=<?= $age_min ?>&age_max=<?= $age_max ?>&page=<?= max(1, $page - 1) ?>"
        class="btn btn-outline-secondary <?= $page <= 1 ? 'disabled' : '' ?>">
        <i class="bi bi-arrow-left me-1"></i> Précédent
      </a>

      <span>Page <?= $page ?></span>

      <a
        href="../traitement/search-traitement.php?dept_no=<?= urlencode($dept_no) ?>&nom=<?= urlencode($nom) ?>&age_min=<?= $age_min ?>&age_max=<?= $age_max ?>&page=<?= max(1, $page + 1) ?>"
        class="btn btn-outline-danger <?= $page * 20 >= $count ? 'disabled' : '' ?>">
        Suivant <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </nav>
  </main>

</body>

</html>

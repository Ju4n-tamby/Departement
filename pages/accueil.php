<?php
require('../inc/functions.php');
$departements = getAlldepartements();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Départements · Annuaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css" />
</head>

<body class="bg-light">
    <header class="py-4 bg-white shadow-sm border-bottom mb-4">
        <nav class="container text-center">
            <h1 class="display-6 fw-semibold">
                <i class="bi bi-diagram-3 me-2 text-danger"></i>Départements
            </h1>
            <p class="text-muted">Consultez la liste des départements et leurs managers actuels</p>
        </nav>
    </header>

    <main class="container">
        <section class="card shadow-sm border-0">
            <nav class="card-body p-4">
                <article class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-danger text-center">
                            <tr>
                                <th scope="col"><i class="bi bi-hash"></i> Numéro</th>
                                <th scope="col"><i class="bi bi-building"></i> Nom</th>
                                <th scope="col"><i class="bi bi-person-badge"></i> Managers</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departements as $depart) { ?>
                                <tr>
                                    <td class="fw-bold text-center">
                                        <a href="listeemployees.php?dept_no=<?= $depart['dept_no'] ?>" class="text-decoration-none text-dark">
                                            <?= htmlspecialchars($depart['dept_no']) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="listeemployees.php?dept_no=<?= $depart['dept_no'] ?>" class="d-flex align-items-center text-decoration-none text-dark">
                                            <i class="bi bi-buildings text-danger me-2"></i>
                                            <?= htmlspecialchars($depart['dept_name']) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="listeemployees.php?dept_no=<?= $depart['dept_no'] ?>" class="text-decoration-none text-dark">
                                            <ul class="list-unstyled mb-0">
                                                <?php
                                                $managers = getAllManagersNow($depart['dept_no']);
                                                if (empty($managers)) {
                                                    echo '<li><span class="text-muted fst-italic">Aucun manager</span></li>';
                                                } else {
                                                    foreach ($managers as $manager) {
                                                        echo '<li><span class="badge bg-dark rounded-pill p-2">' .
                                                            htmlspecialchars($manager['first_name'] . ' ' . $manager['last_name']) .
                                                            '</span></li>';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </article>
            </nav>
        </section>
    </main>

    <footer class="text-center text-muted py-4 small mt-5">
        &copy; <?= date('Y') ?> · Université / Entreprise - Tous droits réservés
    </footer>
</body>

</html>
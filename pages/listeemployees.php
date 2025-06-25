<?php
require('../inc/functions.php');
$dept_no = $_GET['dept_no'] ?? null;
$departement = getDepartement($dept_no);
$employees = getAllEmployees($dept_no);
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

    <header class="bg-white border-bottom shadow-sm py-4 mb-4">
        <div class="container text-center">
            <nav class="display-6 fw-semibold mb-0">
                <i class="bi bi-people-fill text-danger me-2"></i>
                Employés - <?= htmlspecialchars($departement['dept_name']) ?>
            </nav>
        </div>
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
                                                echo match ($employee['gender']) {
                                                    'M' => '<i class="bi bi-gender-male text-primary fs-5" title="Homme"></i>',
                                                    'F' => '<i class="bi bi-gender-female text-danger fs-5" title="Femme"></i>',
                                                    default => '<i class="bi bi-gender-ambiguous text-secondary fs-5" title="Autre"></i>',
                                                };
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
    </main>

    <!-- Pied de page -->
    <footer class="text-center text-muted py-4 small mt-5">
        &copy; <?= date('Y') ?> · Tous droits réservés
    </footer>

</body>

</html>
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
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
        }

        .badge-manager {
            font-size: 0.85rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f2f4f6;
        }

        td>a {
            display: block;
            color: inherit;
            text-decoration: none;
            padding: 0.75rem 1rem;
            width: 100%;
        }
    </style>
</head>

<body>
    <header class="bg-light border-bottom py-4 mb-5 shadow-sm">
        <div class="container text-center">
            <h1 class="display-5 fw-semibold mb-0">
                <i class="bi bi-diagram-3 me-2 text-secondary"></i>
                Employés du département : <?= htmlspecialchars($departement['dept_name']) ?>
            </h1>
        </div>
    </header>

    <main class="container">
        <article class="mb-4">
            <a href="accueil.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Retour à la liste des départements
            </a>
        </article>

        <section class="card shadow-sm p-4">
            <article class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th scope="col"><i class="bi bi-hash"></i> Numéro</th>
                            <th scope="col"><i class="bi bi-person"></i> Nom & Prénom</th>
                            <th scope="col"><i class="bi bi-gender-ambiguous"></i> Genre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee) { ?>
                            <tr class="text-start">
                                <td class="fw-bold text-center">
                                    <a href="fiche.php?emp_no=<?= $employee['emp_no'] ?>"><?= htmlspecialchars($employee['emp_no']) ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="fiche.php?emp_no=<?= $employee['emp_no'] ?>">
                                        <i class="bi bi-person text-secondary me-2"></i>
                                        <?= htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']) ?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="fiche.php?emp_no=<?= $employee['emp_no'] ?>">
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
                        <?php } ?>
                        <?php if (empty($employees)) { ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted fst-italic">Aucun employé trouvé.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </article>
        </section>
    </main>
</body>

</html>
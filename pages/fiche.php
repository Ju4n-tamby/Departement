<?php
require('../inc/functions.php');
$emp_no = $_GET['emp_no'] ?? null;
$employee = getEmployee($emp_no);
$departement = getDepartement($employee['dept_no']);
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
    <style>
        body {
            background-color: #f8f9fa;
        }

        .avatar {
            width: 100%;
            max-width: 180px;
            border-radius: 50%;
            border: 4px solid #dee2e6;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .info-label {
            font-weight: 600;
            color: #198754;
        }

        .info-value {
            font-size: 1.25rem;
        }
    </style>
</head>

<body>
    <header class="bg-light border-bottom py-4 mb-5 shadow-sm">
        <div class="container text-center">
            <h1 class="display-6 fw-semibold mb-0">
                <i class="bi bi-person text-secondary me-2"></i> Fiche de l'employé N° <?= $employee['emp_no'] ?>
            </h1>
        </div>
    </header>

    <main class="container">
        <nav class="mb-4">
            <a href="listeemployees.php?dept_no=<?= $employee['dept_no'] ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Retour à la liste des employés
            </a>
        </nav>

        <section class="card shadow-sm border-0 p-4">
            <article class="row align-items-center">
                <figure class="col-md-4 text-center mb-3 mb-md-0">
                    <img src="../assets/bootstrap-icons/icons/person-circle.svg" alt="Avatar" class="avatar">
                </figure>
                <figcaption class="col-md-8">
                    <nav class="mb-3">
                        <span class="info-label">Nom :&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value ms-2"><?= htmlspecialchars($employee['first_name']) ?></span>
                    </nav>
                    <nav class="mb-3">
                        <span class="info-label">Prénom :&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value ms-2"><?= htmlspecialchars($employee['last_name']) ?></span>
                    </nav>
                    <nav class="mb-3">
                        <span class="info-label">Genre :&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <span class="info-value ms-2">
                            <?php
                            echo match ($employee['gender']) {
                                'M' => '<i class="bi bi-gender-male text-primary" title="Homme"></i> Homme',
                                'F' => '<i class="bi bi-gender-female text-danger" title="Femme"></i> Femme',
                                default => '<i class="bi bi-gender-ambiguous text-secondary" title="Autre"></i> Autre',
                            };
                            ?>
                        </span>
                    </nav>
                    <nav class="mb-3">
                        <span class="info-label">Département :</span>
                        <span class="info-value ms-2">
                            <a href="listeemployees.php?dept_no=<?= $employee['dept_no'] ?>" class="text-decoration-none">
                                <i class="bi bi-building me-1"></i> <?= htmlspecialchars($departement['dept_name']) ?>
                            </a>
                        </span>
                    </nav>
                    <nav class="mb-3">
                        <span class="info-label">Date d'embauche :</span>
                        <span class="info-value ms-2 text-muted">
                            <i class="bi bi-calendar-event me-1"></i>
                            <?= date('d/m/Y', strtotime($employee['hire_date'])) ?>
                        </span>
                    </nav>
                </figcaption>
            </article>
            <hr>
            <article class="container-fluid p-5 d-flex flex-wrap justify-content-between">
                <nav class="col-lg-6 col-xs-12 mb-3 px-3 border">
                    <h2 class="text-center text-secondary fw-bold my-3">Informations suplementaires :</h2>
                    <span class="info-label">Date de naissance :</span>
                    <span class="info-value"><?= $employee['birth_date'] ?></span>
                </nav>

                <nav class="col-lg-6 col-xs-12 mb-3 border">

                </nav>
            </article>
        </section>
    </main>
</body>

</html>
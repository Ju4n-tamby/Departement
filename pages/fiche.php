<?php
require('../inc/functions.php');
$emp_no = $_GET['emp_no'] ?? null;
$employee = getEmployee($emp_no);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Fiche - Employée</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css" />
</head>

<body>
    <header class="bg-light border-bottom py-4 mb-5 shadow-sm">
        <div class="container text-center">
            <h1 class="display-5 fw-semibold mb-0">
                <i class="bi bi-person text-secondary me-2"></i></i>Fiche N° <?= $employee['emp_no'] ?>
            </h1>
        </div>
    </header>

    <main class="container">
        <article class="mb-4">
            <a href="listeemployees.php?dept_no=<?= $employee['dept_no'] ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Retour à la liste des employées
            </a>
        </article>

        <section class="container-fluid rounded border border-1 shadow-lg border-success p-5">
            <nav class="container-fluid border-bottom border-dark p-2 row d-flex flex-wrap justify-content-around">
                <figure class="p-auto col-3">
                    <img src="../assets/bootstrap-icons/icons/person-circle.svg" class="lien w-75 mx-auto d-block" alt="">
                </figure>

                <figcaption class="col-7 p-5">
                    <p class="text-dark fw-light fs-4"><span class="fs-2 fw-bold text-success text-decoration-underline">Nom </span> : <?= $employee['first_name'] ?></p>
                    <p class="text-dark fw-light fs-4"><span class="fs-2 fw-bold text-success text-decoration-underline">Prenom </span> : <?= $employee['last_name'] ?></p>
                    <p class="text-dark fw-light fs-4"><span class="fs-2 fw-bold text-success text-decoration-underline">Genre </span> : <?php
                                                                                                                                            echo match ($employee['gender']) {
                                                                                                                                                'M' => '<i class="bi bi-gender-male text-primary fs-5" title="Homme"></i>',
                                                                                                                                                'F' => '<i class="bi bi-gender-female text-danger fs-5" title="Femme"></i>',
                                                                                                                                                default => '<i class="bi bi-gender-ambiguous text-secondary fs-5" title="Autre"></i>',
                                                                                                                                            };                                                                                                                                   ?></p>
                    <p></p>
                </figcaption>
            </nav>

            <article class="container-fluid p-5 border">

            </article>

        </section>
    </main>
</body>

</html>
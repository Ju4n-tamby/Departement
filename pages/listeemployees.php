<?php
require('../inc/functions.php');
$employees = getAllEmployees($_GET['dept_no']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Départements - Accueil</title>
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

        td {
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
                <i class="bi bi-diagram-3 me-2 text-secondary"></i>Liste employees du departement : <?= getDepartement($_GET['dept_no'])['dept_name'] ?>
            </h1>
        </div>
    </header>

    <main class="container">
        <div class="card shadow-sm p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th scope="col"><i class="bi bi-hash"></i> Numéro</th>
                            <th scope="col"><i class="bi bi-building"></i> Nom et Prenom</th>
                            <th scope="col"><i class="bi bi-person-badge"></i> Genre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee) { ?>
                            <tr>
                                <td class="fw-bold text-center">
                                    <?= htmlspecialchars($employee['emp_no']) ?>
                                </td>
                                <td>
                                    <i class="bi bi-person text-secondary me-2"></i>
                                    <?= htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']) ?>
                                </td>
                                <td>
                                    <?php
                                    if ($depart['gender'] === 'M') {
                                        echo '<i class="bi bi-gender-male text-primary"></i>';
                                    } elseif ($depart['gender'] === 'F') {
                                        echo '<i class="bi bi-gender-female text-danger"></i>';
                                    } else {
                                        echo '<i class="bi bi-gender-ambiguous text-secondary"></i>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
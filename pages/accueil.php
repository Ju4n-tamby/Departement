<?php
require('../inc/functions.php');
$departements = getAlldepartements();
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

        td>a {
            display: block;
            color: inherit;
            text-decoration: none;
            padding: 0.75rem 1rem;
            width: 100%;
        }

        tr:hover td>a {
            background-color: #f2f4f6;
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <header class="bg-light border-bottom py-4 mb-5 shadow-sm">
        <div class="container text-center">
            <h1 class="display-5 fw-semibold mb-0">
                <i class="bi bi-diagram-3 me-2 text-secondary"></i>Départements
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
                            <th scope="col"><i class="bi bi-building"></i> Nom</th>
                            <th scope="col"><i class="bi bi-person-badge"></i> Managers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($departements as $depart) {
                            $url = "departement.php?dept_no=" . urlencode($depart['dept_no']);
                        ?>
                            <tr>
                                <td class="fw-bold text-center">
                                    <a href="#?dept_no="<?= htmlspecialchars($depart['dept_no']) ?>"">
                                        <?= htmlspecialchars($depart['dept_no']) ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="#?dept_no="<?= htmlspecialchars($depart['dept_no']) ?>"" class="d-flex align-items-center">
                                        <i class="bi bi-buildings text-secondary me-2"></i>
                                        <?= htmlspecialchars($depart['dept_name']) ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="#?dept_no="<?= htmlspecialchars($depart['dept_no']) ?>"">
                                        <ul class="list-unstyled mb-0">
                                            <?php
                                            $managers = getAllManagersNow($depart['dept_no']);
                                            if (empty($managers)) {
                                                echo '<span class="text-muted fst-italic">Aucun manager</span>';
                                            } else {
                                                foreach ($managers as $manager) {
                                                    echo '<li><span class="badge bg-secondary rounded-pill badge-manager">' .
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
            </div>
        </div>
    </main>
</body>

</html>
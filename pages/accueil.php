<?php
require('../inc/functions.php');
$departements = getAlldepartements();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Départements - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .header {
            background: #0d6efd;
            color: white;
            padding: 2.5rem 1rem;
            text-align: center;
            border-bottom: 4px solid #0b5ed7;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 2.8rem;
            font-weight: bold;
            margin: 0;
        }

        .header i {
            font-size: 2.2rem;
            margin-right: 0.5rem;
        }

        .table-wrapper {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.06);
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
            font-size: 1.1rem;
        }

        .table td,
        .table th {
            padding: 1.2rem;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f1f5ff;
        }

        .badge-manager {
            background-color: #6c757d;
            font-size: 0.9rem;
            padding: 0.4em 0.8em;
            margin: 0.2rem 0;
        }

        .icon-dept {
            color: #0d6efd;
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .table-wrapper {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <h1><i class="bi bi-diagram-3"></i> Départements</h1>
    </header>

    <main class="container my-5">
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="text-center">
                        <tr>
                            <th scope="col"><i class="bi bi-hash"></i> Numéro</th>
                            <th scope="col"><i class="bi bi-building"></i> Nom</th>
                            <th scope="col"><i class="bi bi-person-badge"></i> Managers Actuels</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($departements as $depart) { ?>
                            <a href="#">
                                <tr>
                                    <td class="fw-bold text-center"><?= $depart['dept_no'] ?></td>
                                    <td><i class="bi bi-buildings icon-dept"></i><?= htmlspecialchars($depart['dept_name']) ?></td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            <?php
                                            $managers = getAllManagersNow($depart['dept_no']);
                                            if (empty($managers)) {
                                                echo '<span class="text-muted fst-italic">Aucun manager</span>';
                                            } else {
                                                foreach ($managers as $manager) {
                                                    echo '<li><span class="badge rounded-pill badge-manager">' .
                                                        htmlspecialchars($manager['first_name'] . ' ' . $manager['last_name']) .
                                                        '</span></li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                            </a>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
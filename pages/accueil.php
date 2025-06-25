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
            background: #f8f9fa;
        }

        .header {
            background: linear-gradient(135deg, #dc3545, #6f42c1);
            color: white;
            padding: 3rem 1rem;
            text-align: center;
        }

        .header h1 {
            font-size: 2.8rem;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .badge-manager {
            background-color: #0d6efd;
            font-size: 0.85rem;
        }

        .table-responsive {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1><i class="bi bi-building"></i> Liste des Départements</h1>
    </header>

    <main class="container my-5">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Numéro</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Managers Actuels</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($departements as $depart) { ?>
                        <tr>
                            <td class="fw-bold text-center"><?= $depart['dept_no'] ?></td>
                            <td><?= $depart['dept_name'] ?></td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    <?php
                                    $managers = getAllManagersNow($depart['dept_no']);
                                    if (empty($managers)) {
                                        echo '<span class="text-muted fst-italic">Aucun manager</span>';
                                    } else {
                                        foreach ($managers as $manager) {
                                            echo '<li><span class="badge rounded-pill badge-manager">' . htmlspecialchars($manager['first_name'] . ' ' . $manager['last_name']) . '</span></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>

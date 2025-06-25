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
            background-color: #f5f5f5;
            color: #333;
            font-family: 'Segoe UI', sans-serif;
        }

        .header {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 2rem 1rem;
            text-align: center;
        }

        .header h1 {
            font-size: 2.2rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.5rem;
        }

        .table thead {
            background-color: #e9ecef;
        }

        .table-hover tbody tr:hover {
            background-color: #f0f0f0;
        }

        .badge-manager {
            background-color: #6c757d;
            color: white;
            font-size: 0.8rem;
            padding: 0.4em 0.6em;
        }

        .table-responsive {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: white;
            padding: 1rem;
        }

        .bi-building {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1><i class="bi bi-building"></i> Départements</h1>
    </header>

    <main class="container my-5">
        <div class="table-responsive shadow-sm">
            <table class="table table-hover align-middle">
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
                            <td class="fw-semibold text-center"><?= $depart['dept_no'] ?></td>
                            <td><?= htmlspecialchars($depart['dept_name']) ?></td>
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
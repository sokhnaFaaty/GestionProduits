

<h1>Liste des commandes</h1>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Date</th>
            <th>Client</th>
            <th>Montant Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes as $c): ?>
        <tr>
            <td><?= $c['id_commande'] ?></td>
            <td><?= htmlspecialchars($c['code']) ?></td>
            <td><?= $c['date'] ?></td>
            <td><?= htmlspecialchars($c['prenom'] . ' ' . $c['nom']) ?></td>
            <td><?= number_format($c['montantTotal'], 0, ',', ' ') ?> FCFA</td>
            <td>
                <a href="<?= WEBROOT ?>?controller=commandes&page=detailCommande&id=<?= $c['id_commande'] ?>">
                    Voir détail
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

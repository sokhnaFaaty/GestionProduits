

<!-- ── Infos générales de la commande ─────────────────── -->
<h1>Détail de la commande</h1>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <td><strong>ID Commande</strong></td>
        <td><?= $commande['id_commande'] ?></td>
    </tr>
    <tr>
        <td><strong>Code</strong></td>
        <td><?= htmlspecialchars($commande['code']) ?></td>
    </tr>
    <tr>
        <td><strong>Date</strong></td>
        <td><?= $commande['date'] ?></td>
    </tr>
    <tr>
        <td><strong>Client</strong></td>
        <td><?= htmlspecialchars($commande['prenom'] . ' ' . $commande['nom']) ?></td>
    </tr>
    <tr>
        <td><strong>Montant Total</strong></td>
        <td><?= number_format($commande['montantTotal'], 0, ',', ' ') ?> FCFA</td>
    </tr>
</table>

<!-- ── Lignes de produits ─────────────────────────────── -->
<h2>Produits commandés</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Référence</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Sous-total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lignes as $ligne): ?>
        <tr>
            <td><?= htmlspecialchars($ligne['libelle']) ?></td>
            <td><?= htmlspecialchars($ligne['reference']) ?></td>
            <td><?= number_format($ligne['prix'], 0, ',', ' ') ?> FCFA</td>
            <td><?= $ligne['quantite'] ?></td>
            <td><?= number_format($ligne['sous_total'], 0, ',', ' ') ?> FCFA</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4"><strong>TOTAL</strong></td>
            <td>
                <strong>
                <?= number_format($commande['montantTotal'], 0, ',', ' ') ?> FCFA
                </strong>
            </td>
        </tr>
    </tfoot>
</table>

<a href="<?= WEBROOT?>?controller=commandes&page=listeCommande">← Retour à la liste</a>

<
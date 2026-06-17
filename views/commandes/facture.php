<!-- EN-TÊTE -->
<div class="header">
  <div class="logo-block">
    <h1>GestionApp</h1>
    <p>Système de gestion de commandes</p>
  </div>
  <div class="invoice-title">
    <h2>FACTURE</h2>
    <p>#<?= str_pad($commande['id_commande'], 5, '0', STR_PAD_LEFT) ?></p>
  </div>
</div>

<!-- MÉTA -->
<div class="meta">
  <div class="meta-block">
    <p class="label">Client</p>
    <p class="value"><?= htmlspecialchars($commande['prenom'] . ' ' . $commande['nom']) ?></p>
  </div>
  <div class="meta-block" style="text-align:right">
    <p class="label">Date</p>
    <p class="value"><?= date('d/m/Y', strtotime($commande['date_commande'])) ?></p>
    <p class="sub">Statut : <span class="badge"><?= htmlspecialchars($commande['statut']) ?></span></p>
  </div>
</div>

<!-- LIGNES -->
<table>
  <thead>
    <tr>
      <th>Désignation</th>
      <th>Prix unitaire</th>
      <th>Qté</th>
      <th>Sous-total</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($lignes as $ligne): ?>
    <tr>
      <td><?= htmlspecialchars($ligne['libelle']) ?></td>
      <td><?= number_format((float)$ligne['prix_unitaire'], 0, ',', ' ') ?> FCFA</td>
      <td><?= $ligne['quantite'] ?></td>
      <td><?= number_format((float)$ligne['sous_total'], 0, ',', ' ') ?> FCFA</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr class="total-row">
      <td colspan="3" style="text-align:right">TOTAL</td>
      <td><?= number_format((float)$commande['montant_total'], 0, ',', ' ') ?> FCFA</td>
    </tr>
  </tfoot>
</table>

<p class="footer-note">Merci pour votre confiance · GestionApp · <?= date('Y') ?></p>
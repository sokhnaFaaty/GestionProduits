<div class="max-w-4xl mx-auto px-6 py-8">

  <!-- EN-TÊTE -->
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold text-gray-900">Détail de la commande #<?= $commande['id_commande'] ?></h1>
      <p class="text-sm text-gray-500 mt-0.5"><?= date('d/m/Y H:i', strtotime($commande['date_commande'])) ?></p>
    </div>
    <a href="<?= path('commandes','listeCommande') ?>"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
      <i class="fa-solid fa-arrow-left"></i> Retour
    </a>
  </div>

  <div class="grid grid-cols-2 gap-4 mb-6">

    <!-- INFOS CLIENT -->
    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
      <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Client</p>
      <p class="text-lg font-semibold text-gray-800">
        <?= htmlspecialchars($commande['prenom'] . ' ' . $commande['nom']) ?>
      </p>
    </div>

    <!-- STATUT / MONTANT -->
    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
      <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Montant total</p>
      <p class="text-2xl font-bold text-indigo-600">
        <?= number_format((float)$commande['montant_total'], 0, ',', ' ') ?> FCFA
      </p>
      <span class="inline-block mt-2 px-2 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
        <?= htmlspecialchars($commande['statut']) ?>
      </span>
    </div>

  </div>

  <!-- LIGNES DE COMMANDE -->
  <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
      <h2 class="text-sm font-medium text-gray-700">Produits commandés</h2>
    </div>
    <table class="w-full text-sm">
      <thead class="bg-gray-50 border-b border-gray-200">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Produit</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Prix unitaire</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Quantité</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Sous-total</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        <?php foreach ($lignes as $ligne): ?>
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-3 text-gray-800"><?= htmlspecialchars($ligne['libelle']) ?></td>
          <td class="px-4 py-3 text-right text-gray-600"><?= number_format((float)$ligne['prix_unitaire'], 0, ',', ' ') ?> FCFA</td>
          <td class="px-4 py-3 text-right text-gray-600"><?= $ligne['quantite'] ?></td>
          <td class="px-4 py-3 text-right font-medium text-gray-800"><?= number_format((float)$ligne['sous_total'], 0, ',', ' ') ?> FCFA</td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot class="bg-gray-50 border-t border-gray-200">
        <tr>
          <td colspan="3" class="px-4 py-3 text-right text-sm font-semibold text-gray-700">Total</td>
          <td class="px-4 py-3 text-right text-base font-bold text-indigo-600">
            <?= number_format((float)$commande['montant_total'], 0, ',', ' ') ?> FCFA
          </td>
        </tr>
      </tfoot>
    </table>
  </div>

</div>
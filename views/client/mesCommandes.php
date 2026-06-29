<div class="max-w-5xl mx-auto px-6 py-8">

  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold text-gray-900">Mes commandes</h1>
      <p class="text-sm text-gray-500 mt-0.5">Historique de toutes vos commandes</p>
    </div>
  </div>

  <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50 border-b border-gray-200">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">N°</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Statut</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Total</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Détail</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        <?php if (empty($commandes)): ?>
        <tr>
          <td colspan="5" class="px-4 py-12 text-center text-gray-400 text-sm">
            Vous n'avez aucune commande pour le moment.
          </td>
        </tr>
        <?php else: ?>
        <?php foreach ($commandes as $c): ?>
        <tr class="hover:bg-gray-50 transition">
          <td class="px-4 py-3 text-gray-800">#<?= $c['id_commande'] ?></td>
          <td class="px-4 py-3 text-gray-600"><?= date('d/m/Y', strtotime($c['date_commande'])) ?></td>
          <td class="px-4 py-3">
            <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
              <?= htmlspecialchars($c['statut']) ?>
            </span>
          </td>
          <td class="px-4 py-3 font-medium text-gray-800">
            <?= number_format((float)$c['montant_total'], 0, ',', ' ') ?> FCFA
          </td>
          <td class="px-4 py-3">
            <a href="<?= path('client', 'detailCommande', ['id' => $c['id_commande']]) ?>"
               class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition">
              <i class="fa-solid fa-eye"></i> Voir
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>
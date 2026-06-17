  <div class="max-w-5xl mx-auto px-6 py-8">

    <!-- EN-TÊTE -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-2xl font-semibold text-gray-900">Commandes</h1>
        <p class="text-sm text-gray-500 mt-0.5">Gérez votre base de commandes</p>
      </div>
      <a href="<?= WEBROOT ?>?controller=commandes&page=ajoutCommande"
        class=" inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 active:scale-95 transition shadow-sm">
        + Nouveau commande
      </a>
    </div>

    <!-- STATS -->
    <!-- <div class="grid grid-cols-3 gap-4 mb-8">
      <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Total</p>
        <p class="text-3xl font-semibold text-gray-900" id="stat-total">0</p>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Ce mois</p>
        <p class="text-3xl font-semibold text-indigo-600">2</p>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Avec commandes</p>
        <p class="text-3xl font-semibold text-green-600">2</p>
      </div>
    </div> -->

    <!-- TABLEAU -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
      <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <span class="text-sm font-medium text-gray-700">Liste des clients (<span id="count">0</span>)</span>
        <input oninput="filterTable(this.value)" type="text" placeholder="Rechercher..."
          class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 w-56 transition"/>
      </div>
      <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
          <tr>
            <!-- <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">ID</th> -->
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">N°</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Client</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Date</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Statut</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Total</th>
            <!-- <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Articles</th> -->
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Actions</th>
          </tr>
        </thead>
        
        <tbody id="table-body" class="divide-y divide-gray-100">
            <?php foreach($commandes as $commande): ?>
                <?php extract($commande) ?>
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3 text-gray-800"><?= $id_commande?></td>
                <td class="px-4 py-3 text-gray-800"><?= $nom_client ." ". $prenom_client?></td>
                <td class="px-4 py-3 text-gray-800"><?= $date_commande ?></td>
                <td class="px-4 py-3 text-gray-800"><?= $statut ?></td>
                <td class="px-4 py-3 text-gray-800"><?= $montant_total ?></td>

                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <!-- Modifier -->
                        <a href=""
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition">
                            <i class="fa-solid fa-eye"></i> Détail
                        </a>
                        <!-- Supprimer -->
                        <a href=""
                            name = "supprimer"
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs  font-medium text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition">
                            <i class="fa-solid fa-trash"></i> Supprimer
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
      <div id="empty" class="hidden text-center py-12 text-gray-400 text-sm">Aucun commande trouvé.</div>
    </div>
  </div>



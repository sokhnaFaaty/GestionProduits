

<div class="max-w-5xl mx-auto px-6 py-8">

  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold text-gray-900">Produits</h1>
      <p class="text-sm text-gray-500 mt-0.5">Gérez votre catalogue de produits</p>
    </div>
    <a href="<?= path('produits', 'ajoutProduit') ?>"
      class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm">
      + Nouveau produit
    </a>
  </div>

  <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
      <span class="text-sm font-medium text-gray-700">
        Liste des produits (<?= count($produits) ?>)
      </span>
      <input oninput="filterTable(this.value)" type="text" placeholder="Rechercher..."
        class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 w-56 transition"/>
    </div>

    <table class="w-full text-sm">
      <thead class="bg-gray-50 border-b border-gray-200">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Référence</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Libellé</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Prix</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Quantité</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Stock</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Actions</th>
        </tr>
      </thead>
      <tbody id="table-body" class="divide-y divide-gray-100">
        <?php foreach($produits as $p):
          $q = (int)$p['quantite_stock'];
          if($q === 0)     $badge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Rupture</span>';
          elseif($q < 5)   $badge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Faible</span>';
          else             $badge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">En stock</span>';
        ?>
        <tr class="hover:bg-gray-50 transition-colors" data-libelle="<?= strtolower(htmlspecialchars($p['libelle'])) ?>">
          <td class="px-4 py-3 text-gray-700 font-mono text-xs"><?= htmlspecialchars($p['reference']) ?></td>
          <td class="px-4 py-3">
            <div class="flex items-center gap-3">
              <?php if (!empty($p['image'])): ?>
                <img src="<?= WEBROOT ?>uploads/produits/<?= htmlspecialchars($p['image']) ?>"
                     alt="" class="w-10 h-10 object-cover rounded-lg border border-gray-200 flex-shrink-0"/>
              <?php else: ?>
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <i class="fa-solid fa-image text-gray-300"></i>
                </div>
              <?php endif; ?>
              <span class="font-medium text-gray-900"><?= htmlspecialchars($p['libelle']) ?></span>
            </div>
          </td>
          <td class="px-4 py-3 text-gray-700 font-medium"><?= number_format($p['prix'], 0, ',', ' ') ?> FCFA</td>
          <td class="px-4 py-3 text-gray-600"><?= $q ?></td>
          <td class="px-4 py-3"><?= $badge ?></td>
          <td class="px-4 py-3">
            <div class="flex gap-2">
              <a href="<?= path('produits', 'modifierProduit', ['id' => $p['id_produit']]) ?>"
                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                <i class="fa-solid fa-pen-to-square"></i> Modifier
              </a>
              <button onclick="openDel(<?= $p['id_produit'] ?>, '<?= addslashes(htmlspecialchars($p['libelle'])) ?>')"
                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition">
                <i class="fa-solid fa-trash"></i> Supprimer
              </button>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php if(empty($produits)): ?>
    <div class="text-center py-12 text-gray-400 text-sm">Aucun produit trouvé.</div>
    <?php endif; ?>
  </div>
</div>

<!-- MODAL SUPPRIMER -->
<div id="modal-del" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 px-4">
  <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-sm">
    <div class="flex items-center gap-3 mb-3">
      <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600 text-lg"><i class="fa-solid fa-trash"></i></div>
      <h3 class="text-base font-semibold text-gray-800">Confirmer la suppression</h3>
    </div>
    <p class="text-sm text-gray-500 mb-6" id="del-msg"></p>
    <div class="flex justify-end gap-3">
      <button onclick="closeDel()"
        class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition">
        Annuler
      </button>
      <a id="del-link" href="#"
        class="px-5 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
        Supprimer
      </a>
    </div>
  </div>
</div>

<script>
  function filterTable(q) {
    const rows  = document.querySelectorAll('#table-body tr');
    let visible = 0;
    rows.forEach(row => {
      const match = row.dataset.libelle.includes(q.toLowerCase());
      row.style.display = match ? '' : 'none';
      if(match) visible++;
    });
  }

  function openDel(id, name) {
    document.getElementById('del-msg').textContent = `Supprimer "${name}" ? Cette action est irréversible.`;
    document.getElementById('del-link').href = `<?= WEBROOT ?>produits/supprimerProduit?id=${id}`;
    document.getElementById('modal-del').classList.remove('hidden');
  }

  function closeDel() {
    document.getElementById('modal-del').classList.add('hidden');
  }
</script>


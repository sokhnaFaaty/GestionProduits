
<div class="max-w-2xl mx-auto px-6 py-10">

  <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
    <span>Produits</span>
    <span>/</span>
    <span class="text-gray-800 font-medium"><?= isset($produit) ? 'Modifier' : 'Ajouter' ?></span>
  </div>

  <div class="mb-8">
    <h1 class="text-2xl font-semibold text-gray-900">
      <?= isset($produit) ? 'Modifier le produit' : 'Nouveau produit' ?>
    </h1>
    <p class="text-sm text-gray-500 mt-1">Remplissez les informations du produit.</p>
  </div>

  <?php
    $valLibelle  = $save['libelle']  ?? ($produit['libelle']        ?? '');
    $valPrix     = $save['prix']     ?? ($produit['prix']           ?? '');
    $valQuantite = $save['quantite'] ?? ($produit['quantite_stock'] ?? '');
    $actionUrl     = isset($produit) ? path('produits', 'modifierProduit', ['id' => $produit['id_produit']]) : path('produits', 'ajoutProduit');
    $imageActuelle = $produit['image'] ?? null;
  ?>

  <form method="POST" action="<?= $actionUrl ?>" enctype="multipart/form-data">
  <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
    <div class="grid grid-cols-2 gap-5">

      <!-- Libellé -->
      <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">
          Libellé <span class="text-red-500">*</span>
        </label>
        <span class="text-red-500"><?= $errors["libelleVide"] ?? "" ?></span>
        <input name="libelle" type="text"
          value="<?= htmlspecialchars($valLibelle) ?>"
          placeholder="Ex: Ordinateur portable Dell XPS"
          class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition placeholder:text-gray-400"/>
      </div>

      <!-- Prix -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">
          Prix (FCFA) <span class="text-red-500">*</span>
        </label>
        <span class="text-red-500"><?= $errors["prixVide"] ?? "" ?></span>
        <div class="relative">
          <input name="prix" type="number" min="0"
            value="<?= htmlspecialchars($valPrix) ?>"
            placeholder="0"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 pr-16 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition placeholder:text-gray-400"/>
          <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">FCFA</span>
        </div>
      </div>

      <!-- Quantité -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">
          Quantité en stock <span class="text-red-500">*</span>
        </label>
        <span class="text-red-500"><?= $errors["quantiteVide"] ?? "" ?></span>
        <input name="quantite" type="number" min="0"
          value="<?= htmlspecialchars($valQuantite) ?>"
          placeholder="0"
          class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition placeholder:text-gray-400"/>
      </div>

      <!-- Image -->
      <div class="col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">
          Image du produit <span class="text-gray-400 font-normal">(optionnel)</span>
        </label>

        <?php if ($imageActuelle): ?>
        <div class="mb-3 flex items-center gap-3">
          <img src="<?= WEBROOT ?>uploads/produits/<?= htmlspecialchars($imageActuelle) ?>"
               alt="Image actuelle" class="w-16 h-16 object-cover rounded-lg border border-gray-200"/>
          <span class="text-xs text-gray-400">Image actuelle — choisir un nouveau fichier pour remplacer</span>
        </div>
        <?php endif; ?>

        <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition">
          <div class="flex flex-col items-center gap-1 text-gray-400" id="upload-label">
            <i class="fa-solid fa-image text-2xl"></i>
            <span class="text-xs">Cliquez pour choisir une image</span>
            <span class="text-xs">JPG, PNG, WEBP — max 2 Mo</span>
          </div>
          <input type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif"
                 class="hidden" onchange="previewImage(this)"/>
        </label>
        <p id="file-name" class="text-xs text-gray-400 mt-1"></p>
      </div>

    </div>

    <p class="text-xs text-gray-400 mt-4"><span class="text-red-500">*</span> Champs obligatoires</p>

    <div class="flex items-center justify-between mt-8 pt-5 border-t border-gray-100">
      <a href="<?= path('produits', 'listeProduit') ?>"
        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
        ← Retour à la liste
      </a>
      <div class="flex gap-3">
        <button type="reset" onclick="document.getElementById('file-name').textContent=''; document.getElementById('upload-label').style.display='flex';"
          class="px-4 py-2.5 text-sm text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
          Réinitialiser
        </button>
        <button type="submit" name="envoie"
          class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 active:scale-95 transition shadow-sm">
          <?= isset($produit) ? '<i class="fa-solid fa-check mr-1"></i> Modifier' : '<i class="fa-solid fa-check mr-1"></i> Enregistrer' ?>
        </button>
      </div>
    </div>
  </div>
  </form>
</div>

<script>
function previewImage(input) {
  const label = document.getElementById('upload-label');
  const nameEl = document.getElementById('file-name');
  if (input.files && input.files[0]) {
    nameEl.textContent = input.files[0].name + ' (' + (input.files[0].size / 1024).toFixed(0) + ' Ko)';
  }
}
</script>
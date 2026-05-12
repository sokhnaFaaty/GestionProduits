
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
    $action      = isset($produit) ? 'modifierProduit&id=' . $produit['id'] : 'ajoutProduit';
  ?>

  <form method="POST" action="<?= WEBROOT ?>?controller=produits&page=<?= $action ?>">
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

    </div>

    <p class="text-xs text-gray-400 mt-4"><span class="text-red-500">*</span> Champs obligatoires</p>

    <div class="flex items-center justify-between mt-8 pt-5 border-t border-gray-100">
      <a href="<?= WEBROOT ?>?controller=produits&page=listeProduit"
        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
        ← Retour à la liste
      </a>
      <div class="flex gap-3">
        <button type="reset"
          class="px-4 py-2.5 text-sm text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
          Réinitialiser
        </button>
        <button type="submit" name="envoie"
          class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 active:scale-95 transition shadow-sm">
          <?= isset($produit) ? '✓ Modifier' : '✓ Enregistrer' ?>
        </button>
      </div>
    </div>
  </div>
  </form>
</div>


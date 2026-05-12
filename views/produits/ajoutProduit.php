<?php require_once(ROOT . "views/header.php"); ?>

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

  <?php if($success ?? false): ?>
  <div class="mb-6 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
    <span>✅</span><span>Produit ajouté avec succès !</span>
  </div>
  <?php endif; ?>

  <?php if(!empty($errors ?? [])): ?>
  <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
    <div class="flex items-center gap-2 mb-1"><span>⚠️</span><strong>Corrigez les erreurs :</strong></div>
    <?php foreach($errors as $e): ?>
      <p class="pl-6">— <?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <?php
    $action   = isset($produit) ? 'mettreAJourProduit' : 'enregistrerProduit';
    $libelle  = $produit['libelle']        ?? ($libelle  ?? '');
    $prix     = $produit['prix']           ?? ($prix     ?? '');
    $quantite = $produit['quantite_stock'] ?? ($quantite ?? '');
  ?>

  <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
    <form method="POST" action="<?= WEBROOT ?>?controller=produits&page=<?= $action ?>">

      <?php if(isset($produit)): ?>
        <input type="hidden" name="id" value="<?= $produit['id'] ?>"/>
      <?php endif; ?>

      <div class="grid grid-cols-2 gap-5">

        <div class="col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            Libellé <span class="text-red-500">*</span>
          </label>
          <input name="libelle" type="text"
            value="<?= htmlspecialchars($libelle) ?>"
            placeholder="Ex: Ordinateur portable Dell XPS"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition placeholder:text-gray-400"/>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            Prix (FCFA) <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <input name="prix" type="number" min="0"
              value="<?= htmlspecialchars($prix) ?>"
              placeholder="0"
              class="w-full border border-gray-300 rounded-xl px-4 py-2.5 pr-16 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition placeholder:text-gray-400"/>
            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">FCFA</span>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            Quantité en stock <span class="text-red-500">*</span>
          </label>
          <input name="quantite" type="number" min="0"
            value="<?= htmlspecialchars($quantite) ?>"
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
          <button type="submit"
            class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 active:scale-95 transition shadow-sm">
            <?= isset($produit) ? '✓ Modifier' : '✓ Enregistrer' ?>
          </button>
        </div>
      </div>

    </form>
  </div>
</div>

<?php require_once(ROOT . "views/footer.php"); ?>
<?php require_once(ROOT . "views/header.php"); ?>
<div class="max-w-2xl mx-auto px-6 py-10">

  <!-- BREADCRUMB -->
  <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
    <span>Produits</span>
    <span>/</span>
    <span class="text-gray-800 font-medium">Ajouter</span>
  </div>

  <!-- TITRE -->
  <div class="mb-8">
    <h1 class="text-2xl font-semibold text-gray-900">Nouveau produit</h1>
    <p class="text-sm text-gray-500 mt-1">Remplissez les informations pour créer un produit.</p>
  </div>

  <!-- SUCCÈS -->
  <?php if($success ?? false): ?>
  <div class="mb-6 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
    <span>✅</span>
    <span>Produit ajouté avec succès !</span>
  </div>
  <?php endif; ?>

  <!-- ERREURS -->
  <?php if(!empty($errors)): ?>
  <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
    <div class="flex items-center gap-2 mb-1"><span>⚠️</span><strong>Corrigez les erreurs :</strong></div>
    <?php foreach($errors as $e): ?>
      <p class="pl-6">— <?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <!-- FORMULAIRE -->
  <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
    <form method="POST" action="<?= WEBROOT ?>?controller=produits&page=enregistrerProduit">

      <div class="grid grid-cols-2 gap-5">

        <!-- Libellé -->
        <div class="col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            Libellé <span class="text-red-500">*</span>
          </label>
          <input name="libelle" type="text"
            value="<?= htmlspecialchars($libelle ?? '') ?>"
            placeholder="Ex: Ordinateur portable Dell XPS"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition placeholder:text-gray-400"/>
        </div>

        <!-- Prix -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            Prix (FCFA) <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <input name="prix" type="number" min="0"
              value="<?= htmlspecialchars($prix ?? '') ?>"
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
          <input name="quantite" type="number" min="0"
            value="<?= htmlspecialchars($quantite ?? '') ?>"
            placeholder="0"
            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition placeholder:text-gray-400"/>
        </div>

      </div>

      <p class="text-xs text-gray-400 mt-4"><span class="text-red-500">*</span> Champs obligatoires</p>

      <!-- ACTIONS -->
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
            ✓ Enregistrer
          </button>
        </div>
      </div>

    </form>
  </div>
</div>

<?php require_once(ROOT . "views/footer.php"); ?>
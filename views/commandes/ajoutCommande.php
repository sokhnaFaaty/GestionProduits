
J
<div class="max-w-3xl mx-auto px-4 py-8">

  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Nouvelle commande</h1>
    <p class="text-sm text-gray-500 mt-1">Recherchez un client, ajoutez des produits, puis validez.</p>
  </div>

  <!-- Alertes globales -->
  <?php if (!empty($errors['client'])): ?>
    <div class="mb-4 text-sm text-red-700 bg-red-50 border border-red-200 px-4 py-3 rounded">
      <?= htmlspecialchars($errors['client']) ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($errors['panier'])): ?>
    <div class="mb-4 text-sm text-red-700 bg-red-50 border border-red-200 px-4 py-3 rounded">
      <?= htmlspecialchars($errors['panier']) ?>
    </div>
  <?php endif; ?>


  <!-- ── BLOC 1 : RECHERCHER UN CLIENT ── -->
  <div class="bg-white border border-gray-200 rounded-lg mb-4">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
      <span class="w-6 h-6 rounded-full bg-gray-900 text-white text-xs font-bold flex items-center justify-center">1</span>
      <h2 class="text-sm font-semibold text-gray-800 uppercase tracking-wide">Rechercher un client</h2>
    </div>
    <div class="px-5 py-4">

      <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>">
        <input type="hidden" name="action" value="rechercherClient">
        <div class="flex gap-3 items-end">
          <div class="flex-1">
            <?php if (!empty($errors['telephone'])): ?>
              <p class="text-red-500 text-xs mb-1"><?= htmlspecialchars($errors['telephone']) ?></p>
            <?php endif; ?>
            <label class="block text-xs font-medium text-gray-600 mb-1">Numéro de téléphone</label>
            <input type="tel" name="telephone" placeholder="Ex : 771112233"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
          </div>
          <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-700 transition">
            Rechercher
          </button>
        </div>
      </form>

      <?php if ($clientIntrouvable): ?>
        <div class="mt-3 text-sm text-red-600 bg-red-50 border border-red-200 px-3 py-2 rounded">
          Aucun client trouvé avec ce numéro.
        </div>
      <?php endif; ?>

      <?php if ($client): ?>
        <div class="mt-4 bg-gray-50 border border-gray-200 rounded p-4">
          <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Client sélectionné</p>
          <div class="grid grid-cols-3 gap-4">
            <div>
              <p class="text-xs text-gray-400 mb-0.5">Nom</p>
              <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($client['nom']) ?></p>
            </div>
            <div>
              <p class="text-xs text-gray-400 mb-0.5">Prénom</p>
              <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($client['prenom']) ?></p>
            </div>
            <div>
              <p class="text-xs text-gray-400 mb-0.5">Adresse</p>
              <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($client['adresse'] ?? '—') ?></p>
            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>


  <!-- ── BLOC 2 : AJOUTER DES PRODUITS ── -->
  <div class="bg-white border border-gray-200 rounded-lg mb-4">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
      <span class="w-6 h-6 rounded-full bg-gray-900 text-white text-xs font-bold flex items-center justify-center">2</span>
      <h2 class="text-sm font-semibold text-gray-800 uppercase tracking-wide">Ajouter des produits</h2>
    </div>
    <div class="px-5 py-4">

      <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>">
        <input type="hidden" name="action" value="rechercherProduit">
        <div class="flex gap-3 items-end">
          <div class="flex-1">
            <?php if (!empty($errors['libelle_produit'])): ?>
              <p class="text-red-500 text-xs mb-1"><?= htmlspecialchars($errors['libelle_produit']) ?></p>
            <?php endif; ?>
            <label class="block text-xs font-medium text-gray-600 mb-1">Libellé du produit</label>
            <input type="text" name="libelle_produit" placeholder="Ex : Ordinateur, Souris…"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400">
          </div>
          <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-700 transition">
            Rechercher
          </button>
        </div>
      </form>

      <?php if (!empty($errors['produit'])): ?>
        <div class="mt-3 text-sm text-red-600 bg-red-50 border border-red-200 px-3 py-2 rounded">
          <?= htmlspecialchars($errors['produit']) ?>
        </div>
      <?php endif; ?>

      <?php if ($produitTrouve): ?>
        <?php
          $dejaAjoute = 0;
          foreach ($panier as $l) {
            if ((int)$l['id_produit'] === (int)$produitTrouve['id_produit']) {
              $dejaAjoute = $l['quantite'];
              break;
            }
          }
          $stockRestant = $produitTrouve['quantite_stock'] - $dejaAjoute;
        ?>
        <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>">
          <input type="hidden" name="action"     value="ajouterProduit">
          <input type="hidden" name="id_produit" value="<?= $produitTrouve['id_produit'] ?>">
          <input type="hidden" name="prix"       value="<?= $produitTrouve['prix'] ?>">
          <input type="hidden" name="libelle"    value="<?= htmlspecialchars($produitTrouve['libelle']) ?>">
          <input type="hidden" name="stock"      value="<?= $produitTrouve['quantite_stock'] ?>">

          <div class="mt-4 bg-gray-50 border border-gray-200 rounded p-4">
            <div class="grid grid-cols-3 gap-4 mb-4">
              <div>
                <p class="text-xs text-gray-400 mb-0.5">Libellé</p>
                <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($produitTrouve['libelle']) ?></p>
              </div>
              <div>
                <p class="text-xs text-gray-400 mb-0.5">Prix unitaire</p>
                <p class="text-sm font-medium text-gray-900"><?= number_format($produitTrouve['prix'], 0, ',', ' ') ?> FCFA</p>
              </div>
              <div>
                <p class="text-xs text-gray-400 mb-0.5">Stock disponible</p>
                <p class="text-sm font-medium <?= $stockRestant <= 0 ? 'text-red-600' : 'text-gray-900' ?>">
                  <?= $stockRestant ?> unité<?= $stockRestant > 1 ? 's' : '' ?>
                  <?php if ($dejaAjoute > 0): ?>
                    <span class="text-xs text-green-600 font-normal">(<?= $dejaAjoute ?> dans le panier)</span>
                  <?php endif; ?>
                </p>
              </div>
            </div>

            <div class="flex gap-3 items-end">
              <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Quantité</label>
                <input type="number" name="quantite" min="1"
                       max="<?= $stockRestant > 0 ? $stockRestant : 1 ?>"
                       value="1"
                       <?= $stockRestant <= 0 ? 'disabled' : '' ?>
                       class="w-24 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 disabled:opacity-50">
              </div>
              <button type="submit"
                      <?= $stockRestant <= 0 ? 'disabled' : '' ?>
                      class="px-4 py-2 bg-green-700 text-white text-sm rounded hover:bg-green-800 transition disabled:opacity-40 disabled:cursor-not-allowed">
                <?= $dejaAjoute > 0 ? '+ Ajouter encore' : '+ Ajouter au panier' ?>
              </button>
            </div>

            <?php if ($stockRestant <= 0): ?>
              <p class="text-xs text-red-500 mt-2">Stock épuisé pour ce produit.</p>
            <?php endif; ?>
            <?php if (!empty($errors['ajout'])): ?>
              <p class="text-xs text-red-500 mt-2"><?= htmlspecialchars($errors['ajout']) ?></p>
            <?php endif; ?>
          </div>
        </form>
      <?php endif; ?>

    </div>
  </div>


  <!-- ── BLOC 3 : RÉCAPITULATIF ── -->
  <div class="bg-white border border-gray-200 rounded-lg">
    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
      <span class="w-6 h-6 rounded-full bg-gray-900 text-white text-xs font-bold flex items-center justify-center">3</span>
      <h2 class="text-sm font-semibold text-gray-800 uppercase tracking-wide">Récapitulatif de la commande</h2>
    </div>
    <div class="px-5 py-4">

      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-gray-200">
            <th class="text-left   text-xs font-semibold text-gray-500 uppercase tracking-wide pb-2">Article</th>
            <th class="text-right  text-xs font-semibold text-gray-500 uppercase tracking-wide pb-2">Prix unit.</th>
            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide pb-2">Qté</th>
            <th class="text-right  text-xs font-semibold text-gray-500 uppercase tracking-wide pb-2">Montant</th>
            <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wide pb-2">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <?php if (empty($panier)): ?>
            <tr>
              <td colspan="5" class="text-center text-gray-400 text-sm py-8 italic">
                Aucun produit ajouté pour l'instant.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($panier as $ligne): ?>
              <tr>
                <td class="py-3 font-medium text-gray-900"><?= htmlspecialchars($ligne['libelle']) ?></td>
                <td class="py-3 text-right text-gray-600"><?= number_format($ligne['prix'], 0, ',', ' ') ?> FCFA</td>
                <td class="py-3 text-center font-medium text-gray-900"><?= $ligne['quantite'] ?></td>
                <td class="py-3 text-right font-semibold text-gray-900"><?= number_format($ligne['sous_total'], 0, ',', ' ') ?> FCFA</td>
                <td class="py-3 text-center">
                  <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>">
                    <input type="hidden" name="action"     value="retirerProduit">
                    <input type="hidden" name="id_retirer" value="<?= $ligne['id_produit'] ?>">
                    <button type="submit"
                            class="text-xs text-red-600 border border-red-200 bg-red-50 px-2.5 py-1 rounded hover:bg-red-100 transition">
                      Retirer
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

      <!-- Total -->
      <div class="flex justify-end items-baseline gap-3 mt-4 pt-4 border-t border-gray-200">
        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Total</span>
        <span class="text-2xl font-bold text-gray-900"><?= number_format($montantTotal, 0, ',', ' ') ?> FCFA</span>
      </div>

      <!-- Validation -->
      <div class="flex justify-end items-center gap-4 mt-4">
        <?php if (!$client || empty($panier)): ?>
          <p class="text-xs text-gray-400">
            <?= !$client       ? '<i class="fa-solid fa-triangle-exclamation mr-1"></i> Sélectionnez un client.'       : '' ?>
            <?= empty($panier) ? '<i class="fa-solid fa-triangle-exclamation mr-1"></i> Ajoutez au moins un produit.' : '' ?>
          </p>
        <?php endif; ?>
        <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>">
          <input type="hidden" name="action" value="validerCommande">
          <button type="submit"
                  <?= (empty($panier) || !$client) ? 'disabled' : '' ?>
                  class="px-6 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded hover:bg-gray-700 transition disabled:opacity-40 disabled:cursor-not-allowed">
            Valider la commande
          </button>
        </form>
      </div>

    </div>
  </div>

</div>
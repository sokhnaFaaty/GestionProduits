
<header class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6">
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Nouvelle Commande</h2>
    <p class="mt-1 text-sm text-gray-500">Suivez les étapes pour enregistrer une commande.</p>
</header>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 mb-12">

    <!-- SECTION 1 : CLIENT -->
    <section class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-indigo-700 mb-4">1. Client</h3>

        <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>">
            <input type="hidden" name="action" value="rechercherClient">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div>
                    <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Téléphone</label>
                    <div class="flex gap-2">
                        <input type="text" name="telephone"
                            placeholder="Ex: 771234567"
                            class="flex-1 px-3 py-2 border <?= $clientIntrouvable || !empty($errors['telephone']) ? 'border-red-400' : 'border-gray-300' ?> rounded-md text-sm focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium text-sm transition">
                            OK
                        </button>
                    </div>
                    <?php if (!empty($errors['telephone'])): ?>
                        <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['telephone']) ?></p>
                    <?php elseif ($clientIntrouvable): ?>
                        <p class="mt-1 text-xs text-red-600">Aucun client trouvé avec ce numéro.</p>
                    <?php elseif ($client): ?>
                        <p class="mt-1 text-xs text-emerald-600">✓ Client trouvé</p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Nom</label>
                    <input type="text" readonly
                        value="<?= htmlspecialchars($client['nom'] ?? '') ?>"
                        placeholder="Généré automatiquement"
                        class="w-full px-3 py-2 bg-gray-100 border border-gray-200 text-gray-700 rounded-md text-sm cursor-not-allowed font-medium">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Prénom</label>
                    <input type="text" readonly
                        value="<?= htmlspecialchars($client['prenom'] ?? '') ?>"
                        placeholder="Généré automatiquement"
                        class="w-full px-3 py-2 bg-gray-100 border border-gray-200 text-gray-700 rounded-md text-sm cursor-not-allowed font-medium">
                </div>
            </div>
        </form>
    </section>

    <!-- SECTION 2 : PRODUIT -->
    <section class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 <?= !$client ? 'opacity-50 pointer-events-none' : '' ?>">
        <h3 class="text-sm font-semibold uppercase tracking-wider text-indigo-700 mb-4">2. Produit</h3>

        <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>">
            <input type="hidden" name="action" value="rechercherProduit">
            <div class="space-y-4">
                <div class="max-w-xs">
                    <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Référence Produit</label>
                    <div class="flex gap-2">
                        <input type="text" name="ref_produit"
                            value="<?= htmlspecialchars($produitTrouve['reference'] ?? '') ?>"
                            placeholder="Ex: REF-001"
                            class="flex-1 px-3 py-2 border <?= !empty($errors['produit']) ? 'border-red-400' : 'border-gray-300' ?> rounded-md text-sm focus:ring-1 focus:ring-indigo-500 focus:outline-none">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium text-sm transition">
                            OK
                        </button>
                    </div>
                    <?php if (!empty($errors['produit'])): ?>
                        <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['produit']) ?></p>
                    <?php elseif ($produitTrouve): ?>
                        <p class="mt-1 text-xs text-emerald-600">✓ Produit trouvé</p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Libellé</label>
                        <input type="text" readonly
                            value="<?= htmlspecialchars($produitTrouve['libelle'] ?? '') ?>"
                            placeholder="Produit recherché"
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 text-gray-500 rounded-md text-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Prix</label>
                        <input type="text" readonly
                            value="<?= $produitTrouve ? number_format($produitTrouve['prix'], 0, ',', ' ') . ' F CFA' : '' ?>"
                            placeholder="0 F CFA"
                            class="w-full px-3 py-2 bg-gray-100 border border-gray-200 text-gray-500 rounded-md text-sm cursor-not-allowed font-semibold">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Stock disponible</label>
                        <div class="flex items-center gap-2">
                            <input type="text" readonly
                                value="<?= htmlspecialchars((string)($produitTrouve['quantite_stock'] ?? '')) ?>"
                                placeholder="0"
                                class="w-24 px-3 py-2 bg-gray-100 border border-gray-200 text-gray-500 rounded-md text-sm cursor-not-allowed text-center font-bold">
                            <?php if ($produitTrouve):
                                $qteDejaAuPanier = 0;
                                foreach ($panier as $item) {
                                    if ((int)$item['id_produit'] === (int)$produitTrouve['id_produit']) {
                                        $qteDejaAuPanier = $item['quantite'];
                                        break;
                                    }
                                }
                                $stockRestant = $produitTrouve['quantite_stock'] - $qteDejaAuPanier;
                            ?>
                                <span class="text-xs font-bold <?= $stockRestant > 0 ? 'text-emerald-600 bg-emerald-50 border-emerald-200' : 'text-red-600 bg-red-50 border-red-200' ?> px-2.5 py-1 rounded border">
                                    Dispo : <?= $stockRestant ?>
                                </span>
                            <?php else: ?>
                                <span class="text-xs font-bold text-gray-400 bg-gray-50 border-gray-200 px-2.5 py-1 rounded border">
                                    Dispo : -
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php if ($produitTrouve): ?>
        <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>" class="pt-4 border-t border-gray-100 mt-4">
            <input type="hidden" name="action"     value="ajouterProduit">
            <input type="hidden" name="id_produit" value="<?= $produitTrouve['id_produit'] ?>">
            <div class="max-w-xs">
                <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Quantité à commander</label>
                <div class="flex gap-2">
                    <input type="number" name="quantite" value="1" min="1"
                        max="<?= $stockRestant > 0 ? $stockRestant : 1 ?>"
                        <?= $stockRestant <= 0 ? 'disabled' : '' ?>
                        class="flex-1 px-3 py-2 border <?= !empty($errors['ajout']) ? 'border-red-400' : 'border-gray-300' ?> rounded-md text-sm text-center font-semibold focus:ring-1 focus:ring-indigo-500 focus:outline-none disabled:opacity-50">
                    <button type="submit"
                        <?= $stockRestant <= 0 ? 'disabled' : '' ?>
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md font-medium text-sm transition whitespace-nowrap disabled:opacity-40 disabled:cursor-not-allowed">
                        + Ajouter au panier
                    </button>
                </div>
                <?php if (!empty($errors['ajout'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= htmlspecialchars($errors['ajout']) ?></p>
                <?php elseif ($stockRestant <= 0): ?>
                    <p class="mt-1 text-xs text-red-600">Stock épuisé pour ce produit.</p>
                <?php endif; ?>
            </div>
        </form>
        <?php endif; ?>
    </section>

    <!-- SECTION 3 : PANIER -->
    <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden <?= !$client ? 'opacity-50 pointer-events-none' : '' ?>">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-indigo-700">3. Mon Panier</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="px-5 py-3 text-left text-xs font-bold text-gray-600 uppercase">Libellé</th>
                        <th class="px-5 py-3 text-left text-xs font-bold text-gray-600 uppercase">Prix Unit.</th>
                        <th class="px-5 py-3 text-center text-xs font-bold text-gray-600 uppercase">Qté</th>
                        <th class="px-5 py-3 text-left text-xs font-bold text-gray-600 uppercase">Total</th>
                        <th class="px-5 py-3 text-right text-xs font-bold text-gray-600 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (empty($panier)): ?>
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-gray-400 text-sm">
                                Le panier est vide. Ajoutez des produits ci-dessus.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($panier as $ligne): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3 text-sm text-gray-800 font-medium"><?= htmlspecialchars($ligne['libelle']) ?></td>
                            <td class="px-5 py-3 text-sm text-gray-600"><?= number_format($ligne['prix'], 0, ',', ' ') ?> F CFA</td>
                            <td class="px-5 py-3 text-sm text-center text-gray-700 font-medium"><?= $ligne['quantite'] ?></td>
                            <td class="px-5 py-3 text-sm text-gray-900 font-bold"><?= number_format($ligne['sous_total'], 0, ',', ' ') ?> F CFA</td>
                            <td class="px-5 py-3 text-sm text-right">
                                <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>">
                                    <input type="hidden" name="action"     value="retirerProduit">
                                    <input type="hidden" name="id_retirer" value="<?= $ligne['id_produit'] ?>">
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 font-semibold text-xs border border-red-200 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded transition">
                                        Retirer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <form method="POST" action="<?= path('commandes', 'ajoutCommande') ?>">
            <input type="hidden" name="action" value="validerCommande">
            <div class="p-5 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <?php if (!$client || empty($panier)): ?>
                        <p class="text-xs text-gray-400">
                            <?= !$client       ? '⚠ Sélectionnez un client.' : '' ?>
                            <?= empty($panier) ? '⚠ Ajoutez au moins un produit.' : '' ?>
                        </p>
                    <?php endif; ?>
                    <?php if (!empty($errors['client'])): ?>
                        <p class="text-xs text-red-600"><?= htmlspecialchars($errors['client']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($errors['panier'])): ?>
                        <p class="text-xs text-red-600"><?= htmlspecialchars($errors['panier']) ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col items-end gap-3">
                    <div class="text-lg font-bold text-gray-800">
                        Total : <span class="text-indigo-700 text-xl font-black">
                            <?= number_format($montantTotal, 0, ',', ' ') ?> F CFA
                        </span>
                    </div>
                    <button type="submit"
                        <?= (empty($panier) || !$client) ? 'disabled' : '' ?>
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-md font-semibold text-sm shadow-md transition disabled:opacity-40 disabled:cursor-not-allowed">
                        Enregistrer la commande
                    </button>
                </div>
            </div>
        </form>
    </section>

</div>

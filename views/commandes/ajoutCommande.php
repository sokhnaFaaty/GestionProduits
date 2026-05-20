<div id="modal-overlay"
  class=" fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4">

  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

    <!-- En-tête modal -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
      <h2 class="text-lg font-semibold text-gray-900">Nouvelle Commande</h2>
      <button onclick="fermerModal()"
        class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-1.5 transition">
        ✕
      </button>
    </div>

    <!-- Corps du modal -->
    <form method="POST" action="<?= WEBROOT ?>?controller=commandes&page=ajoutCommande" id="form-commande">
      <input type="hidden" name="action"    value="creer_commande">
      <input type="hidden" name="id_client" id="hidden-id-client" value="<?= (isset($verif)) ? $verif["id_client"] : "" ?>">

      <div class="px-6 py-5 space-y-5">

        <!-- ══ ÉTAPE 1 : Vérification client ══ -->
        <div>
          <h3 class="text-sm font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-100">
            Informations Client
          </h3>

          <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Nom <span class="text-red-500">*</span></label>
                <span class="text-red-500"><?=$errors["nomVide"] ??""?></span>

              <input type="text" name="nom" id="inp-nom" placeholder="Diop"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Prénom <span class="text-red-500">*</span></label>
                <span class="text-red-500"><?=$errors["prenomVide"] ??""?></span>
              <input type="text" name="prenom" id="inp-prenom" placeholder="Moussa"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Email <span class="text-red-500">*</span></label>
                <span class="text-red-500"><?=$errors["email"] ??""?></span>

              <input type="email" name="email" id="inp-email" placeholder="moussa@gmail.com"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Téléphone</label>
                <span class="text-red-500"><?=$errors["telephoneVide"] ??""?></span>

              <input type="text" name="telephone" id="inp-tel" placeholder="77 111 22 33"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>
          </div>

          <!-- Bouton vérifier → POST vers PHP -->
          <button type="submit" name="verif" value=""
            class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition">
            🔍 Vérifier le client
          </button>

          <!-- ── Résultat vérification (fictif, PHP à l'étape 3) ──
               Ici on simule un client "trouvé" — sera contrôlé par PHP -->
               <?php if (!is_null($verif) && !empty($verif)):  ?>
          <div id="client-trouve" class=" mt-3 flex items-center gap-3 bg-green-50 border border-green-200 rounded-lg px-4 py-3">
            <div class="w-9 h-9 rounded-full bg-green-500 text-white flex items-center justify-center text-sm font-bold flex-shrink-0">MD</div>
            <div>
              <p class="text-sm font-semibold text-green-800"><?=$verif["nom"] ?? "" ." ". $verif["prenom"] ??"" ?></p>
              <p class="text-xs text-green-600"><?=$verif["email"] ?? "" ." ". $verif["telephone"] ?? "" ?></p>
            </div>
          </div>
         
           <?php elseif (isset($_REQUEST["verif"])):?>
          <div id="client-introuvable" class=" mt-3 flex items-center gap-2 bg-red-50 border border-red-200 rounded-lg px-4 py-3 text-sm text-red-700">
            ⚠️ Aucun client trouvé avec ces informations.
          </div>
          <?php endif; ?>
        </div>
       
        <!-- ══ ÉTAPE 2 : Date + Statut (désactivés jusqu'à vérification) ══ -->
        <div>
          <h3 class="text-sm font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-100">
            Informations de la commande
          </h3>
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Date <span class="text-red-500">*</span></label>
              <!-- DISABLED → retiré par PHP quand client vérifié -->
              
              <input type="date" name="date_commande" id="inp-date"
                value="<?= date('Y-m-d') ?>"  <?=  isset($verif) ? "" : "disabled" ?>
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-100 text-gray-400 cursor-not-allowed transition disabled:opacity-60">
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Statut</label>
              <select name="statut" id="inp-statut"  <?=  isset($verif) ? "" : "disabled" ?>
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-100 text-gray-400 cursor-not-allowed transition disabled:opacity-60">
                <option value="NON SOLDEE">Non soldée</option>
                <option value="SOLDEE">Soldée</option>
              </select>
            </div>
          </div>
        </div>

        <!-- ══ ÉTAPE 3 : Produits (désactivés jusqu'à vérification) ══ -->
        <div>
          <h3 class="text-sm font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-100">
            Ajouter des produits
          </h3>

          <div class="flex gap-2 items-end mb-3">
            <div class="flex-1">
              <label class="block text-xs font-medium text-gray-600 mb-1">Produit</label>
              <!-- DONNÉES FICTIVES → remplacées par foreach $produits à l'étape 4 -->
              <select id="sel-produit"  <?=  isset($verif )? "" : "disabled" ?>
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-100 text-gray-400 cursor-not-allowed disabled:opacity-60">
                <?php foreach($allProduits as $key=>$produit): ?>
                <option value="">Sélectionner un produit</option>
                <option value="<?php $produit["id_produit"] ?>"><?= $produit["libelle"] ."" .$produit["prix"] ?></option>
               
                <?php endforeach; ?>
              </select>
            </div>
            <div class="w-24">
              <label class="block text-xs font-medium text-gray-600 mb-1">Qté</label>
              <input type="number" id="inp-qty" value="1" min="1" <?=  isset($verif )? "" : "disabled" ?>
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-100 text-gray-400 cursor-not-allowed disabled:opacity-60">
            </div>
            <button type="button" id="btn-ajouter" <?=  isset($verif )? "" : "disabled" ?>
              class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
              + Ajouter
            </button>
          </div>

          <!-- Table des lignes -->
          <div class="border border-gray-200 rounded-lg overflow-hidden mb-3">
            <table class="w-full text-sm">
              <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                  <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Produit</th>
                  <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Prix unit.</th>
                  <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Quantité</th>
                  <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Total</th>
                  <th class="px-4 py-2.5"></th>
                </tr>
              </thead>
              <tbody id="lignes-body">
                <tr id="empty-row">
                  <td colspan="5" class="px-4 py-6 text-center text-gray-400 text-xs">Aucun produit ajouté</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Inputs cachés soumis avec le formulaire -->
          <div id="hidden-inputs"></div>

          <div class="flex justify-end items-center gap-3 pt-2 border-t border-gray-100">
            <span class="text-sm text-gray-500">Total général :</span>
            <span class="text-lg font-bold text-indigo-600" id="total-display">0 FCFA</span>
            <input type="hidden" name="montant_total" id="hidden-total" value="0">
          </div>
        </div>

      </div><!-- /px-6 py-5 -->

      <!-- Pied du modal -->
      <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
        <button type="button" onclick="fermerModal()"
          class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
          Annuler
        </button>
        <!-- DISABLED → retiré par PHP quand client vérifié -->
        <button type="submit" id="btn-enregistrer" <?=  isset($verif )? "" : "disabled" ?>
          class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
          Enregistrer la commande
        </button>
      </div>

    </form>
  </div>
</div>
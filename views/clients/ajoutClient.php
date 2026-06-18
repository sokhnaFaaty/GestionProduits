  <div class="max-w-2xl mx-auto px-6 py-10">

      <!-- BREADCRUMB -->
      <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
          <a href="<?= path('clients', 'listeClient') ?>" class="hover:text-indigo-600 transition">Clients</a>
          <span>/</span>
          <span class="text-gray-800 font-medium">Ajouter</span>
      </div>

      <!-- TITRE -->
      <div class="mb-8">
          <h1 class="text-2xl font-semibold text-gray-900">Nouveau client</h1>
          <p class="text-sm text-gray-500 mt-1">Remplissez les informations pour créer un client.</p>
      </div>

      <!-- ALERTE SUCCÈS
      <div id="alert-success" class="hidden mb-6 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
          <span class="text-lg">✅</span>
          <span>Client ajouté avec succès ! <a href="<?= path('clients', 'listeClient') ?>" class="underline font-medium">Voir la liste</a></span>
      </div>

      ALERTE ERREUR -->
      <!-- <div id="alert-error" class="hidden mb-6 flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
          <span class="text-lg">⚠️</span>
          <span id="error-msg">Veuillez remplir les champs obligatoires.</span>
      </div> --> 

      <!-- FORMULAIRE -->
      <form method="POST" action="<?= path('clients', 'ajoutClient') ?>">
      <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
          <div class="grid grid-cols-2 gap-5">

              <!-- Nom -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1.5">
                      Nom <span class="text-red-500">*</span>
                  </label>
                  <span class="text-red-500"><?=$errors["nomVide"] ??""?></span>
                  <input name="nom" type="text" placeholder="Diallo"
                      class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition placeholder:text-gray-400" />
              </div>

              <!-- Prénom -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1.5">
                      Prénom <span class="text-red-500">*</span>
                  </label>
                  <span class="text-red-500"><?= $errors["prenomVide"] ??"" ?></span>

                  <input name="prenom" type="text" placeholder="Moussa"
                      class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition placeholder:text-gray-400" />
              </div>

              <!-- Téléphone -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1.5">Téléphone</label>
                  <span class="text-red-500"><?= $errors["telephoneVide"] ??"" ?></span>
                  <input name="telephone" type="tel" placeholder="+221 77 000 00 00"
                      class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition placeholder:text-gray-400" />
              </div>

              <!-- Email -->
              <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                  <span class="text-red-500"><?= $errors["email"] ??"" ?></span>
                  <input name="email" type="email" placeholder="moussa@email.com"
                      class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition placeholder:text-gray-400" />
              </div>

          </div>

          <p class="text-xs text-gray-400 mt-4"><span class="text-red-500">*</span> Champs obligatoires</p>

          <!-- ACTIONS -->
          <div class="flex items-center justify-between mt-8 pt-5 border-t border-gray-100">
              <a href="<?= path('clients', 'listeClient') ?>"
                  class="inline-flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                  ← Retour à la liste
              </a>
              <div class="flex gap-3">
                  <!-- <button 
                      class="px-4 py-2.5 text-sm text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                      Réinitialiser
                  </button> -->
                  <button name="envoie"
                        type="submit"
                      class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 active:scale-95 transition shadow-sm">
                      <i class="fa-solid fa-check mr-1"></i> Enregistrer
                  </button>
              </div>
          </div>
      </div>
      </form>
  </div>
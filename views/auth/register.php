<div class="w-full max-w-md">
  <div class="bg-white rounded-2xl shadow-lg p-8">

    <!-- LOGO -->
    <div class="flex flex-col items-center mb-8">
      <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center mb-3 shadow">
        <i class="fa-solid fa-user-plus text-white text-xl"></i>
      </div>
      <h1 class="text-2xl font-semibold text-gray-800">Créer un compte</h1>
      <p class="text-sm text-gray-400 mt-1">Remplissez vos informations</p>
    </div>

    <!-- FORMULAIRE -->
    <form method="POST" action="<?= path('auth', 'register') ?>" class="space-y-4">

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
          <span class="text-red-500 text-xs"><?= $errors['nomVide'] ?? '' ?></span>
          <input type="text" name="nom" value="<?= htmlspecialchars($save['nom'] ?? '') ?>"
            placeholder="Diallo"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"/>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Prénom <span class="text-red-500">*</span></label>
          <span class="text-red-500 text-xs"><?= $errors['prenomVide'] ?? '' ?></span>
          <input type="text" name="prenom" value="<?= htmlspecialchars($save['prenom'] ?? '') ?>"
            placeholder="Moussa"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"/>
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone <span class="text-red-500">*</span></label>
        <span class="text-red-500 text-xs"><?= $errors['telephoneVide'] ?? '' ?></span>
        <input type="tel" name="telephone" value="<?= htmlspecialchars($save['telephone'] ?? '') ?>"
          placeholder="771234567"
          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"/>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
        <span class="text-red-500 text-xs"><?= $errors['email'] ?? '' ?></span>
        <input type="email" name="email" value="<?= htmlspecialchars($save['email'] ?? '') ?>"
          placeholder="moussa@email.com"
          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"/>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe <span class="text-red-500">*</span></label>
        <span class="text-red-500 text-xs"><?= $errors['password'] ?? '' ?></span>
        <input type="password" name="password"
          placeholder="••••••••"
          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"/>
      </div>

      <button type="submit"
        class="w-full bg-indigo-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-indigo-700 active:scale-95 transition shadow-sm">
        Créer mon compte
      </button>

      <p class="text-center text-sm text-gray-500">
        Déjà un compte ?
        <a href="<?= path('auth', 'login') ?>" class="text-indigo-600 font-medium hover:underline">Se connecter</a>
      </p>

    </form>

  </div>
</div>
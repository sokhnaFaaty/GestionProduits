<div class="w-full max-w-md">

  <!-- CARD -->
  <div class="bg-white rounded-2xl shadow-lg p-8">

    <!-- LOGO -->
    <div class="flex flex-col items-center mb-8">
      <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center mb-3 shadow">
        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
        </svg>
      </div>
      <h1 class="text-2xl font-semibold text-gray-800">Gestion Commande</h1>
      <p class="text-sm text-gray-400 mt-1">Connectez-vous à votre espace</p>
    </div>

    <!-- ERREUR -->
    <?php if (!empty($error)): ?>
    <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-600 flex items-center gap-2">
      <i class="fa-solid fa-circle-exclamation"></i>
      <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <!-- FORMULAIRE -->
    <form method="POST" action="<?= path('auth', 'login') ?>" class="space-y-5">

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email"autofocus
          value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
          placeholder="admin@gestionapp.com"/>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
        <input type="password" name="password"
          class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
          placeholder="••••••••"/>
      </div>

      <button type="submit"
        class="w-full bg-indigo-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-indigo-700 active:scale-95 transition shadow-sm">
        Se connecter
      </button>
<p class="text-center text-sm text-gray-500 mt-4">
  Pas encore de compte ?
  <a href="<?= path('auth', 'register') ?>" class="text-indigo-600 font-medium hover:underline">S'inscrire</a>
</p>
    </form>

  </div>
</div>
<div class="max-w-2xl mx-auto px-6 py-8">

  <div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Mon profil</h1>
    <p class="text-sm text-gray-500 mt-0.5">Vos informations personnelles</p>
  </div>

  <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-4">

    <div class="grid grid-cols-2 gap-4">

      <div>
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Nom</p>
        <p class="text-sm font-medium text-gray-800"><?= htmlspecialchars($client['nom']) ?></p>
      </div>

      <div>
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Prénom</p>
        <p class="text-sm font-medium text-gray-800"><?= htmlspecialchars($client['prenom']) ?></p>
      </div>

      <div>
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Téléphone</p>
        <p class="text-sm font-medium text-gray-800"><?= htmlspecialchars($client['telephone']) ?></p>
      </div>

      <div>
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Email</p>
        <p class="text-sm font-medium text-gray-800"><?= htmlspecialchars($client['email']) ?></p>
      </div>

    </div>

  </div>

</div>
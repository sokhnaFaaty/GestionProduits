<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GestionApp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <script>tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter','sans-serif'] } } } }</script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col">

      <!-- LOGO -->
      <div class="px-6 py-5 border-b border-gray-200 flex items-center gap-3">
        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
          </svg>
        </div>
        <div>
          <h1 class="font-semibold text-gray-800">GestionApp</h1>
          <p class="text-xs text-gray-400">Dashboard</p>
        </div>
      </div>

      <!-- MENU -->
      <?php $ctrl = $_REQUEST['controller'] ?? 'clients'; ?>
      <nav class="flex-1 p-4 space-y-1">

        <a href="<?= path('clients','listeClient') ?>"
           class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition
                  <?= $ctrl === 'clients' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' ?>">
          <i class="fa-solid fa-user w-5 text-center"></i>
          <span>Clients</span>
        </a>

        <a href="<?= path('produits','listeProduit') ?>"
           class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition
                  <?= $ctrl === 'produits' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' ?>">
          <i class="fa-solid fa-box w-5 text-center"></i>
          <span>Produits</span>
        </a>

        <a href="<?= path('commandes','listeCommande') ?>"
           class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition
                  <?= $ctrl === 'commandes' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' ?>">
          <i class="fa-solid fa-file-invoice w-5 text-center"></i>
          <span>Commandes</span>
        </a>

      </nav>

      <!-- FOOTER / DÉCONNEXION -->
      <div class="p-4 border-t border-gray-200 space-y-2">
        <div class="bg-gray-50 rounded-xl p-3">
          <p class="text-sm font-medium text-gray-700">Admin</p>
          <p class="text-xs text-gray-400">gestion@app.com</p>
        </div>
        <a href="<?= path('auth','logout') ?>"
           class="flex items-center gap-2 w-full px-3 py-2 text-sm text-red-600 rounded-lg hover:bg-red-50 transition font-medium">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Déconnexion</span>
        </a>
      </div>

    </aside>

    <!-- CONTENU -->
    <main class="flex-1 p-6">
      <?= $content ?>
    </main>

  </div>

</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mon Espace — GestionApp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?= WEBROOT ?>public/font-awesome/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <script>tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter','sans-serif'] } } } }</script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex min-h-screen">

    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col">

      <div class="px-6 py-5 border-b border-gray-200 flex items-center gap-3">
        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
          <i class="fa-solid fa-user text-white"></i>
        </div>
        <div>
          <h1 class="font-semibold text-gray-800">Mon Espace</h1>
          <p class="text-xs text-gray-400"><?= htmlspecialchars($_SESSION['user']['nom']) ?></p>
        </div>
      </div>

      <?php $page = $_REQUEST['page'] ?? 'mesCommandes'; ?>
      <nav class="flex-1 p-4 space-y-1">
        <a href="<?= path('client', 'mesCommandes') ?>"
           class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition
                  <?= $page === 'mesCommandes' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' ?>">
          <i class="fa-solid fa-receipt w-5 text-center"></i>
          <span>Mes commandes</span>
        </a>
        <a href="<?= path('client', 'monProfil') ?>"
           class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition
                  <?= $page === 'monProfil' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' ?>">
          <i class="fa-solid fa-user w-5 text-center"></i>
          <span>Mon profil</span>
        </a>
      </nav>

      <div class="p-4 border-t border-gray-200">
        <div class="bg-gray-50 rounded-xl p-3 mb-2">
          <p class="text-sm font-medium text-gray-700"><?= htmlspecialchars($_SESSION['user']['nom']) ?></p>
          <p class="text-xs text-gray-400">Client</p>
        </div>
        <a href="<?= path('auth', 'logout') ?>"
           class="flex items-center gap-2 w-full px-3 py-2 text-sm text-red-600 rounded-lg hover:bg-red-50 transition font-medium">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Déconnexion</span>
        </a>
      </div>

    </aside>

    <main class="flex-1 p-6">
      <?= $content ?>
    </main>

  </div>

</body>
</html>
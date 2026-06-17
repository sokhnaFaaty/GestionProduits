<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ajouter un Client</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link 
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" 
    rel="stylesheet"
  />

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif']
          }
        }
      }
    }
  </script>
</head>

<body class="bg-gray-100 font-sans">

  <div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col">

      <!-- LOGO -->
      <div class="px-6 py-5 border-b border-gray-200 flex items-center gap-3">
        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
          <svg 
            class="w-5 h-5 text-white" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2" 
            viewBox="0 0 24 24"
          >
            <path 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              d="M3 7h18M3 12h18M3 17h18"
            />
          </svg>
        </div>

        <div>
          <h1 class="font-semibold text-gray-800">GestionApp</h1>
          <p class="text-xs text-gray-400">Dashboard</p>
        </div>
      </div>

      <!-- MENU -->
      <nav class="flex-1 p-4 space-y-2">

        <!-- CLIENTS -->
        <a 
          href="<?= path('clients','listeClient') ?>" 
          class="flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-50 text-indigo-700 font-medium"
        >
          <span class="text-lg">👤</span>
          <span>Clients</span>
        </a>

        <!-- PRODUITS -->
        <a 
          href="<?= path('produits','listeProduit') ?>" 
          class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-100 transition"
        >
          <span class="text-lg">📦</span>
          <span>Produits</span>
        </a>

        <!-- COMMANDES -->
        <a 
          href="<?= path('commandes','listeCommande') ?>" 
          class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-100 transition"
        >
          <span class="text-lg">🛒</span>
          <span>Commandes</span>
        </a>

      </nav>

      <!-- FOOTER -->
      <div class="p-4 border-t border-gray-200">
        <div class="bg-gray-50 rounded-xl p-3">
          <p class="text-sm font-medium text-gray-700">Admin</p>
          <p class="text-xs text-gray-400">gestion@app.com</p>
        </div>
      </div>

    </aside>

    <!-- CONTENU -->
    <main class="flex-1 p-6">
      <?= $content ?>
    </main>

  </div>

</body>
</html>
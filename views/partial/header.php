<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GestionApp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <script>tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter','sans-serif'] } } } }</script>
</head>
<body class="bg-gray-50 min-h-screen font-sans">

  <!-- NAVBAR -->
  <nav class="bg-white border-b border-gray-200 px-6 py-3 flex items-center gap-6 shadow-sm">
    <div class="flex items-center gap-2">
      <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center">
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/></svg>
      </div>
      <span class="font-semibold text-gray-800 text-sm">GestionApp</span>
    </div>
    <?php
    $controller = $_REQUEST['controller'] ?? 'clients';
    $active   = "px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 font-medium";
    $inactive = "px-3 py-1.5 rounded-lg text-gray-600 hover:bg-gray-100 transition";
    ?>
    <div class="flex gap-1 text-sm">
     
  <div class="flex gap-1 text-sm">
    <a href="<?= path('clients', 'listeClient') ?>"
       class="<?= $controller === 'clients' ? $active : $inactive ?>">
      <i class="fa-solid fa-user mr-1"></i> Clients
    </a>
    <a href="<?= path('produits', 'listeProduit') ?>"
       class="<?= $controller === 'produits' ? $active : $inactive ?>">
      <i class="fa-solid fa-box mr-1"></i> Produits
    </a>
    <a href="<?= path('commandes', 'listeCommande') ?>"
       class="<?= $controller === 'commandes' ? $active : $inactive ?>">
      <i class="fa-solid fa-receipt mr-1"></i> Commandes
    </a>
  </div>
    </div>
  </nav>

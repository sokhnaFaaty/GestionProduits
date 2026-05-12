<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Liste des Produits</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
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
    <div class="flex gap-1 text-sm">
      <a href="liste_clients.html" class="px-3 py-1.5 rounded-lg text-gray-600 hover:bg-gray-100 transition">👤 Clients</a>
      <a href="liste_produits.html" class="px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 font-medium">📦 Produits</a>
    </div>
  </nav>

  <div class="max-w-5xl mx-auto px-6 py-8">

    <!-- EN-TÊTE -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-2xl font-semibold text-gray-900">Produits</h1>
        <p class="text-sm text-gray-500 mt-0.5">Gérez votre catalogue de produits</p>
      </div>
      <a href="ajouter_produit.html"
        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 active:scale-95 transition shadow-sm">
        + Nouveau produit
      </a>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-3 gap-4 mb-8">
      <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Total</p>
        <p class="text-3xl font-semibold text-gray-900" id="stat-total">0</p>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">En stock</p>
        <p class="text-3xl font-semibold text-green-600" id="stat-stock">0</p>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Rupture</p>
        <p class="text-3xl font-semibold text-red-500" id="stat-rupture">0</p>
      </div>
    </div>

    <!-- TABLEAU -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
      <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <span class="text-sm font-medium text-gray-700">Liste des produits (<span id="count">0</span>)</span>
        <input oninput="filterTable(this.value)" type="text" placeholder="🔍 Rechercher..."
          class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 w-56 transition"/>
      </div>
      <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">ID</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Libellé</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Prix</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Quantité</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Stock</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Actions</th>
          </tr>
        </thead>
        <tbody id="table-body" class="divide-y divide-gray-100"></tbody>
      </table>
      <div id="empty" class="hidden text-center py-12 text-gray-400 text-sm">Aucun produit trouvé.</div>
    </div>
  </div>

  <!-- MODAL MODIFIER -->
  <div id="modal-edit" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md">
      <h3 class="text-base font-semibold text-gray-800 mb-5">✏️ Modifier le produit</h3>
      <input type="hidden" id="edit-id"/>
      <div class="grid grid-cols-2 gap-4">
        <div class="col-span-2">
          <label class="block text-xs font-medium text-gray-600 mb-1">Libellé</label>
          <input id="edit-libelle" type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"/>
        </div>
        <div>
          <label class="block text-xs font-medium text-gray-600 mb-1">Prix (FCFA)</label>
          <input id="edit-prix" type="number" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"/>
        </div>
        <div>
          <label class="block text-xs font-medium text-gray-600 mb-1">Quantité</label>
          <input id="edit-qty" type="number" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"/>
        </div>
      </div>
      <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
        <button onclick="closeModal()" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition">Annuler</button>
        <button onclick="saveEdit()" class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">✓ Enregistrer</button>
      </div>
    </div>
  </div>

  <!-- MODAL SUPPRIMER -->
  <div id="modal-del" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-sm">
      <div class="flex items-center gap-3 mb-3">
        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600 text-lg">🗑️</div>
        <h3 class="text-base font-semibold text-gray-800">Confirmer la suppression</h3>
      </div>
      <p class="text-sm text-gray-500 mb-6" id="del-msg"></p>
      <div class="flex justify-end gap-3">
        <button onclick="closeDel()" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition">Annuler</button>
        <button onclick="confirmDel()" class="px-5 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">Supprimer</button>
      </div>
    </div>
  </div>

  <script>
    const DEFAULT = [
      { id: 1, libelle: 'Ordinateur portable', prix: 450000, quantite: 5 },
      { id: 2, libelle: 'Souris sans fil', prix: 12500, quantite: 20 },
      { id: 3, libelle: 'Clavier USB', prix: 8000, quantite: 0 },
      { id: 4, libelle: 'Écran 24"', prix: 85000, quantite: 8 }
    ];

    function load() {
      const raw = localStorage.getItem('produits');
      return raw ? JSON.parse(raw) : DEFAULT;
    }
    function save(data) { localStorage.setItem('produits', JSON.stringify(data)); }

    let prods = load();
    let deleteId = null;

    function badge(q) {
      if (q === 0) return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Rupture</span>';
      if (q < 5) return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Faible</span>';
      return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">En stock</span>';
    }

    function render(list) {
      const tb = document.getElementById('table-body');
      const empty = document.getElementById('empty');
      document.getElementById('stat-total').textContent = prods.length;
      document.getElementById('stat-stock').textContent = prods.filter(p => p.quantite > 0).length;
      document.getElementById('stat-rupture').textContent = prods.filter(p => p.quantite === 0).length;
      document.getElementById('count').textContent = list.length;
      if (!list.length) { tb.innerHTML = ''; empty.classList.remove('hidden'); return; }
      empty.classList.add('hidden');
      tb.innerHTML = list.map(p => `
        <tr class="hover:bg-gray-50 transition-colors">
          <td class="px-4 py-3 text-gray-400 font-mono text-xs">#${p.id}</td>
          <td class="px-4 py-3 font-medium text-gray-900">${p.libelle}</td>
          <td class="px-4 py-3 text-gray-700 font-medium">${p.prix.toLocaleString('fr-FR')} FCFA</td>
          <td class="px-4 py-3 text-gray-600">${p.quantite}</td>
          <td class="px-4 py-3">${badge(p.quantite)}</td>
          <td class="px-4 py-3">
            <div class="flex gap-2">
              <button onclick="openEdit(${p.id})"
                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                ✏️ Modifier
              </button>
              <button onclick="openDel(${p.id}, '${p.libelle.replace(/'/g,"\\\'")}')"
                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition">
                🗑️ Supprimer
              </button>
            </div>
          </td>
        </tr>`).join('');
    }

    function filterTable(q) {
      render(prods.filter(p => p.libelle.toLowerCase().includes(q.toLowerCase())));
    }

    function openEdit(id) {
      const p = prods.find(x => x.id === id);
      document.getElementById('edit-id').value = id;
      document.getElementById('edit-libelle').value = p.libelle;
      document.getElementById('edit-prix').value = p.prix;
      document.getElementById('edit-qty').value = p.quantite;
      document.getElementById('modal-edit').classList.remove('hidden');
    }

    function saveEdit() {
      const id = parseInt(document.getElementById('edit-id').value);
      const p = prods.find(x => x.id === id);
      p.libelle = document.getElementById('edit-libelle').value;
      p.prix = parseInt(document.getElementById('edit-prix').value) || 0;
      p.quantite = parseInt(document.getElementById('edit-qty').value) || 0;
      save(prods); render(prods); closeModal();
    }

    function closeModal() { document.getElementById('modal-edit').classList.add('hidden'); }

    function openDel(id, name) {
      deleteId = id;
      document.getElementById('del-msg').textContent = `Supprimer "${name}" ? Cette action est irréversible.`;
      document.getElementById('modal-del').classList.remove('hidden');
    }

    function confirmDel() {
      prods = prods.filter(x => x.id !== deleteId);
      save(prods); render(prods); closeDel();
    }

    function closeDel() { document.getElementById('modal-del').classList.add('hidden'); }

    render(prods);
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <title>Facture #<?= $commande['id_commande'] ?? '' ?></title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 13px; color: #1f2937; background: #f3f4f6; }
    .page { max-width: 780px; margin: 30px auto; background: #fff; padding: 48px; box-shadow: 0 4px 24px rgba(0,0,0,.08); }
    .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; }
    .logo-block h1 { font-size: 22px; font-weight: 700; color: #4f46e5; }
    .logo-block p  { font-size: 11px; color: #6b7280; margin-top: 2px; }
    .invoice-title { text-align: right; }
    .invoice-title h2 { font-size: 28px; font-weight: 300; letter-spacing: 2px; color: #374151; }
    .invoice-title p  { font-size: 12px; color: #6b7280; margin-top: 4px; }
    .meta { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 36px; padding: 20px; background: #f9fafb; border-radius: 8px; }
    .meta-block p.label { font-size: 10px; text-transform: uppercase; letter-spacing: .08em; color: #9ca3af; margin-bottom: 4px; }
    .meta-block p.value { font-size: 14px; font-weight: 600; color: #111827; }
    .meta-block p.sub   { font-size: 12px; color: #6b7280; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
    thead th { padding: 10px 14px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: .08em; color: #6b7280; border-bottom: 2px solid #e5e7eb; }
    thead th:not(:first-child) { text-align: right; }
    tbody td { padding: 12px 14px; border-bottom: 1px solid #f3f4f6; font-size: 13px; color: #374151; }
    tbody td:not(:first-child) { text-align: right; }
    tfoot td { padding: 12px 14px; font-weight: 700; font-size: 15px; }
    tfoot td:last-child { text-align: right; color: #4f46e5; }
    .total-row { background: #f5f3ff; }
    .footer-note { margin-top: 40px; padding-top: 20px; border-top: 1px solid #e5e7eb; font-size: 11px; color: #9ca3af; text-align: center; }
    .print-btn { display: flex; gap: 10px; justify-content: center; margin: 24px auto 0; }
    .print-btn button { padding: 10px 28px; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; }
    .btn-print { background: #4f46e5; color: #fff; }
    .btn-close { background: #f3f4f6; color: #374151; }
    .badge { display: inline-block; padding: 2px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: #fef3c7; color: #92400e; }
    @media print {
      body { background: #fff; }
      .page { box-shadow: none; margin: 0; padding: 32px; }
      .print-btn { display: none !important; }
    }
  </style>
</head>
<body>
  <div class="page">
    <?= $content ?>
  </div>
  <div class="print-btn no-print">
    <button class="btn-print" onclick="window.print()"><i>🖨</i> Imprimer / Enregistrer PDF</button>
    <button class="btn-close" onclick="window.close()">Fermer</button>
  </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sevilla FC – Plantilla</title>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Nunito:wght@600;800;900&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg:     #0f0f1a;
      --card:   #1a1a2e;
      --border: rgba(255,255,255,0.08);
      --red:    #e3000b;
      --white:  #ffffff;
      --text:   #f0f0f0;
      --muted:  #8892b0;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: var(--bg);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      font-family: 'Nunito', sans-serif;
      color: var(--text);
      padding: 32px 20px 60px;
    }

    /* Fondo animado */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background:
        radial-gradient(ellipse at 20% 30%, rgba(227,0,11,0.12) 0%, transparent 55%),
        radial-gradient(ellipse at 80% 70%, rgba(255,255,255,0.06) 0%, transparent 55%);
      pointer-events: none;
    }

    /* TÍTULO */
    h1 {
      font-family: 'Press Start 2P', monospace;
      font-size: clamp(0.75rem, 2.5vw, 1.2rem);
      color: var(--white);
      text-shadow: 3px 3px 0 var(--red), 0 0 40px rgba(227,0,11,0.5);
      margin-bottom: 8px;
      text-align: center;
      animation: glow 2.5s ease-in-out infinite alternate;
    }

    .subtitle {
      font-family: 'Press Start 2P', monospace;
      font-size: clamp(0.45rem, 1.5vw, 0.65rem);
      color: var(--muted);
      margin-bottom: 36px;
      text-align: center;
      letter-spacing: 2px;
    }

    @keyframes glow {
      from { text-shadow: 3px 3px 0 var(--red), 0 0 20px rgba(227,0,11,0.3); }
      to   { text-shadow: 3px 3px 0 var(--red), 0 0 60px rgba(227,0,11,0.7); }
    }

    /* ESCUDO */
    .shield-wrap {
      width: 90px;
      height: 90px;
      margin: 0 auto 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: float 3s ease-in-out infinite;
    }

    .shield-wrap img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      filter: drop-shadow(0 6px 20px rgba(227,0,11,0.5));
    }

    @keyframes float {
      0%,100% { transform: translateY(0); }
      50%      { transform: translateY(-8px); }
    }

    /* GRID DE JUGADORES */
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 18px;
      width: 100%;
      max-width: 1100px;
    }

    /* CARD JUGADOR */
    .card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 22px;
      padding: 22px 22px 18px;
      display: flex;
      align-items: center;
      gap: 18px;
      position: relative;
      box-shadow: 0 16px 50px rgba(0,0,0,0.5);
      animation: slideUp 0.5s cubic-bezier(.34,1.56,.64,1) both;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 22px 64px rgba(0,0,0,0.65);
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(30px) scale(0.93); }
      to   { opacity: 1; transform: translateY(0)    scale(1); }
    }

    /* Número dorsal */
    .dorsal {
      font-family: 'Press Start 2P', monospace;
      font-size: 0.85rem;
      color: var(--red);
      min-width: 28px;
      text-align: center;
    }

    /* Foto jugador */
    .player-img {
      width: 62px;
      height: 62px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid rgba(227,0,11,0.5);
      flex-shrink: 0;
      background: rgba(255,255,255,0.04);
    }

    /* Info */
    .info { flex: 1; min-width: 0; }

    .player-name {
      font-size: 1rem;
      font-weight: 900;
      text-transform: capitalize;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 4px;
    }

    .meta {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      align-items: center;
    }

    .badge {
      display: inline-block;
      padding: 3px 12px;
      border-radius: 20px;
      font-size: 0.68rem;
      font-weight: 800;
      letter-spacing: 1px;
      text-transform: uppercase;
      border: 1px solid rgba(255,255,255,0.12);
    }

    /* Posición → color */
    .pos-Goalkeeper { background: #e3a000; color: #111; }
    .pos-Defender   { background: #3b4cca; color: #fff; }
    .pos-Midfielder { background: #2a9d5e; color: #fff; }
    .pos-Attacker   { background: var(--red); color: #fff; }

    .badge-age {
      background: rgba(255,255,255,0.07);
      color: var(--muted);
    }

    /* Nacionalidad */
    .nationality {
      font-size: 0.72rem;
      color: var(--muted);
      font-weight: 700;
      margin-top: 4px;
    }

    /* Sección por posición */
    .section-title {
      width: 100%;
      max-width: 1100px;
      font-family: 'Press Start 2P', monospace;
      font-size: 0.6rem;
      color: var(--muted);
      letter-spacing: 3px;
      text-transform: uppercase;
      margin: 32px 0 14px;
      padding-left: 4px;
      border-left: 3px solid var(--red);
      padding-left: 12px;
    }

    /* Error */
    .error-card {
      background: var(--card);
      border: 1px solid rgba(227,0,11,0.4);
      border-radius: 22px;
      padding: 32px;
      max-width: 500px;
      text-align: center;
    }

    .error-card h2 {
      font-family: 'Press Start 2P', monospace;
      font-size: 0.75rem;
      color: var(--red);
      margin-bottom: 14px;
    }

    .error-card p {
      color: var(--muted);
      font-size: 0.85rem;
      line-height: 1.6;
    }

    .error-card code {
      display: block;
      margin-top: 16px;
      background: rgba(255,255,255,0.05);
      border-radius: 10px;
      padding: 12px;
      font-size: 0.75rem;
      color: #ffcb05;
      word-break: break-all;
    }

    /* Btn recargar */
    .btn-reload {
      display: inline-block;
      margin-top: 20px;
      padding: 14px 28px;
      background: linear-gradient(135deg, var(--red), #9b0008);
      color: #fff;
      border: none;
      border-radius: 50px;
      font-family: 'Press Start 2P', monospace;
      font-size: 0.55rem;
      letter-spacing: 2px;
      cursor: pointer;
      text-decoration: none;
      box-shadow: 0 6px 24px rgba(227,0,11,0.4);
      transition: transform 0.15s, box-shadow 0.15s;
    }

    .btn-reload:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 32px rgba(227,0,11,0.6);
    }
  </style>
</head>
<body>

<?php
  // ──────────────────────────────────────────
  //  CONFIGURACIÓN
  //  Pon aquí tu API key de api-sports.io
  //  Regístrate gratis en: https://dashboard.api-sports.io
  // ──────────────────────────────────────────
  $API_KEY  = '88127ba7cb4e86e26d93384c746770f2';   // ← Reemplaza con tu key real
  $TEAM_ID  = 536;                   // ID del Sevilla FC en API-Football

  $url = "https://v3.football.api-sports.io/players/squads?team={$TEAM_ID}";

  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
      "x-apisports-key: {$API_KEY}",
    ],
    CURLOPT_TIMEOUT        => 10,
  ]);
  $response = curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $curlError = curl_error($ch);
  curl_close($ch);

  $data    = json_decode($response, true);
  $players = $data['response'][0]['players'] ?? [];

  // Agrupar por posición
  $grupos = [
    'Goalkeeper' => [],
    'Defender'   => [],
    'Midfielder' => [],
    'Attacker'   => [],
  ];

  foreach ($players as $p) {
    $pos = $p['position'] ?? 'Attacker';
    if (isset($grupos[$pos])) {
      $grupos[$pos][] = $p;
    } else {
      $grupos['Attacker'][] = $p;
    }
  }

  $etiquetas = [
    'Goalkeeper' => '🧤 Porteros',
    'Defender'   => '🛡️ Defensas',
    'Midfielder' => '⚙️ Centrocampistas',
    'Attacker'   => '⚡ Delanteros',
  ];
?>

  <h1>SEVILLA FC</h1>
  <p class="subtitle">PLANTILLA 2025 / 2026</p>

  <div class="shield-wrap">
    <img
      src="https://media.api-sports.io/football/teams/536.png"
      alt="Escudo Sevilla FC"
      onerror="this.src='https://upload.wikimedia.org/wikipedia/en/thumb/3/3e/Sevilla_FC_logo.svg/200px-Sevilla_FC_logo.svg.png'"
    >
  </div>

<?php if (empty($players)): ?>

  <div class="error-card">
    <h2>⚠ Sin datos</h2>
    <p>
      No se pudo obtener la plantilla. Asegúrate de haber configurado tu API key.<br><br>
      <?php if ($curlError): ?>
        Error de conexión: <strong><?= htmlspecialchars($curlError) ?></strong><br><br>
      <?php elseif ($httpCode !== 200): ?>
        Código HTTP: <strong><?= $httpCode ?></strong><br><br>
      <?php endif; ?>
      Regístrate gratis en <strong>dashboard.api-sports.io</strong>, copia tu key y reemplaza
      <code>$API_KEY = 'TU_API_KEY_AQUI';</code>
      en la línea 7 de este archivo.
    </p>
    <a href="?" class="btn-reload">▶ Reintentar</a>
  </div>

<?php else: ?>

  <?php foreach ($grupos as $pos => $lista): ?>
    <?php if (empty($lista)) continue; ?>

    <div class="section-title"><?= $etiquetas[$pos] ?></div>

    <div class="grid">
      <?php foreach ($lista as $p): ?>
        <?php
          $nombre  = $p['name']        ?? 'Desconocido';
          $edad    = $p['age']         ?? '?';
          $numero  = $p['number']      ? (int)$p['number'] : '—';
          $foto    = $p['photo']       ?? '';
          $nac     = $p['nationality'] ?? '';
        ?>
        <div class="card">

          <span class="dorsal"><?= $numero ?></span>

          <img
            class="player-img"
            src="<?= htmlspecialchars($foto) ?>"
            alt="<?= htmlspecialchars($nombre) ?>"
            onerror="this.src='data:image/svg+xml,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'62\' height=\'62\' viewBox=\'0 0 62 62\'><circle cx=\'31\' cy=\'31\' r=\'31\' fill=\'%231a1a2e\'/><text x=\'31\' y=\'37\' font-size=\'24\' text-anchor=\'middle\' fill=\'%238892b0\'>?</text></svg>'"
          >

          <div class="info">
            <div class="player-name"><?= htmlspecialchars($nombre) ?></div>
            <div class="meta">
              <span class="badge pos-<?= $pos ?>"><?= $pos ?></span>
              <span class="badge badge-age"><?= $edad ?> años</span>
            </div>
            <?php if ($nac): ?>
              <div class="nationality">🌍 <?= htmlspecialchars($nac) ?></div>
            <?php endif; ?>
          </div>

        </div>
      <?php endforeach; ?>
    </div>

  <?php endforeach; ?>

  <a href="?" class="btn-reload" style="margin-top:40px;">▶ Actualizar plantilla</a>

<?php endif; ?>

</body>
</html>
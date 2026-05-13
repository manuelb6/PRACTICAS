<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokémon Aleatorio</title>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Nunito:wght@600;800;900&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg:       #0f0f1a;
      --card:     #1a1a2e;
      --border:   rgba(255,255,255,0.08);
      --yellow:   #ffcb05;
      --red:      #e3000b;
      --text:     #f0f0f0;
      --muted:    #8892b0;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: var(--bg);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-family: 'Nunito', sans-serif;
      color: var(--text);
      padding: 20px;
    }

    /* Fondo animado */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background:
        radial-gradient(ellipse at 20% 30%, rgba(227,0,11,0.10) 0%, transparent 55%),
        radial-gradient(ellipse at 80% 70%, rgba(59,76,202,0.12) 0%, transparent 55%);
      pointer-events: none;
    }

    /* TÍTULO */
    h1 {
      font-family: 'Press Start 2P', monospace;
      font-size: clamp(0.9rem, 3vw, 1.4rem);
      color: var(--yellow);
      text-shadow: 3px 3px 0 #c9a000, 0 0 40px rgba(255,203,5,0.5);
      margin-bottom: 32px;
      text-align: center;
      animation: glow 2.5s ease-in-out infinite alternate;
    }

    @keyframes glow {
      from { text-shadow: 3px 3px 0 #c9a000, 0 0 20px rgba(255,203,5,0.3); }
      to   { text-shadow: 3px 3px 0 #c9a000, 0 0 60px rgba(255,203,5,0.7); }
    }

    /* CARD */
    .card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 28px;
      padding: 36px 32px 28px;
      width: 100%;
      max-width: 340px;
      text-align: center;
      position: relative;
      box-shadow: 0 24px 80px rgba(0,0,0,0.6);
      animation: slideUp 0.5s cubic-bezier(.34,1.56,.64,1) both;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(40px) scale(0.92); }
      to   { opacity: 1; transform: translateY(0)   scale(1); }
    }

    /* Nº del Pokémon */
    .poke-number {
      font-family: 'Press Start 2P', monospace;
      font-size: 0.55rem;
      color: var(--muted);
      margin-bottom: 6px;
      letter-spacing: 2px;
    }

    /* Nombre */
    .poke-name {
      font-size: 2rem;
      font-weight: 900;
      text-transform: capitalize;
      letter-spacing: 1px;
      margin-bottom: 4px;
    }

    /* Badge shiny */
    .shiny-badge {
      display: inline-block;
      background: linear-gradient(135deg, #f6d365, #fda085);
      color: #111;
      font-size: 0.7rem;
      font-weight: 800;
      padding: 3px 12px;
      border-radius: 20px;
      margin-bottom: 16px;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .normal-badge {
      display: inline-block;
      background: rgba(255,255,255,0.08);
      color: var(--muted);
      font-size: 0.7rem;
      font-weight: 800;
      padding: 3px 12px;
      border-radius: 20px;
      margin-bottom: 16px;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    /* Imagen */
    .poke-img-wrap {
      position: relative;
      width: 160px;
      height: 160px;
      margin: 0 auto 24px;
    }

    /* Sombra bajo el sprite */
    .poke-img-wrap::after {
      content: '';
      position: absolute;
      bottom: -6px; left: 50%;
      transform: translateX(-50%);
      width: 80px; height: 12px;
      background: radial-gradient(ellipse, rgba(0,0,0,0.5) 0%, transparent 70%);
    }

    .poke-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      image-rendering: pixelated;
      filter: drop-shadow(0 6px 16px rgba(0,0,0,0.5));
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%,100% { transform: translateY(0); }
      50%      { transform: translateY(-10px); }
    }

    /* Tipo */
    .type-badge {
      display: inline-block;
      padding: 4px 16px;
      border-radius: 20px;
      font-size: 0.78rem;
      font-weight: 800;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 24px;
      border: 1px solid rgba(255,255,255,0.15);
    }

    /* Stats */
    .stats {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-bottom: 28px;
    }

    .stat {
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 12px 10px;
    }

    .stat .label {
      font-size: 0.68rem;
      font-weight: 700;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 4px;
    }

    .stat .value {
      font-size: 1.1rem;
      font-weight: 900;
    }

    /* Botón */
    .btn-siguiente {
      display: block;
      width: 100%;
      padding: 16px;
      background: linear-gradient(135deg, var(--red), #9b0008);
      color: #fff;
      border: none;
      border-radius: 50px;
      font-family: 'Press Start 2P', monospace;
      font-size: 0.65rem;
      letter-spacing: 2px;
      cursor: pointer;
      box-shadow: 0 6px 24px rgba(227,0,11,0.4);
      transition: transform 0.15s, box-shadow 0.15s;
      text-decoration: none;
    }

    .btn-siguiente:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 32px rgba(227,0,11,0.6);
    }

    .btn-siguiente:active { transform: scale(0.97); }

    /* Tipos → colores */
    .t-normal   { background:#A8A878; color:#111; }
    .t-fire     { background:#F08030; color:#111; }
    .t-water    { background:#6890F0; color:#fff; }
    .t-electric { background:#F8D030; color:#111; }
    .t-grass    { background:#78C850; color:#111; }
    .t-ice      { background:#98D8D8; color:#111; }
    .t-fighting { background:#C03028; color:#fff; }
    .t-poison   { background:#A040A0; color:#fff; }
    .t-ground   { background:#E0C068; color:#111; }
    .t-flying   { background:#A890F0; color:#fff; }
    .t-psychic  { background:#F85888; color:#fff; }
    .t-bug      { background:#A8B820; color:#111; }
    .t-rock     { background:#B8A038; color:#fff; }
    .t-ghost    { background:#705898; color:#fff; }
    .t-dragon   { background:#7038F8; color:#fff; }
    .t-dark     { background:#705848; color:#fff; }
    .t-steel    { background:#B8B8D0; color:#111; }
    .t-fairy    { background:#EE99AC; color:#111; }
  </style>
</head>
<body>

  <h1>POKEMON</h1>

  <?php
    $id    = rand(1, 1025);
    $shiny = rand(1, 15) === 1;

    $url     = "https://pokeapi.co/api/v2/pokemon/" . $id;
    $openUrl = curl_init($url);
    curl_setopt($openUrl, CURLOPT_RETURNTRANSFER, true);
    $respuesta = curl_exec($openUrl);
    curl_close($openUrl);

    $datos = json_decode($respuesta, true);

    $nombre = $datos['name'];
    $altura = $datos['height'] / 10;   // en metros
    $peso   = $datos['weight'] / 10;   // en kg
    $tipo   = $datos['types'][0]['type']['name'];
    $img    = $shiny
              ? $datos['sprites']['front_shiny']
              : $datos['sprites']['front_default'];
  ?>

  <div class="card">

    <div class="poke-number">#<?= str_pad($id, 4, '0', STR_PAD_LEFT) ?></div>

    <div class="poke-name"><?= htmlspecialchars($nombre) ?></div>

    <?php if ($shiny): ?>
      <div class="shiny-badge">✨ ¡Es Shiny!</div>
    <?php else: ?>
      <div class="normal-badge">Normal</div>
    <?php endif; ?>

    <div class="poke-img-wrap">
      <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($nombre) ?>">
    </div>

    <span class="type-badge t-<?= $tipo ?>"><?= $tipo ?></span>

    <div class="stats">
      <div class="stat">
        <div class="label">Altura</div>
        <div class="value"><?= $altura ?> m</div>
      </div>
      <div class="stat">
        <div class="label">Peso</div>
        <div class="value"><?= $peso ?> kg</div>
      </div>
    </div>

    <a href="?" class="btn-siguiente">▶ Siguiente</a>

  </div>

  <script src="Pokedex.js"></script>
</body>
</html>
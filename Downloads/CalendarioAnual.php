<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Anual</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
</head>

<style>
    /* ===== VARIABLES DE COLOR ===== */
    :root {
        --color-fondo:       #f0f4f8;
        --color-tarjeta:     #ffffff;
        --color-titulo-mes:  #1a1a2e;
        --color-acento:      #e63946;
        --color-hoy-borde:   #2a9d8f;
        --color-hoy-texto:   #2a9d8f;
        --color-domingo:     #e63946;
        --color-cumple-bg:   #ffd166;
        --color-rosa-bg:     rgba(255, 105, 180, 0.75);
        --color-bisiesto-bg: #fb8500;
        --color-festivo-bg:  #c77dff;
        --sombra:            0 4px 15px rgba(0,0,0,0.08);
    }

    /* ===== ESTILOS GENERALES ===== */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: var(--color-fondo);
        font-family: 'DM Sans', sans-serif;
        padding: 30px 20px;
        min-height: 100vh;
    }

    h1 {
        font-family: 'Playfair Display', serif;
        text-align: center;
        font-size: 2.2rem;
        color: var(--color-titulo-mes);
        margin-bottom: 30px;
        letter-spacing: 1px;
    }

    /* ===== FORMULARIO ===== */
    .formulario {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        margin-bottom: 35px;
        flex-wrap: wrap;
    }

    .formulario label {
        font-size: 1rem;
        font-weight: 500;
        color: #333;
    }

    .formulario input[type="number"] {
        padding: 10px 15px;
        font-size: 1rem;
        border: 2px solid #ccc;
        border-radius: 8px;
        width: 120px;
        transition: border-color 0.3s;
        font-family: 'DM Sans', sans-serif;
    }

    .formulario input[type="number"]:focus {
        outline: none;
        border-color: var(--color-hoy-borde);
    }

    .formulario button {
        padding: 10px 25px;
        font-size: 1rem;
        font-family: 'DM Sans', sans-serif;
        font-weight: 500;
        background-color: var(--color-titulo-mes);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.1s;
    }

    .formulario button:hover {
        background-color: #2d2d4e;
        transform: translateY(-1px);
    }

    /* ===== MENSAJE DE ERROR ===== */
    .error {
        text-align: center;
        color: var(--color-acento);
        font-weight: 500;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    /* ===== LEYENDA ===== */
    .leyenda {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-bottom: 30px;
    }

    .leyenda-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        color: #444;
    }

    .leyenda-cuadro {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        display: inline-block;
    }

    /* ===== CONTENEDOR DE MESES ===== */
    .contenedor-calendario {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
    }

    /* ===== TARJETA DE MES ===== */
    .tarjeta-mes {
        background-color: var(--color-tarjeta);
        border-radius: 14px;
        box-shadow: var(--sombra);
        overflow: hidden;
        /* Ancho fijo para que los 12 meses sean consistentes */
        width: 310px;
    }

    /* ===== TABLA DEL MES ===== */
    table {
        border-collapse: collapse;
        width: 100%;
    }

    .mes-titulo {
        background-color: var(--color-titulo-mes);
        color: white;
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 14px 0;
        text-align: center;
    }

    th {
        /* Cabecera de días de la semana */
        width: 44px;
        height: 36px;
        text-align: center;
        font-size: 0.8rem;
        font-weight: 500;
        color: #888;
        border-bottom: 1px solid #eee;
    }

    td {
        width: 44px;
        height: 44px;
        text-align: center;
        font-size: 0.95rem;
        border-radius: 0;
        transition: background-color 0.2s;
        cursor: default;
    }

    td:hover:not(:empty) {
        filter: brightness(0.92);
    }

    /* ===== CLASES DE DÍAS ===== */

    /* Domingo en rojo */
    .domingo {
        color: var(--color-domingo);
        font-weight: 500;
    }

    /* Día de hoy con borde */
    .hoy {
        border: 2px solid var(--color-hoy-borde);
        color: var(--color-hoy-texto);
        font-weight: 700;
        border-radius: 50%;
    }

    /* Cumpleaños con fondo amarillo */
    .cumple {
        background-color: var(--color-cumple-bg);
        font-weight: 700;
        border-radius: 50%;
    }

    /* Rango de vacaciones en rosa */
    .rango-rosa {
        background-color: var(--color-rosa-bg);
        color: white;
        font-weight: 700;
    }

    /* Día bisiesto en naranja */
    .dia-bisiesto {
        background-color: var(--color-bisiesto-bg);
        color: white;
        font-weight: 700;
        border-radius: 50%;
    }

    /* Festivo nacional en morado */
    .festivo {
        background-color: var(--color-festivo-bg);
        color: white;
        font-weight: 700;
        border-radius: 50%;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 680px) {
        h1 { font-size: 1.5rem; }
        .tarjeta-mes { width: 100%; }
        td, th { width: 13%; }
    }
</style>

<body>

    <h1>📅 Calendario Anual</h1>

    <!-- ===== FORMULARIO ===== -->
    <form method="post" class="formulario">
        <label for="year">Introduce un año:</label>
        <!-- min y max dan una validación básica en el navegador -->
        <input type="number" name="year" id="year" min="1900" max="2100"
               value="<?= isset($_POST['year']) ? (int)$_POST['year'] : '' ?>">
        <button type="submit">Ver calendario</button>
    </form>

<?php

/* ============================================================
   FUNCIÓN: obtenerFestivosPorMes()
   Devuelve un array con los días festivos nacionales de España
   para el año recibido. La clave es "mes-dia" y el valor es
   el nombre del festivo.
   ============================================================ */
function obtenerFestivosPorMes(int $year): array {
    $festivos = [];

    // Festivos fijos (siempre en la misma fecha)
    $festivosFijos = [
        "1-1"   => "Año Nuevo",
        "1-6"   => "Reyes Magos",
        "5-1"   => "Día del Trabajo",
        "8-15"  => "Asunción de la Virgen",
        "10-12" => "Fiesta Nacional de España",
        "11-1"  => "Todos los Santos",
        "12-6"  => "Día de la Constitución",
        "12-8"  => "Inmaculada Concepción",
        "12-25" => "Navidad",
    ];

    foreach ($festivosFijos as $clave => $nombre) {
        $festivos[$clave] = $nombre;
    }

    // Festivos móviles: Semana Santa (dependen del año)
    // Calculamos el Domingo de Pascua con el algoritmo de Butcher
    $a = $year % 19;
    $b = intdiv($year, 100);
    $c = $year % 100;
    $d = intdiv($b, 4);
    $e = $b % 4;
    $f = intdiv($b + 8, 25);
    $g = intdiv($b - $f + 1, 3);
    $h = (19 * $a + $b - $d - $g + 15) % 30;
    $i = intdiv($c, 4);
    $k = $c % 4;
    $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
    $m = intdiv($a + 11 * $h + 22 * $l, 451);
    $mesPascua  = intdiv($h + $l - 7 * $m + 114, 31);
    $diaPascua  = (($h + $l - 7 * $m + 114) % 31) + 1;

    // Timestamp del Domingo de Pascua
    $pascua = mktime(0, 0, 0, $mesPascua, $diaPascua, $year);

    // Viernes Santo = 2 días antes de Pascua
    $viernesSanto = $pascua - (2 * 86400);
    $festivos[date("n", $viernesSanto) . "-" . date("j", $viernesSanto)] = "Viernes Santo";

    return $festivos;
}


/* ============================================================
   FUNCIÓN: obtenerClaseDia()
   Decide qué clase CSS debe tener un día según su prioridad:
     1. Cumpleaños
     2. Festivo nacional
     3. Rango vacaciones (rosa)
     4. Día bisiesto (29 feb)
     5. Hoy
     6. Domingo
     7. Sin clase
   ============================================================ */
function obtenerClaseDia(
    int $mes,
    int $dia,
    int $diaActual,   // 1=Lunes ... 7=Domingo
    int $year,
    int $fechaTs,     // timestamp del día actual
    array $festivos   // array de festivos del año
): string {

    // 1. Cumpleaños (ejemplo: 30 de agosto)
    if ($mes == 8 && $dia == 30) {
        return "cumple";
    }

    // 2. Festivo nacional
    $clave = "$mes-$dia";
    if (isset($festivos[$clave])) {
        return "festivo";
    }

    // 3. Rango de vacaciones de Semana Santa 2026
    $inicioVacas = mktime(0, 0, 0, 3, 29, 2026);
    $finVacas    = mktime(0, 0, 0, 4, 5,  2026);
    if ($fechaTs >= $inicioVacas && $fechaTs <= $finVacas) {
        return "rango-rosa";
    }

    // 4. 29 de febrero (año bisiesto)
    if ($mes == 2 && $dia == 29) {
        return "dia-bisiesto";
    }

    // 5. Día de hoy
    if ($year == (int)date('Y') && $mes == (int)date('m') && $dia == (int)date('d')) {
        return "hoy";
    }

    // 6. Domingo (día de la semana = 7)
    if ($diaActual == 7) {
        return "domingo";
    }

    // 7. Sin clase especial
    return "";
}


/* ============================================================
   BLOQUE PRINCIPAL
   Solo se ejecuta si se ha enviado el formulario (POST).
   ============================================================ */
if (isset($_POST["year"])) {

    // Convertimos a entero para evitar valores extraños
    $year = (int)$_POST["year"];

    // ── Validación del año ──
    if ($year < 1900 || $year > 2100) {
        echo "<p class='error'>⚠️ Por favor, introduce un año entre 1900 y 2100.</p>";
    } else {

        // Obtenemos los festivos del año de una vez
        $festivos = obtenerFestivosPorMes($year);

        // Nombres de los meses en español
        $meses = [
            "Enero", "Febrero", "Marzo", "Abril",
            "Mayo", "Junio", "Julio", "Agosto",
            "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];

        // Abreviaturas de los días de la semana (L = lunes ... D = domingo)
        $diasSemana = ["L", "M", "X", "J", "V", "S", "D"];

        // ── Leyenda ──
        echo "<div class='leyenda'>";
        echo "  <span class='leyenda-item'><span class='leyenda-cuadro' style='background:#ffd166'></span> Cumpleaños</span>";
        echo "  <span class='leyenda-item'><span class='leyenda-cuadro' style='background:#c77dff'></span> Festivo nacional</span>";
        echo "  <span class='leyenda-item'><span class='leyenda-cuadro' style='background:rgba(255,105,180,0.75)'></span> Vacaciones</span>";
        echo "  <span class='leyenda-item'><span class='leyenda-cuadro' style='background:#fb8500'></span> 29 Feb (bisiesto)</span>";
        echo "  <span class='leyenda-item'><span class='leyenda-cuadro' style='border:2px solid #2a9d8f; background:white'></span> Hoy</span>";
        echo "  <span class='leyenda-item'><span class='leyenda-cuadro' style='background:#e63946'></span> Domingo</span>";
        echo "</div>";

        // ── Bucle principal: 12 meses ──
        echo "<div class='contenedor-calendario'>";

        for ($mes = 1; $mes <= 12; $mes++) {

            // ── Datos del mes ──
            // Día de la semana del día 1 (1=Lunes, 7=Domingo)
            $primerDia = (int)date("N", mktime(0, 0, 0, $mes, 1, $year));
            // Número total de días del mes
            $totalDias = (int)date("t", mktime(0, 0, 0, $mes, 1, $year));

            // ── Tarjeta del mes ──
            echo "<div class='tarjeta-mes'>";
            echo "  <table>";

            // Fila: nombre del mes
            echo "  <tr><th colspan='7' class='mes-titulo'>" . $meses[$mes - 1] . " $year</th></tr>";

            // Fila: cabecera de días de la semana
            echo "  <tr>";
            foreach ($diasSemana as $nombreDia) {
                echo "<th>$nombreDia</th>";
            }
            echo "  </tr>";

            // ── Primera fila de números ──
            echo "  <tr>";

            // Celdas vacías antes del primer día
            for ($i = 1; $i < $primerDia; $i++) {
                echo "<td></td>";
            }

            // Variable que rastrea la columna actual (1=Lun ... 7=Dom)
            $columna = $primerDia;

            for ($dia = 1; $dia <= $totalDias; $dia++) {

                // Si superamos el domingo, comenzamos una nueva fila
                if ($columna > 7) {
                    echo "</tr><tr>";
                    $columna = 1;
                }

                // Timestamp del día que estamos pintando
                $fechaTs = mktime(0, 0, 0, $mes, $dia, $year);

                // Obtenemos la clase CSS usando la función de arriba
                $clase = obtenerClaseDia($mes, $dia, $columna, $year, $fechaTs, $festivos);

                // Si el día tiene nombre de festivo, lo añadimos como tooltip (title)
                $claveDia = "$mes-$dia";
                $tooltip  = isset($festivos[$claveDia]) ? " title='" . $festivos[$claveDia] . "'" : "";

                // Pintamos la celda con la clase (si hay) y el tooltip (si hay)
                if ($clase !== "") {
                    echo "<td class='$clase'$tooltip>$dia</td>";
                } else {
                    echo "<td$tooltip>$dia</td>";
                }

                $columna++;
            }

            // Celdas vacías al final de la última fila
            while ($columna <= 7) {
                echo "<td></td>";
                $columna++;
            }

            echo "  </tr>";
            echo "  </table>";
            echo "</div>"; // .tarjeta-mes
        }

        echo "</div>"; // .contenedor-calendario
    }
}
?>

</body>
</html>

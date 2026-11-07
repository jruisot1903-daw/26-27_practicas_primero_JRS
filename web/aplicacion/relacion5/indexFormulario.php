<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");

/**
 * Cada elemento es un array de dos posiciones asociativas
 * TEXTO : texto a mostrar en el elemento
 * LINK: Enlace a la pagina
 */

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 5 - Formulario",
        "LINK" => ""
    ]
];

//controlador

// Inicializamos los arrays que vamos a utilizar
$errores = [];

$valores = [
    'nombre' => '',
    'password' => '',
    'fecha_nac' => '',
    'dia_carnet' => '',
    'mes_carnet' => '',
    'ano_carnet' => '',
    'hora' => '',
    'estado' => '',
    'estudios' => [],
    'hermanos' => 0,
    'sueldo' => 1100
];

$estudios_validos = [
    0 => 'Sin estudios',
    1 => 'Primaria',
    2 => 'Secundaria',
    3 => 'Bachillerato',
    4 => 'Ciclo formativo',
    5 => 'Universitarios'
];

$estados_validos = [
    1 => 'Estudiante',
    2 => 'En paro',
    3 => 'Trabajando',
    4 => 'Jubilado'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recoger datos del POST
    $valores['nombre'] = trim($_POST['nombre'] ?? '');
    $valores['password'] = $_POST['password'] ?? '';
    $valores['fecha_nac'] = trim($_POST['fecha_nac'] ?? '');

    $valores['dia_carnet'] = $_POST['dia_carnet'] ?? '';
    $valores['mes_carnet'] = $_POST['mes_carnet'] ?? '';
    $valores['ano_carnet'] = $_POST['ano_carnet'] ?? '';

    $valores['hora'] = trim($_POST['hora'] ?? '');
    $valores['estado'] = $_POST['estado'] ?? '';

    $valores['estudios'] = $_POST['estudios'] ?? [];

    // ==========================================
    // NOMBRE
    // ==========================================

    if ($valores['nombre'] === '' || strtoupper($valores['nombre'][0]) === 'H') {

        $errores['nombre'] = 'El nombre no puede estar vacío ni empezar por H.';

    } elseif (!validaCadena($valores['nombre'], 25, '')) {

        $errores['nombre'] = 'El nombre supera 25 caracteres.';

    } else {

        $valores['nombre'] = strtoupper($valores['nombre']);
    }

    // ==========================================
    // CONTRASEÑA
    // ==========================================

    if (!validaCadena($valores['password'], 15, '')) {

        $errores['password'] = 'Contraseña demasiado larga.';

    } elseif (!validaExpresion(
        $valores['password'],
        '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\$_\-;<>@]).{8,}$/',
        ''
    )) {

        $errores['password'] = 'Debe tener mínimo 8 caracteres, mayúscula, minúscula, número y carácter especial.';
    }

    // ==========================================
    // FECHA DE NACIMIENTO
    // ==========================================

    if (!validaFecha($valores['fecha_nac'], '')) {

        $errores['fecha_nac'] = 'Fecha de nacimiento no válida.';

    } else {

        $fecha_nac = DateTime::createFromFormat('!d/m/Y', $valores['fecha_nac']);
    }

    // ==========================================
    // FECHA DE CARNET
    // ==========================================

    $dia = filter_var($valores['dia_carnet'], FILTER_VALIDATE_INT);
    $mes = filter_var($valores['mes_carnet'], FILTER_VALIDATE_INT);
    $ano = filter_var($valores['ano_carnet'], FILTER_VALIDATE_INT);

    if ($dia === false || $mes === false || $ano === false ||
        !checkdate((int)$mes, (int)$dia, (int)$ano)) {

        $errores['fecha_carnet'] = 'Fecha de carnet inválida.';

    } elseif (empty($errores['fecha_nac'])) {

        $fecha_carnet = DateTime::createFromFormat(
            '!d/m/Y',
            sprintf('%02d/%02d/%04d', $dia, $mes, $ano)
        );

        $mayor_edad = clone $fecha_nac;
        $mayor_edad->add(new DateInterval('P18Y'));

        if ($fecha_carnet < $mayor_edad) {

            $errores['fecha_carnet'] = 'Debe ser mayor de edad para tener carnet de conducir.';

        }
    }

    // ==========================================
    // HORA
    // ==========================================

    if (!validaHora($valores['hora'], '00:00:00')) {

        $errores['hora'] = 'Hora inválida (HH:MM:SS).';
    }

    // ==========================================
    // ESTADO
    // ==========================================

    $estado = filter_var($valores['estado'], FILTER_VALIDATE_INT);

    if ($estado === false || !validaRango((int)$estado, $estados_validos, 2)) {

        $errores['estado'] = 'Debe seleccionar un estado válido.';

    } else {

        $valores['estado'] = (int)$estado;
    }

    // ==========================================
    // ESTUDIOS
    // ==========================================

    if (!is_array($valores['estudios'])) {

        $valores['estudios'] = [];
        $errores['estudios'] = 'Opciones de estudios inválidas.';

    } elseif (empty($valores['estudios'])) {

        $errores['estudios'] = 'Debe seleccionar al menos un estudio.';

    } else {

        foreach ($valores['estudios'] as $estudio) {

            $estudio = filter_var($estudio, FILTER_VALIDATE_INT);

            if ($estudio === false || !validaRango((int)$estudio, $estudios_validos, 1)) {

                $errores['estudios'] = 'Opción inválida.';

            }
        }

        if (in_array('0', $valores['estudios']) && count($valores['estudios']) > 1) {

            $errores['estudios'] = 'Si marca Sin estudios, no puede marcar más.';
            $valores['estudios'] = ['0'];

        }
    }

    // ==========================================
    // HERMANOS
    // ==========================================

    $hermanos = filter_var($_POST['hermanos'] ?? '', FILTER_VALIDATE_INT);

    if ($hermanos === false) {

        $valores['hermanos'] = 0;
        $errores['hermanos'] = 'Debe introducir un número entero entre 0 y 20.';

    } else {

        $valores['hermanos'] = (int)$hermanos;

        if (!validaEntero($valores['hermanos'], 0, 20, 0)) {

            $errores['hermanos'] = 'Debe estar entre 0 y 20.';
        }
    }

    // ==========================================
    // SUELDO
    // ==========================================

    $sueldo = filter_var($_POST['sueldo'] ?? '', FILTER_VALIDATE_FLOAT);

    if ($sueldo === false) {

        $valores['sueldo'] = 1100;
        $errores['sueldo'] = 'Debe introducir un número válido.';

    } else {

        $valores['sueldo'] = (float)$sueldo;

        if (!validaReal($valores['sueldo'], 1000, 150000, 1100)) {

            $errores['sueldo'] = 'Debe estar entre 1000 y 150000 €.';
        }
    }
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Relacion 5 ", $barraUbi);
cuerpo($valores, $errores, $estados_validos, $estudios_validos); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo($valores, $errores, $estados_validos, $estudios_validos)
{
     // Comprobamos si tenemos errores o si todavía no hemos enviado el formulario

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !empty($errores)) {

        mostrarFormulario($valores, $errores);

    } else {

        // Si todo está correcto mostramos el resumen

        echo "<h3>Datos introducidos correctamente " . htmlspecialchars($valores['nombre']) . ":</h3>";

        echo "<ul>";

        echo "<li><b>Nombre:</b> " . htmlspecialchars($valores['nombre']) . "</li>";

        echo "<li><b>Fecha nacimiento:</b> " . htmlspecialchars($valores['fecha_nac']) . "</li>";

        echo "<li><b>Fecha carnet:</b> " .
            htmlspecialchars(sprintf(
                '%02d/%02d/%04d',
                $valores['dia_carnet'],
                $valores['mes_carnet'],
                $valores['ano_carnet']
            )) . "</li>";

        echo "<li><b>Hora de levantarse:</b> " . htmlspecialchars($valores['hora']) . "</li>";

        echo "<li><b>Estado:</b> " . htmlspecialchars($estados_validos[$valores['estado']]) . "</li>";

        $estudios_mostrados = [];

        foreach ($valores['estudios'] as $codigo) {

            if (isset($estudios_validos[$codigo])) {

                $estudios_mostrados[] = $estudios_validos[$codigo];

            }
        }

        echo "<li><b>Estudios:</b> " . htmlspecialchars(implode(", ", $estudios_mostrados)) . "</li>";

        echo "<li><b>Hermanos:</b> " . $valores['hermanos'] . "</li>";

        echo "<li><b>Sueldo:</b> " . $valores['sueldo'] . " €</li>";

        echo "</ul>";
    }
}

// ==========================================
// FUNCIÓN PARA MOSTRAR EL FORMULARIO
// ==========================================

function mostrarFormulario($valores, $errores)
{
?>

    <div class="formulario">

        <form method="post" action="">

            <label>Nombre:</label>
            <input type="text" name="nombre" maxlength="25"
                value="<?= htmlspecialchars($valores['nombre']) ?>">
            <span class="error"><?= htmlspecialchars($errores['nombre'] ?? '') ?></span><br><br>

            <label>Contraseña:</label>
            <input type="password" name="password" maxlength="15">
            <span class="error"><?= htmlspecialchars($errores['password'] ?? '') ?></span><br><br>

            <label>Fecha nacimiento:</label>
            <input type="text" name="fecha_nac" placeholder="dd/mm/yyyy"
                value="<?= htmlspecialchars($valores['fecha_nac']) ?>">
            <span class="error"><?= htmlspecialchars($errores['fecha_nac'] ?? '') ?></span><br><br>

            <label>Fecha carnet:</label>

            Día <input type="number" name="dia_carnet" min="1" max="31"
                value="<?= htmlspecialchars((string)$valores['dia_carnet']) ?>">

            Mes <input type="number" name="mes_carnet" min="1" max="12"
                value="<?= htmlspecialchars((string)$valores['mes_carnet']) ?>">

            Año <input type="number" name="ano_carnet" min="1900" max="<?= date('Y') ?>"
                value="<?= htmlspecialchars((string)$valores['ano_carnet']) ?>">

            <span class="error"><?= htmlspecialchars($errores['fecha_carnet'] ?? '') ?></span><br><br>

            <label>Hora de levantarse:</label>
            <input type="text" name="hora" placeholder="HH:MM:SS"
                value="<?= htmlspecialchars($valores['hora']) ?>">
            <span class="error"><?= htmlspecialchars($errores['hora'] ?? '') ?></span><br><br>

            <label>Estado:</label><br>

            <?php

            $estados = [
                1 => 'Estudiante',
                2 => 'En paro',
                3 => 'Trabajando',
                4 => 'Jubilado',
                5 => 'Incorrecta'
            ];

            foreach ($estados as $k => $v) {

                $checked = ($valores['estado'] == $k) ? 'checked' : '';

                echo "<input type='radio' name='estado' value='$k' $checked> $v<br>";

            }

            ?>

            <span class="error"><?= htmlspecialchars($errores['estado'] ?? '') ?></span><br>

            <label>Estudios:</label><br>

            <?php

            $estudios = [
                0 => 'Sin estudios',
                1 => 'Primaria',
                2 => 'Secundaria',
                3 => 'Bachillerato',
                4 => 'Ciclo formativo',
                5 => 'Universitarios',
                6 => 'Incorrecta'
            ];

            foreach ($estudios as $k => $v) {

                $checked = in_array((string)$k, $valores['estudios']) ? 'checked' : '';

                echo "<input type='checkbox' name='estudios[]' value='$k' $checked> $v<br>";

            }

            ?>

            <span class="error"><?= htmlspecialchars($errores['estudios'] ?? '') ?></span><br>

            <label>Hermanos:</label>
            <input type="number" name="hermanos" min="0" max="20"
                value="<?= htmlspecialchars((string)$valores['hermanos']) ?>">
            <span class="error"><?= htmlspecialchars($errores['hermanos'] ?? '') ?></span><br><br>

            <label>Sueldo (€):</label>
            <input type="number" name="sueldo" step="0.01" min="1000" max="150000"
                value="<?= htmlspecialchars((string)$valores['sueldo']) ?>">
            <span class="error"><?= htmlspecialchars($errores['sueldo'] ?? '') ?></span><br><br>

            <input type="submit" value="Enviar">
            <br>
            <a href="./indexPruebas.php">Mirar Index de pruebas</a>

        </form>

    </div>

<?php

}
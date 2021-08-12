<?php

if (
    isset($_POST['nome']) &&
    isset($_POST['consumoQuilowattsHora']) &&
    isset($_POST['rua']) &&
    isset($_POST['numeroRua'])
) {

    $nome = $_POST["nome"];
    $consumoQuilowattsHora = $_POST["consumoQuilowattsHora"];
    $rua = ucwords(strtolower($_POST["rua"]));
    $numeroRua = $_POST["numeroRua"];

    if ($rua[0] == 'R' && 
        $rua[1] == 'u' &&
        $rua[2] == 'a' &&
        $rua[3] == ' '

        ||

        $rua[0] == 'R' &&
        $rua[1] == '.'

        ) {

            $rua = str_replace('Rua', '', $rua);
            $rua = str_replace('R.', '', $rua);
            $rua = ucwords($rua);



        }


    if ($consumoQuilowattsHora > 120) {
        $colorClass = 'font-red';
        $valor = number_format($consumoQuilowattsHora * 0.42, 2, ',' , '.');
        $economizou = false;
    } else {
        $colorClass = "font-blue";
        $valor = number_format($consumoQuilowattsHora * 0.32, 2, ',' , '.');
        $economizou = true;
    }
    ?>

    <!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link href="styles.css" rel="stylesheet" />
</head>

<body>
    <div id="circle-result-container">
        <h1>Conta de luz de <?= $nome ?>.</h1>
        <p> Rua <?= $rua ?>, <?= $numeroRua ?>.</p>
        <p class="<?= $colorClass ?>">Consumo: <span class="letra-grande"><?= $consumoQuilowattsHora ?>kWh</span>.</p>
        <p>Valor a pagar: R$ <span class="letra-grande-plus"><?= $valor ?></span>.</p>
        <?php
        if ($economizou) {
            echo"Obrigado por economizar!";
        }
        ?>
    </div>
</body>

</html>

<?php
    
} else {

    echo "<h1>Você não enviou as informações corretamente</h1>";
    exit;
}
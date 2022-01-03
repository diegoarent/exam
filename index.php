<?php

require_once './Lottery.php';

$lottery = new Lottery(6, 15);
$lottery->generateGames();
$lottery->generateResult();

?>
<html>
    <head>
        <title>Exame - Loterias</title>

        <style>
            /* basic css style for table and numbers */
            table { border-collapse: collapse; border:5px solid #006699; }
            tr:nth-child(odd) { background:#E7F3FF; }
            td, th { padding:5px; }
            th { border-left:5px solid #006699; }
            .success { background:limegreen; color:black; }
        </style>
    </head>
    <body>
        <h1>Números sorteados</h1>
        <?php echo $lottery->showResult(); ?>

        <h2>Meus Cartões</h2>
        <?php echo $lottery->showCheckedGames(); ?>
    </body>
</html>

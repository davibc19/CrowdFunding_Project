<?php
    require './phplot.php';
    
    // $_GET["id"] -> Permite utilizar o identificador do projeto/doações para plotar o gráfico
    
    $data = array(
        array('Janeiro', 50000),
        array('Fevereiro', 0),
        array('Marco', 20000),
        array('Abril', 30000),
    );

    $plot = new PHPlot();
    $plot->SetDataColors('black');
    $plot->SetLineWidths(5);
    $plot->SetDataValues($data);
    $plot->SetTitle('Grafico dos Valores Doados De Acordo com os Meses');
    $plot->SetXTitle('Tempo');
    $plot->SetYTitle('Valores');
    $plot->DrawGraph();
?>
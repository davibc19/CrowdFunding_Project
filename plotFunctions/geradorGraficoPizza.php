<?php
    require './phplot.php';
    
    // $_GET["id"] -> Permite utilizar o identificador do projeto/doações para plotar o gráfico
    
    $data = array(
        array('Gerente de Projeto', 50000),
        array('Financiador Tecnico', 30000),
        array('Financiador Aluno', 20000),
    );

    $plot = new PHPlot();
    $plot->SetPlotType("pie");
    $plot->SetDataType('text-data-single');
    $plot->SetDataValues($data);
    $plot->SetDataColors(array('red', 'green', 'blue'));
    $plot->SetTitle('Grafico de Doacoes por Financiador');
    
    # Build a legend from our data array.
    # Each call to SetLegend makes one line as "label: value".
    foreach ($data as $row)
      $plot->SetLegend(implode(': R$', $row));
    # Place the legend in the upper left corner:
    $plot->SetLegendPixels(0, 25);
    
    $plot->DrawGraph();
?>
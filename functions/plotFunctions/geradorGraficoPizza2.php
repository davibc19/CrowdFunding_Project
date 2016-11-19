<?php

require './phplot.php';
require '../functionsBd.php';

$totalPesquisa = 0;
$totalCompeticao = 0;
$totalInovacao = 0;
$totalManutencao = 0;
$totalPequenasObras = 0;

$total = 0;

$queryProjeto = consultaTodosProjetos("aprovado");
while ($dadosProjeto = mysql_fetch_array($queryProjeto))
{
    if ($dadosProjeto['categoria'] == "Pesquisa")
        $totalPesquisa += $dadosProjeto['valArrecadado'];
    else if ($dadosProjeto['categoria'] == "Competição Tecnológica")
        $totalCompeticao += $dadosProjeto['valArrecadado'];
    else if ($dadosProjeto['categoria'] == "Inovação no Ensino")
        $totalInovacao += $dadosProjeto['valArrecadado'];
    else if ($dadosProjeto['categoria'] == "Manutenção e Reforma")
        $totalManutencao += $dadosProjeto['valArrecadado'];
    else if ($dadosProjeto['categoria'] == "Pequenas Obras")
        $totalPequenasObras += $dadosProjeto['valArrecadado'];

    $total += $dadosProjeto['valArrecadado'];
}

$data = array(
    array('Pesquisa', $totalPesquisa),
    array('Competicao Tecnologica', $totalCompeticao),
    array('Inovacao no Ensino', $totalInovacao),
    array('Manutencao e Reforma', $totalManutencao),
    array('Pequenas Obras', $totalPequenasObras)
);

$plot = new PHPlot();
$plot->SetDataType('text-data-single');
$plot->SetDataValues($data);
$plot->SetPlotType("pie");
$plot->SetDataColors(array('red', 'green', 'blue', 'yellow', 'black'));
$plot->SetTitle('----------------Grafico de Arrecadamento por Categoria');

# Build a legend from our data array.
# Each call to SetLegend makes one line as "label: value".
foreach ($data as $row)
    $plot->SetLegend(implode(': R$', $row));
# Place the legend in the upper left corner:
$plot->SetLegendPixels(0, 0);

$plot->DrawGraph();
?>
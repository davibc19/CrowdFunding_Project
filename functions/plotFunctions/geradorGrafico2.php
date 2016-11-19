<?php
require 'phplot.php';
require '../functionsBd.php';

function pickcolor($img, $ignore, $row, $col)
{
    return $row;
}

$totalPesquisa = 0;
$totalCompeticao = 0;
$totalInovacao = 0;
$totalManutencao = 0;
$totalPequenasObras = 0;

$total = 0; 

$queryProjeto = consultaTodosProjetos("aprovado");
while ($dadosProjeto = mysql_fetch_array($queryProjeto))
{
    if($dadosProjeto['categoria'] == "Pesquisa")
        $totalPesquisa += $dadosProjeto['valArrecadado'];
    else if($dadosProjeto['categoria'] == "Competição Tecnológica")
        $totalCompeticao += $dadosProjeto['valArrecadado'];
    else if($dadosProjeto['categoria'] == "Inovação no Ensino")
        $totalInovacao += $dadosProjeto['valArrecadado'];
    else if($dadosProjeto['categoria'] == "Manutenção e Reforma")
        $totalManutencao += $dadosProjeto['valArrecadado'];
    else if($dadosProjeto['categoria'] == "Pequenas Obras")
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
$plot->SetDataType('text-data');
$plot->SetDataValues($data);
$plot->SetPlotType("bars");
$plot->SetCallback('data_color', 'pickcolor');
$plot->SetDataColors(array('red', 'green', 'blue', 'yellow', 'black'));
$plot->SetTitle('Grafico de Arrecadamento por Categoria');

$plot->DrawGraph();
?>
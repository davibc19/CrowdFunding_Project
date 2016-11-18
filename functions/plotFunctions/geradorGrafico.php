<?php

require 'phplot.php';
require '../functionsBd.php';

function pickcolor($img, $ignore, $row, $col)
{
    return $row;
}

$queryDoacoes = consultaDoacaoPorIdProjeto($_GET['id']);

$totalPublico = 0;
$totalGestorProjeto = 0; 
$totalAcademico = 0;

while ($dadosDoacoes = mysql_fetch_array($queryDoacoes))
{
    $queryAutorDoacao = procuraAutor($dadosDoacoes['idUsr']);
    $dadosAutorDoacao = mysql_fetch_array($queryAutorDoacao);

    if ($dadosAutorDoacao['tipo'] == "Financiador Publico")
        $totalPublico += $dadosDoacoes['valor'];
    if ($dadosAutorDoacao['tipo'] == "Gestor de Projetos")
        $totalGestorProjeto += $dadosDoacoes['valor'];
    if ($dadosAutorDoacao['tipo'] == "Financiador Academico")
        $totalAcademico += $dadosDoacoes['valor'];
}

$data = array(
    array('Financiador Publico', $totalPublico),
    array('Gestor de Projetos', $totalGestorProjeto),
    array('Financiador Academico', $totalAcademico)
);
$plot = new PHPlot();
$plot->SetDataType('text-data');
$plot->SetDataValues($data);
$plot->SetPlotType("bars");
$plot->SetCallback('data_color', 'pickcolor');
$plot->SetDataColors(array('red', 'green', 'blue'));
$plot->SetTitle('Grafico de Doacoes por Financiador');

$plot->DrawGraph();
?>
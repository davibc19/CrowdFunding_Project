<?php

require './phplot.php';
require '../functionsBd.php';

function pickcolor($img, $ignore, $row, $col)
{
    return $row;
}

$queryDoacoes = consultaDoacaoPorIdProjeto($_GET['id']);

$totalAluno = 0;
$totalGestorProjeto = 0; 
$totalTecnico = 0;

while ($dadosDoacoes = mysql_fetch_array($queryDoacoes))
{
    $queryAutorDoacao = procuraAutor($dadosDoacoes['idUsr']);
    $dadosAutorDoacao = mysql_fetch_array($queryAutorDoacao);

    if ($dadosAutorDoacao['tipo'] == "aluno")
        $totalAluno += $dadosDoacoes['valor'];
    if ($dadosAutorDoacao['tipo'] == "gestorProjeto")
        $totalGestorProjeto += $dadosDoacoes['valor'];
    if ($dadosAutorDoacao['tipo'] == "tecnico")
        $totalTecnico += $dadosDoacoes['valor'];
}

$data = array(
    array('Aluno', $totalAluno),
    array('Gestor de Projetos', $totalGestorProjeto),
    array('Tecnico Administrativo', $totalTecnico)
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
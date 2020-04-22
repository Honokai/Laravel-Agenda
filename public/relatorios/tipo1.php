<?php

require_once '../../vendor/autoload.php';
require_once '../config/BancoDados.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$titulo = $_POST['titulo'];
$banco = new BancoDados;
$conexao = $banco->conexao();
$char_set = $conexao->prepare("set names utf8");
$char_set->execute();
$query = "SELECT u.nome as advisor, h.* FROM usuarios u JOIN historico h on u.id = h.usuario_id";
$resultado = $conexao->prepare($query);
$resultado->execute();

criarCabecalho();



    /**
     * Criar o cabeçalho da planilha
     * 
     * @author Emerson
     */
    function criarCabecalho(){
        $planilha = new Spreadsheet();
        $planilha->getActiveSheet()->setTitle("Relatorio geral"); //nome da aba
        $planilha->getActiveSheet()->mergeCells('e1:l1')->setCellValue('e1',"PRIMEIRA VISITA");
        $planilha->getActiveSheet()->getStyle('E1')->getFill()->setFillType("solid")->getStartColor()->setARGB('000E2A'); //muda cor do preenchimento
        $planilha->getActiveSheet()->getStyle('e1')->getFont()->getColor()->setARGB('FFFFFF'); //muda cor da fonte
        $planilha->getActiveSheet()->getStyle('e1')->applyFromArray(['font' => ['bold' => true,],]); //muda estilo da fonte
        $planilha->getActiveSheet()->mergeCells('f2:l2')->setCellValue('f2',"FECHADO"); //mescla células
        $planilha->getActiveSheet()->getStyle('f2:l2')->getAlignment()->setHorizontal('center');
        $planilha->getActiveSheet()->getStyle('e1:l1')->getAlignment()->setHorizontal('center');

        $planilha->getActiveSheet()->getStyle('a3:z3')->applyFromArray(['font' => ['bold' => true,],]); //muda estilo da fonte
        $planilha->getActiveSheet()->getStyle('e2:t2')->applyFromArray(['font' => ['bold' => true,],]); //muda estilo da fonte

        $planilha->getActiveSheet()->setCellValue('e2',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('a3',"CELULAR");
        $planilha->getActiveSheet()->setCellValue('b3',"ADVISOR");
        $planilha->getActiveSheet()->setCellValue('c3',"DATA DE REGISTRO");
        $planilha->getActiveSheet()->setCellValue('d3',"DATA DE ALTERAÇÃO");
        $planilha->getActiveSheet()->setCellValue('e3',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('f3',"ANF");
        $planilha->getActiveSheet()->setCellValue('g3',"FLW");
        $planilha->getActiveSheet()->setCellValue('h3',"AB");
        $planilha->getActiveSheet()->setCellValue('i3',"TED");
        $planilha->getActiveSheet()->setCellValue('j3',"D");
        $planilha->getActiveSheet()->setCellValue('k3',"X");
        $planilha->getActiveSheet()->setCellValue('l3',"OK");

        $planilha->getActiveSheet()->mergeCells('M1:T1')->setCellValue('M1',"SEGUNDA VISITA");
        $planilha->getActiveSheet()->getStyle('m1')->getFill()->setFillType("solid")->getStartColor()->setARGB('600000');
        $planilha->getActiveSheet()->getStyle('m1')->applyFromArray(['font' => ['bold' => true,],]); //muda estilo da fonte para negrito
        $planilha->getActiveSheet()->getStyle('m1')->getFont()->getColor()->setARGB('FFFFFF'); //muda cor da fonte
        $planilha->getActiveSheet()->mergeCells('N2:T2')->setCellValue('N2',"FECHADO");
        $planilha->getActiveSheet()->getStyle('M2:T2')->getAlignment()->setHorizontal('center');
        $planilha->getActiveSheet()->getStyle('M1:T1')->getAlignment()->setHorizontal('center');

        $planilha->getActiveSheet()->setCellValue('M2',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('M3',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('N3',"ANF");
        $planilha->getActiveSheet()->setCellValue('O3',"FLW");
        $planilha->getActiveSheet()->setCellValue('P3',"AB");
        $planilha->getActiveSheet()->setCellValue('Q3',"TED");
        $planilha->getActiveSheet()->setCellValue('R3',"D");
        $planilha->getActiveSheet()->setCellValue('S3',"X");
        $planilha->getActiveSheet()->setCellValue('T3',"OK");

        return $planilha;
    }
    $planilha = criarCabecalho();
    $i=4;
    foreach($resultado->fetchAll() as $key){
        $planilha->getActiveSheet()->setCellValue('a'.$i,$key['celular']);
        $planilha->getActiveSheet()->setCellValue('b'.$i,$key['advisor']);
        $i++;
    }

    
    $planilha->getActiveSheet()->getColumnDimension('a')->setAutoSize(true);
    $planilha->getActiveSheet()->getColumnDimension('b')->setAutoSize(true);
    $escrever = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($planilha, "Xlsx");
    $escrever->save("C:/users/eff/desktop/{$titulo}.xlsx"); //nome final do arquivo


echo json_encode("Legal");

?>
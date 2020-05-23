<?php

require_once '../../vendor/autoload.php';
require_once '../config/BancoDados.php';
require_once 'funcoes_relatorio.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$titulo = $_POST['titulo'];
$banco = new BancoDados;
$conexao = $banco->conexao();
$char_set = $conexao->prepare("set names utf8");
$char_set->execute();
$query = "SELECT u.nome as advisor, h.* FROM usuarios u JOIN historico h on u.id = h.usuario_id order by h.celular";
$resultado = $conexao->prepare($query);
$resultado->execute();
$caminho = "../file/";

    /**
     * Criar o cabeçalho da planilha
     * 
     * @author Emerson
     */
    function criarCabecalho(){
        $planilha = new Spreadsheet();
        $planilha = coloracaoSubCabecalho($planilha);


        /*    alinhamento    */
        $planilha->getActiveSheet()->getStyle('a2:z2')->getAlignment()->setHorizontal('center');  
        $planilha->getActiveSheet()->getStyle('a1:z1')->getAlignment()->setHorizontal('center');
        $planilha->getActiveSheet()->getStyle('a3:z3')->getAlignment()->setHorizontal('center');
        /*  fim alinhamento */

        $planilha->getActiveSheet()->setTitle("Relatorio geral"); //nome da aba
        $planilha->getActiveSheet()->mergeCells('e1:l1')->setCellValue('e1',"PRIMEIRA VISITA");
        $planilha->getActiveSheet()->getStyle('E1')->getFill()->setFillType("solid")->getStartColor()->setARGB('000E2A'); //muda cor do preenchimento
        $planilha->getActiveSheet()->getStyle('e1')->getFont()->getColor()->setARGB('FFFFFF'); //muda cor da fonte
        $planilha->getActiveSheet()->getStyle('e1')->applyFromArray(['font' => ['bold' => true,],]); //muda estilo da fonte
        $planilha->getActiveSheet()->mergeCells('f2:l2')->setCellValue('f2',"FECHADO"); //mescla células

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
        
        

        $planilha->getActiveSheet()->setCellValue('M2',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('M3',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('N3',"ANF");
        $planilha->getActiveSheet()->setCellValue('O3',"FLW");
        $planilha->getActiveSheet()->setCellValue('P3',"AB");
        $planilha->getActiveSheet()->setCellValue('Q3',"TED");
        $planilha->getActiveSheet()->setCellValue('R3',"D");
        $planilha->getActiveSheet()->setCellValue('S3',"X");
        $planilha->getActiveSheet()->setCellValue('T3',"OK");



        $planilha->getActiveSheet()->mergeCells('u1:w1')->setCellValue('u1',"VISITA DE RELACIONAMENTO - VR")
        ->getStyle('u1')->getFill()->setFillType("solid")->getStartColor()->setARGB('A6A6A6');
        $planilha->getActiveSheet()->getStyle('u1:w1')->applyFromArray(['font' => ['bold'=>true,],]);

        $planilha->getActiveSheet()->mergeCells('u2:w2')->getStyle('u2')
        ->getFill()->setFillType("solid")->getStartColor()->setARGB('A6A6A6');

        $planilha->getActiveSheet()->setCellValue('u3',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('v3',"D");
        $planilha->getActiveSheet()->setCellValue('w3',"OK");

        $planilha->getActiveSheet()->mergeCells('x1:z1')->setCellValue('x1',"LIGAÇÃO - LIG")
        ->getStyle('x1')->getFill()->setFillType("solid")->getStartColor()->setARGB('A6A6A6');
        $planilha->getActiveSheet()->getStyle('x1:z1')->applyFromArray(['font' => ['bold'=>true,],]);

        $planilha->getActiveSheet()->mergeCells('x2:z2')->getStyle('x2')
        ->getFill()->setFillType("solid")->getStartColor()->setARGB('A6A6A6');

        $planilha->getActiveSheet()->setCellValue('x3',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('y3',"D");
        $planilha->getActiveSheet()->setCellValue('z3',"OK");



        return $planilha;
    }

    $planilha = criarCabecalho();
    $i=4;
    foreach($resultado->fetchAll() as $key){
        $planilha->getActiveSheet()->setCellValue('a'.$i,$key['celular']);
        $planilha->getActiveSheet()->setCellValue('b'.$i,$key['advisor']);
        switch ($key['tipo_atividade']) {
            
            case 'PV':
                $atividade = $key['status_atividade'];
                $planilha = primeiraVisita($i,$key['status_atividade'],$planilha);
                break;
            
            case 'SV':
                $atividade = $key['status_atividade'];
                $planilha = segundaVisita($i,$key['status_atividade'],$planilha);
                break;
            
            case 'VR':
                $atividade = $key['status_atividade'];
                $planilha = visitaRelacionamento($i,$key['status_atividade'],$planilha);
                break;
            
            case 'LIG':
                $atividade = $key['status_atividade'];
                $planilha = ligacao($i,$key['status_atividade'],$planilha);
                break;

            default:
                break;
        }
        $planilha->getActiveSheet()->setCellValue('c'.$i,$key['criacao']);
        $planilha->getActiveSheet()->setCellValue('d'.$i,$key['alteracao']);
        $i++;
    }

    $planilha->getActiveSheet()->getStyle('A1:D'.$i)->getAlignment()->setHorizontal('center');

    foreach(range('A','D') as $columnID) {
        $planilha->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }

    $escrever = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($planilha, "Xlsx");
    $escrever->save("../../storage/app/{$titulo}.xlsx"); //nome final do arquivo

    header('Content-Type: application/download');
    header('Content-Disposition: attachment; filename="file.xlsx"');
    echo json_encode(array(
        "planilha"=>"{$titulo}.xlsx"
    ));

?>
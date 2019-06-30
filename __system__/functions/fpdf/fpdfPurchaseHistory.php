<?php
    // GERA PDF DA COMPRA NA PÁGINA DE HISTÓRICO DE COMPRAS DO CLIENTE
    require_once '__system__/functions/connection/conn.php';
    require_once 'fpdf.php';

    $font = "Arial";
    $style = "";
        
        $pdf = new FPDF();
        $pdf->AddPage();

        $arquivo = "nota-fiscal.pdf";
        $tipo_pdf = "I";

        $pdf->SetFont($font, $style, 15);
        $pdf->Cell(190, 10, "e.conomize", $border, 1, $align);
        
        $pdf->Output($arquivo, $tipo_pdf);
?>
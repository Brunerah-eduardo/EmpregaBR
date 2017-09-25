<?php
session_start();
include ('pdf/mpdf.php');

$candidato = $_SESSION['dadoscandidato'];
$curriculo = 
    "<html>
        <head><title>Curriculo -".$candidato->nome_completo."</title></head>
        <body>
            <br><h1 align=center>Curriculum Vitae</h1>
            <br><h3 align=center>Dados Pessoais</h3>
            Nome: ".$candidato->nome_completo."<br>
            CPF: ".$candidato->cpf."<br>
            RG: ".$candidato->rg."<br>
            Data Nascimento: ".$candidato->data_nascimento."<br>
            E-mail: ".$candidato->email."<br>
            Celular: ".$candidato->celular."<br>
        </body>
    </html>";

$arquivo = "Curriculo_".$candidato->nome_completo.".pdf";
$mpdf = new mPDF();
$mpdf->WriteHTML($curriculo);
$mpdf->Output($arquivo, 'I');
?>



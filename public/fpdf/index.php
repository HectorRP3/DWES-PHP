<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once '../../vendor/autoload.php';
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('logo.png',10,8,33);
        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(80);
        $pdf->Cell(50,10,'TITLE',1,0,'C');
        $pdf->Ln(20);
        for($i = 1; $i <= 30; $i++)
                $pdf->Cell(0, 10, 'Número de línea ' . $i, 0, 1);
        $pdf->Output("Hola.pdf","F");

    ?>
</body>
</html>
<?php
// Archivo donde se guardarán las ventas
$archivo = 'ventas.csv';

// Recibir datos desde JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Si hay datos válidos
if ($data) {
    $linea = [
        date("Y-m-d H:i:s"), // Fecha y hora
        $data['nombre'],
        $data['precio'],
        $data['cantidad'],
        $data['talle'],
        $data['metodo']
    ];

    // Abrir archivo en modo "append" (agregar sin borrar lo anterior)
    $fp = fopen($archivo, 'a');

    // Si el archivo está vacío, agregar encabezados
    if (filesize($archivo) === 0) {
        fputcsv($fp, ['Fecha', 'Producto', 'Precio', 'Cantidad', 'Talle', 'Método de Pago']);
    }

    // Escribir la nueva línea
    fputcsv($fp, $linea);
    fclose($fp);

    echo json_encode(['status' => 'ok', 'message' => 'Compra guardada']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos']);
}
?>

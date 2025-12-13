<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class ReporteProductoController extends Controller
{
    public function productos()
    {
        $productos = [
            ['descripcion' => 'Laptop', 'precio' => 500],
            ['descripcion' => 'Mouse',  'precio' => 10],
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('reporte', ['productos' => $productos]);
        return $pdf->stream('reporte.pdf');
        //return $pdf->download('reporte.pdf');
    }
}

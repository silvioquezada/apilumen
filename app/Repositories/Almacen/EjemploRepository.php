<?php

namespace App\Repositories\Almacen;

use Illuminate\Support\Facades\DB;

class ProductoRepository
{
    protected $repoExistencia;

    // Inyectamos el repositorio de existencias
    public function __construct(ExistenciaRepository $repoExistencia)
    {
        $this->repoExistencia = $repoExistencia;
    }

    // Listar productos
    public function listar()
    {
        return DB::select("SELECT * FROM productos WHERE estado = 1 ORDER BY id DESC");
    }

    // Crear producto + inicializar existencia
    public function crear(string $codigo, string $descripcion, int $stock, float $precio, float $iva)
    {
        // Guardar producto
        DB::insert(
            "INSERT INTO productos (codigo, descripcion, stock, precio, iva, estado) VALUES (?, ?, ?, ?, ?, 1)",
            [$codigo, $descripcion, $stock, $precio, $iva]
        );

        // Obtener el ID recién insertado
        $productoId = DB::getPdo()->lastInsertId();

        // Usar ExistenciaRepository para inicializar existencia
        $this->repoExistencia->crear($productoId, $stock);
    }
}

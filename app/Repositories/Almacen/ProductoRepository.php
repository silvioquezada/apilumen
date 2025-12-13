<?php

namespace App\Repositories\Almacen;;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoRepository
{
    public function listar()
    {
        return DB::select('SELECT * FROM productos');
    }

    public function guardar(string $codigo, string $descripcion, int $stock,float $precio, float $iva)
    {
        return DB::insert(
            "INSERT INTO productos (codigo, descripcion, stock, precio, iva) VALUES (?, ?, ?, ?, ?)",
            [$codigo, $descripcion, $stock, $precio, $iva]
        );
    }

    /*
    public function guardar($data)
    {
        //$now = Carbon::now();

        
        return DB::insert(
            'INSERT INTO productos (codigo, descripcion, stock, precio, iva, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                $data['codigo'],
                $data['descripcion'],
                $data['stock'],
                $data['precio'],
                $data['iva'],
                $now,
                $now
            ]
        );

        
        return DB::insert(
            'INSERT INTO productos (codigo, descripcion, stock, precio, iva) 
            VALUES (?, ?, ?, ?, ?)',
            [
                $data['codigo'],
                $data['descripcion'],
                $data['stock'],
                $data['precio'],
                $data['iva']
            ]
        );
        
    }
    */

    public function obtenerPorId($id)
    {
        $producto = DB::select('SELECT * FROM productos WHERE id = ?', [$id]);
        //return DB::selectOne("SELECT * FROM categoria WHERE cod_categoria = ?", [$id]);
        return $producto ? $producto[0] : null;
    }

    public function actualizar($id, $data)
    {
        return DB::update(
            'UPDATE productos SET codigo = ?, descripcion = ?, stock = ?, precio = ?, iva = ?, updated_at = ? WHERE id = ?',
            [
                $data['codigo'],
                $data['descripcion'],
                $data['stock'],
                $data['precio'],
                $data['iva'],
                Carbon::now(),
                $id
            ]
        );
    }

    public function eliminar($id)
    {
        return DB::delete('DELETE FROM productos WHERE id = ?', [$id]);
    }
}

<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use App\Repositories\Almacen\ProductoRepository;
use Exception;

class ProductoController extends Controller
{
    public function __construct(ProductoRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return response()->json($this->repo->listar());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|max:255',
            'descripcion' => 'required',
            'stock' => 'required|integer',
            'precio' => 'required|numeric',
            'iva' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => 0,
                'mensaje' => "Algunos campos son erroneos"
            ], 200);
        }

        $codigo = trim($request->input('codigo'));
        $descripcion = trim($request->input('descripcion'));
        $stock = $request->input('stock');
        $precio = $request->input('precio');
        $iva = $request->input('iva');

        try {
            $this->repo->guardar($codigo, $descripcion, $stock, $precio, $iva);

            return response()->json([
                'estado' => 1,
                'mensaje' => 'Producto almacenado correctamente'
            ], 201);

        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return response()->json([
                    'estado' => 0,
                    'mensaje' => "El código '$codigo' ya está registrado",
                    'error' => $e->getMessage()
                ], 200); // 409 = Conflict
            }

            return response()->json([
                'estado' => 0,
                'mensaje' => 'Error al guardar el producto',
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /*
    public function store(Request $request)
    {
        // 1. Obtener datos: $request->input('nombre'), $request->input('precio')
        // 2. Validar datos
        // 3. Insertar en DB: DB::insert('INSERT INTO productos (...) VALUES (...)', [...]);
        // 4. Devolver respuesta 201 Created
        
        $codigo = $request->input('codigo');
        $descripcion = $request->input('descripcion');
        $stock = $request->input('stock');
        $precio = $request->input('codigo');
        $iva = $request->input('codigo');
        

        $validator = Validator::make($request->all(), [
            'codigo' => 'required|max:255',
            'descripcion' => 'required',
            'stock' => 'required|integer',
            'precio' => 'required|numeric',
            'iva' => 'required|numeric'
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'estado' => 0,
                'mensaje' => $validator->errors()
            ], 422);
        }
        

        if ($validator->fails()) {
            return response()->json([
                'estado' => 0,
                'mensaje' => "Algunos campos son erroneos"
            ], 200);
        }

        $this->repo->guardar($request->all());

        return response()->json([
            'estado' => 1,
            'mensaje' => 'Producto almacenado correctamente'
        ], 201);
    }
    */

    /**
     * READ: Muestra el producto especificado.
     * Método: GET /api/productos/{id}
     */
    public function show($id)
    {
        // 1. Buscar en DB: DB::select('SELECT * FROM productos WHERE id = ?', [$id]);
        // 2. Devolver 404 si no existe
        // 3. Devolver el producto si existe
    }

    /**
     * UPDATE: Actualiza el producto especificado.
     * Método: PUT/PATCH /api/productos/{id}
     */
    public function update(Request $request, $id)
    {
        // 1. Obtener datos del request y el $id
        // 2. Actualizar en DB: DB::update('UPDATE productos SET ... WHERE id = ?', [... , $id]);
        // 3. Devolver respuesta 200 OK
    }

    /**
     * DELETE: Elimina el producto especificado.
     * Método: DELETE /api/productos/{id}
     */
    public function destroy($id)
    {
        // 1. Eliminar en DB: DB::delete('DELETE FROM productos WHERE id = ?', [$id]);
        // 2. Devolver respuesta 204 No Content
        return response()->json(null, 204);
    }
}
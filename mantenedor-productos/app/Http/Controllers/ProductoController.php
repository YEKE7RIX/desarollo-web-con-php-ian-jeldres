<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login');
        }

        $buscar = $request->buscar;

        $productos = Producto::when($buscar, function ($query) use ($buscar) {
            $query->where('nombre', 'like', '%' . $buscar . '%')
                ->orWhere('categoria', 'like', '%' . $buscar . '%');
        })
        ->orderByDesc('id')
        ->get();

        return view(
            'productos.index',
            compact('productos', 'buscar')
        );
    }

    public function create()
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login');
        }

        return view('productos.create');
    }

    public function store(Request $request)
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login');
        }

        $datos = $this->validarProducto($request);

        DB::transaction(function () use ($datos) {

            $producto = Producto::create([
                'nombre' => $datos['nombre'],
                'categoria' => $datos['categoria'],
                'precio' => $datos['precio'],
                'stock' => $datos['stock'],
                'descripcion' => $datos['descripcion'],
                'estado' => true,
            ]);

            // Registrar el precio inicial en el historial.
            $producto->precios()->create([
                'precio' => $datos['precio'],
                'fecha_inicio' => now()->toDateString(),
                'fecha_fin' => null,
            ]);
        });

        return redirect()
            ->route('productos.index')
            ->with('success', 'El producto fue creado correctamente.');
    }

    public function cambiarEstado($id)
    {
        if (!session()->has('usuario')) {
            return response()->json([
                'success' => false,
                'message' => 'Sesión no válida.',
            ], 401);
        }

        $producto = Producto::findOrFail($id);

        $producto->estado = !$producto->estado;
        $producto->save();

        return response()->json([
            'success' => true,
            'estado' => $producto->estado,
        ]);
    }

    public function edit($id)
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login');
        }

        $producto = Producto::findOrFail($id);

        return view(
            'productos.edit',
            compact('producto')
        );
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login');
        }

        $producto = Producto::findOrFail($id);
        $datos = $this->validarProducto($request);

        DB::transaction(function () use ($producto, $datos) {

            $precioAnterior = (float) $producto->precio;
            $precioNuevo = (float) $datos['precio'];

            $producto->update([
                'nombre' => $datos['nombre'],
                'categoria' => $datos['categoria'],
                'precio' => $datos['precio'],
                'stock' => $datos['stock'],
                'descripcion' => $datos['descripcion'],
            ]);

            /*
             * Si el producto todavía no tiene historial, se crea
             * el primer registro, aunque el precio no haya cambiado.
             */
            if (!$producto->precios()->exists()) {

                $producto->precios()->create([
                    'precio' => $datos['precio'],
                    'fecha_inicio' => now()->toDateString(),
                    'fecha_fin' => null,
                ]);

                return;
            }

            // Registrar historial solamente si el precio cambió.
            if ($precioAnterior !== $precioNuevo) {

                $producto->precios()
                    ->whereNull('fecha_fin')
                    ->update([
                        'fecha_fin' => now()->toDateString(),
                    ]);

                $producto->precios()->create([
                    'precio' => $datos['precio'],
                    'fecha_inicio' => now()->toDateString(),
                    'fecha_fin' => null,
                ]);
            }
        });

        return redirect()
            ->route('productos.index')
            ->with('success', 'El producto fue actualizado correctamente.');
    }

    private function validarProducto(Request $request): array
    {
        return $request->validate(
            [
                'nombre' => 'required|string|max:100',
                'categoria' =>
                    'required|in:Planes,Urnas,Lápidas,Flores,Accesorios',
                'precio' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'descripcion' => 'required|string|max:255',
            ],
            [
                'nombre.required' =>
                    'Debe ingresar el nombre del producto.',
                'nombre.max' =>
                    'El nombre no puede superar los 100 caracteres.',

                'categoria.required' =>
                    'Debe seleccionar una categoría.',
                'categoria.in' =>
                    'La categoría seleccionada no es válida.',

                'precio.required' =>
                    'Debe ingresar un precio.',
                'precio.numeric' =>
                    'El precio debe ser numérico.',
                'precio.min' =>
                    'El precio no puede ser negativo.',

                'stock.required' =>
                    'Debe ingresar el stock.',
                'stock.integer' =>
                    'El stock debe ser un número entero.',
                'stock.min' =>
                    'El stock no puede ser negativo.',

                'descripcion.required' =>
                    'Debe ingresar una descripción.',
                'descripcion.max' =>
                    'La descripción no puede superar los 255 caracteres.',
            ]
        );
    }
}
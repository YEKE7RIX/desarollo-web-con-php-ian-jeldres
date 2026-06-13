<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrecioProductoController extends Controller
{
    public function index(Producto $producto)
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login');
        }

        $precios = $producto->precios()
            ->orderByDesc('fecha_inicio')
            ->orderByDesc('id')
            ->get();

        return view(
            'precios.index',
            compact('producto', 'precios')
        );
    }

    public function store(Request $request, Producto $producto)
    {
        if (!session()->has('usuario')) {
            return redirect()->route('login');
        }

        $datos = $request->validate(
            [
                'precio' => 'required|numeric|min:0',
            ],
            [
                'precio.required' => 'Debe ingresar el nuevo precio.',
                'precio.numeric' => 'El precio debe ser un valor numérico.',
                'precio.min' => 'El precio no puede ser negativo.',
            ]
        );

        DB::transaction(function () use ($producto, $datos) {

            // Cerrar el precio que actualmente está vigente.
            $producto->precios()
                ->whereNull('fecha_fin')
                ->update([
                    'fecha_fin' => now()->toDateString(),
                ]);

            // Guardar el nuevo precio en el historial.
            $producto->precios()->create([
                'precio' => $datos['precio'],
                'fecha_inicio' => now()->toDateString(),
                'fecha_fin' => null,
            ]);

            // Actualizar el precio vigente mostrado en productos.
            $producto->update([
                'precio' => $datos['precio'],
            ]);
        });

        return redirect()
            ->route('precios.index', $producto)
            ->with('success', 'El nuevo precio fue registrado correctamente.');
    }
}
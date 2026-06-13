<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioProducto extends Model
{
    protected $table = 'precios_producto';

    protected $fillable = [
        'producto_id',
        'precio',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'producto_id'
        );
    }
}
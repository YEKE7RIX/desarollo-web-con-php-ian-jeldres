<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'categoria',
        'precio',
        'stock',
        'descripcion',
        'estado',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'estado' => 'boolean',
    ];

    public function precios()
    {
        return $this->hasMany(
            PrecioProducto::class,
            'producto_id'
        );
    }
}
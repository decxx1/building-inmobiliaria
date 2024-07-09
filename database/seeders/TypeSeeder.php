<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'name' => 'Casa',
        ]);
        Type::create([
            'name' => 'Departamento',
        ]);
        Type::create([
            'name' => 'Lote',
        ]);
        Type::create([
            'name' => 'Bodega',
        ]);
        Type::create([
            'name' => 'Bodega con Viñedo',
        ]);
        Type::create([
            'name' => 'Cabaña',
        ]);
        Type::create([
            'name' => 'Campo',
        ]);
        Type::create([
            'name' => 'Chalet',
        ]);
        Type::create([
            'name' => 'Cochera',
        ]);
        Type::create([
            'name' => 'Condominio',
        ]);
        Type::create([
            'name' => 'Depósito',
        ]);
        Type::create([
            'name' => 'Duplex',
        ]);
        Type::create([
            'name' => 'Edificio',
        ]);
        Type::create([
            'name' => 'Estación de Servicio',
        ]);
        Type::create([
            'name' => 'Fábrica',
        ]);
        Type::create([
            'name' => 'Finca',
        ]);
        Type::create([
            'name' => 'Fondo de comercio',
        ]);
        Type::create([
            'name' => 'Fraccionamiento',
        ]);
        Type::create([
            'name' => 'Galpón',
        ]);
        Type::create([
            'name' => 'Hotel',
        ]);
        Type::create([
            'name' => 'Industria',
        ]);
        Type::create([
            'name' => 'Local Comercial',
        ]);
        Type::create([
            'name' => 'Loft',
        ]);
        Type::create([
            'name' => 'Loteo',
        ]);
        Type::create([
            'name' => 'Negocio',
        ]);
        Type::create([
            'name' => 'Oficina',
        ]);
        Type::create([
            'name' => 'P.H.',
        ]);
        Type::create([
            'name' => 'Piso',
        ]);
        Type::create([
            'name' => 'Playa de estacionamiento',
        ]);
        Type::create([
            'name' => 'Quinta',
        ]);
        Type::create([
            'name' => 'Semipiso',
        ]);
        Type::create([
            'name' => 'Terreno',
        ]);
        Type::create([
            'name' => 'Triplex',
        ]);
        Type::create([
            'name' => 'Viñedo',
        ]);

    }
}

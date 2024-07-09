<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Province::create ([
            'id'=> 1,
            'name'=> 'Capital Federal',
            'lat'=> '-34.60163851777544',
            'lng'=> '-58.41403196565807'
        ]);
        Province::create ([
            'id'=> 2,
            'name'=> 'G.B.A. Zona Norte',
            'lat'=> '-34.361576',
            'lng'=> '-60.183105'
        ]);
        Province::create ([
            'id'=> 3,
            'name'=> 'G.B.A. Zona Sur',
            'lat'=> '-37.195331',
            'lng'=> '-59.985352'
        ]);
        Province::create ([
            'id'=> 4,
            'name'=> 'G.B.A. Zona Oeste',
            'lat'=> '-36.421282',
            'lng'=> '-61.875'
        ]);
        Province::create ([
            'id'=> 5,
            'name'=> 'Buenos Aires Costa Atlantica',
            'lat'=> '-37.474858',
            'lng'=> '-57.216797'
        ]);
        Province::create ([
            'id'=> 6,
            'name'=> 'Buenos Aires Interior',
            'lat'=> '-34.894942447397305',
            'lng'=> '-57.96112060546875'
        ]);
        Province::create ([
            'id'=> 7,
            'name'=> 'Jujuy',
            'lat'=> '-24.13672816974738',
            'lng'=> '-65.335693359375'
        ]);
        Province::create ([
            'id'=> 8,
            'name'=> 'Salta',
            'lat'=> '-24.756808311192696',
            'lng'=> '-65.4235839843755'
        ]);
        Province::create ([
            'id'=> 9,
            'name'=> 'Formosa',
            'lat'=> '-25.394597',
            'lng'=> '-58.737363'
        ]);
        Province::create ([
            'id'=> 10,
            'name'=> 'Chaco',
            'lat'=> '-26.582386697222464',
            'lng'=> '-60.95283508300781'
        ]);
        Province::create ([
            'id'=> 11,
            'name'=> 'Corrientes',
            'lat'=> '-29.1137756',
            'lng'=> '-57.832031'
        ]);
        Province::create ([
            'id'=> 12,
            'name'=> 'Misiones',
            'lat'=> '-26.667096',
            'lng'=> '-54.4482421'
        ]);
        Province::create ([
            'id'=> 13,
            'name'=> 'Entre Rios',
            'lat'=> '-31.615966',
            'lng'=> '-59.106445'
        ]);
        Province::create ([
            'id'=> 14,
            'name'=> 'Tucuman',
            'lat'=> '-26.8027214',
            'lng'=> '-65.2272615'
        ]);
        Province::create ([
            'id'=> 15,
            'name'=> 'Santiago del Estero',
            'lat'=> '-27.741884632507073',
            'lng'=> '-64.2919921875'
        ]);
        Province::create ([
            'id'=> 16,
            'name'=> 'Catamarca',
            'lat'=> '-28.46144767187983',
            'lng'=> '-65.78201293945312'
        ]);
        Province::create ([
            'id'=> 17,
            'name'=> 'Santa Fe',
            'lat'=> '-31.63943029079663',
            'lng'=> '-60.71017454378307'
        ]);
        Province::create ([
            'id'=> 18,
            'name'=> 'La Rioja',
            'lat'=> '-29.343875399418',
            'lng'=> '-66.90673828125'
        ]);
        Province::create ([
            'id'=> 19,
            'name'=> 'Cordoba',
            'lat'=> '-31.391235655982065',
            'lng'=> '-64.18734739534557'
        ]);
        Province::create ([
            'id'=> 20,
            'name'=> 'San Juan',
            'lat'=> '-31.484893386890',
            'lng'=> '-68.5546875'
        ]);
        Province::create ([
            'id'=> 21,
            'name'=> 'Mendoza',
            'lat'=> '-32.87505096302248',
            'lng'=> '-68.83456419'
        ]);
        Province::create ([
            'id'=> 22,
            'name'=> 'San Luis',
            'lat'=> '-33.30180253801695',
            'lng'=> '-66.33750915527344'
        ]);
        Province::create ([
            'id'=> 23,
            'name'=> 'La Pampa',
            'lat'=> '-37.895659',
            'lng'=> '-65.095779'
        ]);
        Province::create ([
            'id'=> 24,
            'name'=> 'Neuquen',
            'lat'=> '-38.427774',
            'lng'=> '-69.807129'
        ]);
        Province::create ([
            'id'=> 25,
            'name'=> 'Chubut',
            'lat'=> '-43.745305',
            'lng'=> '-69.458313'
        ]);
        Province::create ([
            'id'=> 26,
            'name'=> 'Santa Cruz',
            'lat'=> '-48.773682',
            'lng'=> '-69.19171'
        ]);
        Province::create ([
            'id'=> 27,
            'name'=> 'Tierra del Fuego',
            'lat'=> '-54.308355',
            'lng'=> '-67.745156'
        ]);
        Province::create ([
            'id'=> 28,
            'name'=> 'Rio Negro',
            'lat'=> '-40.730608',
            'lng'=> '-66.621094'
        ]);

    }
}

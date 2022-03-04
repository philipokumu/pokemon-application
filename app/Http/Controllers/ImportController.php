<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Rap2hpoutre\FastExcel\FastExcel;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel as FacadesFastExcel;

class ImportController extends Controller
{
    public function import() 
    {
        $file_path = 'C:\Users\user\Downloads\pokemon.csv';

        $pokemons = (new FastExcel)->configureCsv(',', '#', 'gbk')->import($file_path, function ($line) {
            
            Pokemon::create([
                'id' => $line['id'],
                'identifier' => $line['identifier'],
                'species_id' => $line['species_id'],
                'height' => $line['height'],
                'weight' => $line['weight'],
                'base_experience' => $line['base_experience'],
                'order' => $line['order'],
                'is_default' => $line['is_default'],
            ]);
        });

        return 'done';


    }
}

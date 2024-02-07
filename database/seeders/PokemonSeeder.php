<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiUrl = "https://pokeapi.co/api/v2/pokemon?limit=150";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, TRUE);
        $pokemons = $result["results"];
        foreach ($pokemons as $pokemon) {
            $name = $pokemon["name"];
            $url = $pokemon["url"];
            DB::table('pokemons')->insert(
                [
                    'name' => $name,
                    'url' => $url
                ]
            );
        }
    }
}

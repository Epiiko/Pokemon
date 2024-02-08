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
            $name=$pokemon["name"];
            $apiUrl = 'https://pokeapi.co/api/v2/pokemon/'.$name;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            $pokemon_data = json_decode($response, TRUE);
            //ataques del pokemon
            if(count($pokemon_data["abilities"])<2){
                $atack1=$pokemon_data["abilities"][0]["ability"]["name"];
                $atack2="null";
            }else{
                $atack1=$pokemon_data["abilities"][0]["ability"]["name"];
                $atack2=$pokemon_data["abilities"][1]["ability"]["name"];
            }
            $img=$pokemon_data["sprites"]["front_default"];
            if(count($pokemon_data["types"])<2){
                $type1=$pokemon_data["types"][0]["type"]["name"];
                $type2="null";
            }else{
                $type1=$pokemon_data["types"][0]["type"]["name"];
                $type2=$pokemon_data["types"][1]["type"]["name"];
            }
            
            DB::table('pokemons')->insert([
                [
                    'name' =>  $name,
                    'type1' => $type1,
                    'type2' => $type2,
                    'atack1' => $atack1,
                    'atack2' => $atack2,
                    'img' => $img
                ]
            ]);
        }
    }
}

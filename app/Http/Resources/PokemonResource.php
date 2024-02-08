<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PokemonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type1' => $this->type1,
            'type2' => $this->type2,
            'atack1' => $this->atack1,
            'atack2' => $this->atack1,
            'img' => $this->img,
        ] ;
    }
}

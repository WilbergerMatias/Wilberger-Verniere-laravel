<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use App\Models\Pelicula;

class GeneroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'NroId' => $this->id,
            'Nombre' => $this->nombre,
            'Peliculas' => PeliculaResource::collection(Pelicula::where([
                ['idGenero',$this->id],
                ['habilitado', true]
            ])->get()),
        ];
    }
}

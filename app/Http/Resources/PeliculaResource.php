<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\GeneroController;

class PeliculaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Id' => $this->id,
            'Nombre' => $this->nombre,
            'Genero' => $this->genero->nombre,
            'Imagen' => asset('storage/peliculas/imagenes/'.$this->imagen_pelicula),
        ];
    }
}

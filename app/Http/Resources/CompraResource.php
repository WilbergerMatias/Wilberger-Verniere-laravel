<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompraResource extends JsonResource
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
            'Compras' => DetallesCompraCollection(DetallesCompra::
                where('idCompra', $this->id)),
            'Observaciones' => $this->Observaciones,
            'Email' => $this->emailCliente,
            'Fecha de compra' => $this->fecha,
        ];
    }
}

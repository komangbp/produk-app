<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'nama'     => $this->nama,
            //kategori
            'kategori' => $this->whenLoaded('kategori', fn() => [
                'id'   => $this->kategori->id,
                'nama' => $this->kategori->nama,
            ]),

            'harga'    => (float) $this->harga,
            //rating
            'rating'   => [
                'rata'  => $this->when(isset($this->review_avg_rating), round((float)$this->review_avg_rating, 2)),
                'jumlah' => $this->when(isset($this->review_count), (int) $this->review_count),
            ],

            'dibuat'   => $this->created_at?->toISOString(),
            'diubah'   => $this->updated_at?->toISOString(),
        ];
    }
}

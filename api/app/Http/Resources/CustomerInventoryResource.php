<?php

namespace App\Http\Resources;

use App\Models\CustomerInventory;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerInventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "note" => $this->note,
            "product_name" => $this->product_name,
            "status" => $this->status,
            "status_str" => CustomerInventory::getStatusWording($this->status),
            "use_at" => $this->use_at,
            "created_at" => $this->created_at->format("Y-m-d H:i:s"),
            "updated_at" => $this->updated_at->format("Y-m-d H:i:s"),
        ];
    }
}

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
        $use_at = is_null($this->use_at) ? null : $this->use_at->format("Y-m-d\TH:i");
        return [
            "id" => $this->id,
            "order_id" => $this->order_id,
            "note_id" => $this->note_id,
            "product_name" => $this->product_name,
            "status" => $this->status,
            "status_str" => CustomerInventory::getStatusWording($this->status),
            "use_at" => $use_at,
            "created_at" => $this->created_at->toDatetimeString(),
            "updated_at" => $this->updated_at->toDatetimeString(),
        ];
    }
}

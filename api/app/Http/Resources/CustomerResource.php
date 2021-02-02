<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $birth = null;
        if ($this->birth) {
            $datetime = new \DateTime($this->birth);
            $birth = date_format($datetime, "Y-m-d");
        }

        return [
            "uuid" => $this->uuid,
            "name" => $this->name,
            "phone" => $this->phone,
            "email" => $this->email,
            "cellphone" => $this->cellphone,
            "gender" => $this->gender,
            "updated_at" => $this->updated_at->format("Y-m-d H:i:s"),
            "birth" => $birth,
            "address" => $this->address,
            "note_1" => $this->note_1,
            "note_2" => $this->note_2,
        ];
    }
}

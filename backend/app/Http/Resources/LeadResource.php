<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'leads',
                'lead_id' => $this->id,
                'attributes' => [
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'email' => $this->email,
                    'consent' => $this->consent,
                    'needs_sync' => $this->needs_sync,
                    'last_sync_time' => optional($this->last_sync_time)->diffForHumans(),
                    'updated_at' => $this->updated_at->diffForHumans(),
                    'created_at' => $this->created_at->diffForHumans(),
                ],
            ],
            'links' => [
                'self' => route('leads.show', ['lead' => $this->id]),
            ],
        ];
    }
}

<?php

namespace App\Repositories;

use App\Interfaces\Repositories\LeadRepositoryInterface;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Collection;

class LeadRepository implements LeadRepositoryInterface
{
    public static function all(): Collection
    {
        return Lead::all();
    }

    public static function findById($id): Lead
    {
        return Lead::findOrFail($id);
    }

    public static function updateById($id, $data = []): Lead
    {
        $lead = LeadRepository::findById($id);

        $lead->first_name = $data['first_name'];
        $lead->last_name = $data['last_name'];
        $lead->email = $data['email'];
        $lead->consent = $data['consent'];
        $lead->needs_sync = true;

        $lead->save();

        return $lead;
    }

    public static function create($data = []): Lead
    {
        $lead = new Lead();

        $lead->first_name = $data['first_name'];
        $lead->last_name = $data['last_name'];
        $lead->email = $data['email'];
        $lead->consent = $data['consent'];
        $lead->needs_sync = true;

        $lead->save();

        return $lead;
    }

    public static function destroyById($id): bool
    {
        return LeadRepository::findById($id)->delete();
    }
}

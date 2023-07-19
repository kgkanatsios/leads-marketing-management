<?php

namespace App\Repositories;

use App\Interfaces\Repositories\LeadRepositoryInterface;
use App\Models\Lead;
use Carbon\Carbon;
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

        $lead->email_platform_hash = null;
        $lead->first_name = $data['first_name'];
        $lead->last_name = $data['last_name'];
        $lead->email = $data['email'];
        $lead->consent = $data['consent'];
        $lead->needs_sync = true;
        $lead->last_sync_time = null;

        $lead->save();

        return $lead;
    }

    public static function destroyById($id): bool
    {
        return LeadRepository::findById($id)->delete();
    }

    public static function updateNeedsSyncById($id, $needs_sync, $email_platform_hash): Lead
    {
        $lead = LeadRepository::findById($id);

        $lead->needs_sync = $needs_sync;
        $lead->last_sync_time = Carbon::now();
        $lead->email_platform_hash = $email_platform_hash;

        $lead->save();

        return $lead;
    }

    public static function getNewLeadsForSync(): Collection
    {
        return Lead::where('needs_sync', true)->whereNull('email_platform_hash')->get();
    }

    public static function getUpdatedLeadsForSync(): Collection
    {
        return Lead::where('needs_sync', true)->whereNotNull('email_platform_hash')->get();
    }
}

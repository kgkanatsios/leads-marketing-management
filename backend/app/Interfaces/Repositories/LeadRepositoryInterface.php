<?php

namespace App\Interfaces\Repositories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Collection;

interface LeadRepositoryInterface
{
    public static function all(): Collection;
    public static function findById($id): Lead;
    public static function updateById($id, $data = []): Lead;
    public static function create($data = []): Lead;
    public static function destroyById($id): bool;
}
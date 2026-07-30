<?php

namespace App\Services\Sync\AnalyticDatabase;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

readonly class FetchAnalyticDatabaseService
{
    private const string DATABASE_CONNECTIONS = 'pgsql_analytic';

    public function fetch(): Collection
    {
        return DB::connection(self::DATABASE_CONNECTIONS)
            ->table(config('database.connections.pgsql_analytic.table'))
            ->get();
    }
}

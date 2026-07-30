<?php

namespace App\Console\Commands\Sync\AnalyticDatabase;

use App\Services\Sync\AnalyticDatabase\ClientStatus\SyncAnalyticDatabaseClientStatusService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-analityc-database-client-status')]
#[Description('Синхронизация статусов с БД Аналитиков.')]
class SyncAnalyticDatabaseClientStatusCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(SyncAnalyticDatabaseClientStatusService $syncAnalyticDatabaseClientStatusService): int
    {
        try {
            $clientStatusesCount = $syncAnalyticDatabaseClientStatusService->sync();

            Log::channel('sync')->info('[SyncAnalyticDatabaseClientStatusCommand] Статусы клиентов синхронизированы. Количество: ' . $clientStatusesCount . ' шт.');
        } catch (\Exception $exception) {
            Log::channel('sync')->error('[SyncAnalyticDatabaseClientStatusCommand] Ошибка синхронизации. Исключение: ' . $exception->getMessage());

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}

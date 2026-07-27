<?php

namespace App\Console\Commands\Sync\ShadowDomain;

use App\Services\Sync\ShadowDomain\Client\SyncShadowDomainClientService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-shadow-domain-clients')]
#[Description('Синхронизация клиентов.')]
class SyncShadowDomainClientCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(SyncShadowDomainClientService $syncShadowDomainClientService): int
    {
        try {
            $clientsCount = $syncShadowDomainClientService->sync();

            Log::channel('sync')->info('[SyncShadowDomainClientCommand] Клиенты синхронизированы. Количество: ' . $clientsCount . ' шт.');
        } catch (\Exception $exception) {
            Log::channel('sync')->error('[SyncShadowDomainClientCommand] Ошибка синхронизации. Исключение: ' . $exception->getMessage());

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}

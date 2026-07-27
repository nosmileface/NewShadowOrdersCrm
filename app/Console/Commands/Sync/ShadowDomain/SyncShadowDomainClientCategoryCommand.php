<?php

namespace App\Console\Commands\Sync\ShadowDomain;

use App\Services\Sync\ShadowDomain\ClientCategory\SyncShadowDomainClientCategoryService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('app:sync-shadow-domain-client-categories')]
#[Description('Синхронизация категорий клиента')]
class SyncShadowDomainClientCategoryCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(SyncShadowDomainClientCategoryService $syncShadowDomainClientCategoryService): int
    {
        try {
            $clientCategoriesCount = $syncShadowDomainClientCategoryService->sync();

            Log::channel('sync')->info('[SyncShadowDomainClientCategoryCommand] Категории клиентов синхронизированы. Количество: ' . $clientCategoriesCount . ' шт.');
        } catch (\Exception $exception) {
            Log::channel('sync')->error('[SyncShadowDomainClientCategoryCommand] Ошибка синхронизации. Исключение: ' . $exception->getMessage());

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}

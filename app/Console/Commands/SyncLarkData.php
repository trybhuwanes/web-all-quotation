<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\LarkSyncService;

class SyncLarkData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lark:sync {--record-id= : Sync specific record}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data from Lark Base to database';
    
    /**
     * Execute the console command.
     */
    public function handle(LarkSyncService $syncService)
    {
        $this->info('Starting Lark data sync...');

        try {
            if ($recordId = $this->option('record-id')) {
                $result = $syncService->syncByRecordId($recordId);
                $this->info('Single record synced: ' . json_encode($result));
            } else {
                $result = $syncService->syncAllClients();
                $this->info('Sync completed!');
                $this->table(
                    ['Metric', 'Count'],
                    [
                        ['Total Records', $result['total_records']],
                        ['Synced', $result['synced']],
                        ['Created', $result['created']],
                        ['Updated', $result['updated']],
                        ['Skipped', $result['skipped']],
                        ['Errors', count($result['errors'])],
                    ]
                );

                if (!empty($result['errors'])) {
                    $this->error('Errors occurred:');
                    foreach ($result['errors'] as $error) {
                        $this->error('Record ' . $error['record_id'] . ': ' . $error['error']);
                    }
                }
            }

            return 0;
        } catch (\Exception $e) {
            $this->error('Sync failed: ' . $e->getMessage());
            return 1;
        }
    }
}

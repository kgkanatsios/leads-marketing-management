<?php

namespace App\Console\Commands;

use App\Jobs\EmailMarketingMemberSyncJob;
use App\Repositories\LeadRepository;
use Illuminate\Console\Command;

class LeadEmailMarketingUpdateMemberDispatcherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lead:email-marketing-update-member-dispatcher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve updated leads and dispatch jobs to send data to email marketing platform';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Fetch leads need update...');
        $leads = LeadRepository::getUpdatedLeadsForSync();
        $this->info('Fetch completed! ' . $leads->count() . ' leads should be updated.');
        foreach ($leads as $lead) {
            EmailMarketingMemberSyncJob::dispatch($lead->id)->onQueue('syncMarketingMember');
            $this->info('The lead with ID:' . $lead->id . ' has been added to the queue!');
        }
        $this->info('Done!');
        return 0;
    }
}

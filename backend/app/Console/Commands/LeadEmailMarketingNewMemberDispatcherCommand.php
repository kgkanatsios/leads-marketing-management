<?php

namespace App\Console\Commands;

use App\Jobs\EmailMarketingMemberAddJob;
use App\Repositories\LeadRepository;
use Illuminate\Console\Command;

class LeadEmailMarketingNewMemberDispatcherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lead:email-marketing-new-member-dispatcher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve new leads and dispatch jobs to send data to email marketing platform';

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
        $this->info('Fetch leads need import...');
        $leads = LeadRepository::getNewLeadsForSync();
        $this->info('Fetch completed! ' . $leads->count() . ' leads should be imported.');
        foreach ($leads as $lead) {
            EmailMarketingMemberAddJob::dispatch($lead->id)->onQueue('addMarketingMember');
            $this->info('The lead with ID:' . $lead->id . ' has been added to the queue!');
        }
        $this->info('Done!');
        return 0;
    }
}

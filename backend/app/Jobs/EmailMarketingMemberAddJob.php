<?php

namespace App\Jobs;

use App\DTOs\Services\EmailMarketing\MemberDTO;
use App\Interfaces\Repositories\LeadRepositoryInterface;
use App\Services\EmailMarketingServices\EmailMarketingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class EmailMarketingMemberAddJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $lead_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $lead_id)
    {
        $this->lead_id = $lead_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(LeadRepositoryInterface $leadRepository)
    {
        $lead = $leadRepository::findById($this->lead_id);
        $member =  new MemberDTO($lead->first_name, $lead->last_name, $lead->email, $lead->consent);
        $emailMarketingService = App::makeWith(EmailMarketingService::class, ['member' => $member]);
        $memberAdded = $emailMarketingService->add();

        if ($memberAdded) {
            $lead = $leadRepository::updateNeedsSyncById($this->lead_id, false);
        }
    }

    /**
     * The unique ID of the job.
     *
     * @return string
     */
    public function uniqueId()
    {
        return $this->lead_id;
    }
}

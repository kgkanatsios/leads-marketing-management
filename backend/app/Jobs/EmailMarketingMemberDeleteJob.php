<?php

namespace App\Jobs;

use App\DTOs\Services\EmailMarketing\MemberDTO;
use App\Services\EmailMarketingServices\EmailMarketingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class EmailMarketingMemberDeleteJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $lead_id, $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $lead_id, $email)
    {
        $this->lead_id = $lead_id;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $member =  new MemberDTO("", "", $this->email, false);
        $emailMarketingService = App::makeWith(EmailMarketingService::class, ['member' => $member]);
        $memberDeleted = $emailMarketingService->delete();
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

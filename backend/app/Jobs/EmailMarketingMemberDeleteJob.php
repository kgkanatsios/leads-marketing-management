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

    private $lead_id, $email, $email_platform_hash;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $lead_id, string $email, string $email_platform_hash)
    {
        $this->lead_id = $lead_id;
        $this->email = $email;
        $this->email_platform_hash = $email_platform_hash;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $member =  new MemberDTO($this->email_platform_hash, null, null, $this->email, false);
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

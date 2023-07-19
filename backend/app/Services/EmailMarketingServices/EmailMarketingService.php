<?php

namespace App\Services\EmailMarketingServices;

use App\DTOs\Services\EmailMarketing\MemberDTO;
use App\Interfaces\Services\EmailMarketingServiceInterface;

class EmailMarketingService
{
    protected $member;
    protected $emailMarketingService;

    function __construct(MemberDTO $member, EmailMarketingServiceInterface $emailMarketingService)
    {
        $this->member = $member;
        $this->emailMarketingService = $emailMarketingService;
    }

    function add(): ?MemberDTO
    {
        return $this->emailMarketingService->addMember($this->member);
    }

    function update(): ?MemberDTO
    {
        return $this->emailMarketingService->updateMember($this->member);
    }

    function delete(): bool
    {
        return $this->emailMarketingService->deleteMember($this->member);
    }
}

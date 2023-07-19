<?php

namespace App\Interfaces\Services;

use App\DTOs\Services\EmailMarketing\MemberDTO;

interface EmailMarketingServiceInterface
{
    public function getMember(MemberDTO $member): ?MemberDTO;
    public function addMember(MemberDTO $member): ?MemberDTO;
    public function updateMember(MemberDTO $member): ?MemberDTO;
    public function deleteMember(MemberDTO $member): bool;
}

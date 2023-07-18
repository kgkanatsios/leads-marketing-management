<?php

namespace App\Interfaces\Services;

use App\DTOs\Services\EmailMarketing\MemberDTO;

interface EmailMarketingServiceInterface
{
    public function getMember($email): ?MemberDTO;
    public function addMember(MemberDTO $member): bool;
    public function updateMember(MemberDTO $member): bool;
    public function deleteMember(MemberDTO $member): bool;
}

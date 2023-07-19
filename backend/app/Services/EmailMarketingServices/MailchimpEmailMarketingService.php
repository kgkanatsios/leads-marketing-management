<?php

namespace App\Services\EmailMarketingServices;

use App\DTOs\Services\EmailMarketing\MemberDTO;
use App\Interfaces\Services\EmailMarketingServiceInterface;
use MailchimpMarketing\ApiClient;
use MailchimpMarketing\ApiException;
use Illuminate\Support\Facades\Log;

class MailchimpEmailMarketingService implements EmailMarketingServiceInterface
{
    protected $client, $listId;

    const STATUS_SUBSCRIBED = 'subscribed';
    const STATUS_UNSUBSCRIBED = 'unsubscribed';

    const MARKETING_CONSENT_TRUE = 'YES';
    const MARKETING_CONSENT_FALSE = 'NO';

    public function __construct()
    {
        $this->client = new ApiClient();
        $this->client->setConfig([
            'apiKey' => config('services.email_marketing.mailchimp.api_key'),
            'server' => config('services.email_marketing.mailchimp.server'),
        ]);

        $this->listId = config('services.email_marketing.mailchimp.list_id');
    }


    public function getMember(MemberDTO $member): ?MemberDTO
    {
        if (empty($member->getEmailPlatformHash())) {
            Log::channel('mailchimp-error-logs')->error('Get member: Email platform hash is empty', [$member]);
            return null;
        }

        try {
            $response = $this->client->lists->getListMember($this->listId, $member->getEmailPlatformHash());
        } catch (ApiException $e) {
            Log::channel('mailchimp-error-logs')->error('Get member: Mailchimp API Exception', [$e->getMessage()]);
            return null;
        }

        $email_platform_hash = $response->id;
        $fistName = $response->merge_fields->FNAME;
        $lastName = $response->merge_fields->LNAME;
        $email = $response->email_address;
        $consent = optional($response->merge_fields)->MCONSENT == self::MARKETING_CONSENT_TRUE ? true : false;

        $member = new MemberDTO($email_platform_hash, $fistName, $lastName, $email, $consent);

        return $member;
    }

    public function addMember(MemberDTO $member): ?MemberDTO
    {
        if (!empty($member->getEmailPlatformHash())) {
            return $this->updateMember($member);
        }

        try {
            $response = $this->client->lists->addListMember($this->listId, [
                "email_address" => $member->getEmail(),
                "status" => self::STATUS_SUBSCRIBED,
                "merge_fields" => [
                    "FNAME" => $member->getFirstName(),
                    "LNAME" => $member->getLastName(),
                    "MCONSENT" => $member->getConsent() ? self::MARKETING_CONSENT_TRUE : self::MARKETING_CONSENT_FALSE,
                ]
            ]);
        } catch (ApiException $e) {
            Log::channel('mailchimp-error-logs')->error('Add member: Mailchimp API Exception', [$e->getMessage()]);
            return null;
        }

        $email_platform_hash = $response->id;
        $fistName = $response->merge_fields->FNAME;
        $lastName = $response->merge_fields->LNAME;
        $email = $response->email_address;
        $consent = optional($response->merge_fields)->MCONSENT == self::MARKETING_CONSENT_TRUE ? true : false;

        $member = new MemberDTO($email_platform_hash, $fistName, $lastName, $email, $consent);

        return $member;
    }

    public function updateMember(MemberDTO $member): ?MemberDTO
    {
        if (empty($member->getEmailPlatformHash())) {
            return $this->addMember($member);
        }

        try {
            $response = $this->client->lists->setListMember($this->listId, $member->getEmailPlatformHash(), [
                "email_address" => $member->getEmail(),
                "status_if_new" => self::STATUS_SUBSCRIBED,
                "merge_fields" => [
                    "FNAME" => $member->getFirstName(),
                    "LNAME" => $member->getLastName(),
                    "MCONSENT" => $member->getConsent() ? self::MARKETING_CONSENT_TRUE : self::MARKETING_CONSENT_FALSE,
                ]
            ]);
        } catch (ApiException $e) {
            Log::channel('mailchimp-error-logs')->error('Update member: Mailchimp API Exception', [$e->getMessage()]);
            return null;
        }

        $email_platform_hash = $response->id;
        $fistName = $response->merge_fields->FNAME;
        $lastName = $response->merge_fields->LNAME;
        $email = $response->email_address;
        $consent = optional($response->merge_fields)->MCONSENT == self::MARKETING_CONSENT_TRUE ? true : false;

        $member = new MemberDTO($email_platform_hash, $fistName, $lastName, $email, $consent);

        return $member;
    }

    public function deleteMember(MemberDTO $member): bool
    {
        if (empty($member->getEmailPlatformHash())) {
            Log::channel('mailchimp-error-logs')->error('Delete member: Email platform hash is empty', [$member]);
            return false;
        }

        try {
            $response = $this->client->lists->deleteListMember($this->listId, $member->getEmailPlatformHash());
        } catch (ApiException $e) {
            Log::channel('mailchimp-error-logs')->error('Delete member: Mailchimp API Exception', [$e->getMessage()]);
            return false;
        }

        return true;
    }
}

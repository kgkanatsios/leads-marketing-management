<?php

namespace App\DTOs\Services\EmailMarketing;

class MemberDTO
{
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected bool $consent;

    public function __construct(string $first_name, string $last_name, string $email, bool $consent)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->consent = $consent;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getConsent(): bool
    {
        return $this->consent;
    }
}

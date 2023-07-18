<?php

namespace App\Providers;

use App\Interfaces\Services\EmailMarketingServiceInterface;
use App\Services\EmailMarketingServices\MailchimpEmailMarketingService;
use Exception;
use Illuminate\Support\ServiceProvider;

class EmailMarketingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmailMarketingServiceInterface::class, function ($app) {
            if (config('services.email_marketing.driver') == 'mailchimp') {
                return new MailchimpEmailMarketingService();
            }

            throw new Exception('The email marketing driver is invalid.');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

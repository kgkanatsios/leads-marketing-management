
# Leads Management API

This application is built with Laravel framework.

## Summary

This is the main backend system for the Lead Management application. The app encapsulates the business logic for Leads, stores all Leads in a MongoDB, synchronizes Leads data with an external marketing platform (currenlty the app uses [Mailchimp](https://mailchimp.com/)), and provides a RESTful API.

The app uses design patterns to provide extensible and maintainable software. Our processes don't have a strict dependency on the external marketing platform and all the synchronizations are running in the background.

Every interaction with Leads data is implemented instantly in the MongoDB database and dispatches jobs (background tasks) for each action. Jobs will be run asynchronously in the background. Because of this asynchronous approach, a scheduled task is required to be added to our server.

Any downtime of the external marketing platform should not affect the functionality of our app. Also, the missing synchronizations because of a possible downtime should be handled. That's why I have created two `artisan` commands, which will be run every X hours/minutes (depending on the performance and the project requirements) to dispatch jobs for data that need sync.

## API Documentation

By using [Swagger Editor](https://editor.swagger.io/) and [swagger-api.yml](docs/swagger-api.yml), you will get detailed documentation for the API.

## Installation

```sh
$ composer install
$ cp .env.example .env
$ php artisan key:generate
```

### Environment Variables

1. `DB_CONNECTION`: In order to use the MongoDB driver you should set the value: `mongodb`.
2. `DB_DATABASE`: The database name.
3. `DB_DSN`: The connection string used to connect to your MongoDB.
4. `EM_DRIVER`: The email marketing platform driver. Currently, only the `mailchimp` is available.
5. `EM_MAILCHIMP_API_KEY`: The [API Key](https://mailchimp.com/developer/marketing/guides/quick-start/#generate-your-api-key) of your Mailchimp account.
6. `EM_MAILCHIMP_SERVER`: The [server](https://mailchimp.com/developer/marketing/guides/quick-start/#generate-your-api-key) of you Mailchimp account.
7. `EM_MAILCHIMP_LIST_ID`: The ID of the selected Mailchimp list.

### Mailchimp Configuration and Notes

I used the `mailchimp/marketing` [library](https://mailchimp.com/developer/marketing/guides/quick-start/#install-the-client-library-for-your-language) to interact with Mailchimp API.

A basic configuration is needed on Mailchimp platform because of the extra field for marketing consent. So, in your list, you have to create a new audience field with the following configuration:

- Field Label: `Marketing consent` (or whatever you want)
- Type: `Drop down`
- Required: `false`
- Visible: `true`
- Tag: `MCONSENT`
- Options:
  - `YES`
  - `NO`

## Database

To add functionalities to the Eloquent model and Query builder for MongoDB, I installed the `jenssegers/mongodb` [library](https://github.com/jenssegers/laravel-mongodb).

### Running Migrations

```sh
$ php artisan migrate
```

or (in case you want to add some dummy data)

```sh
$ php artisan migrate:fresh --seed
```

## API Routes

| Method | URI              | Notes                  |
|--------|------------------|------------------------|
| GET    | api/leads        | Get all Leads          |
| POST   | api/leads        | Add a new Lead         |
| GET    | api/leads/{lead} | Get a specific Lead    |
| PUT    | api/leads/{lead} | Update a specific Lead |
| DELETE | api/leads/{lead} | Delete a specific Lead |

## Commands

Some background jobs may be failed because of external platform downtime or because of malformed data. The following `artisan` commands are created to re-dispatch jobs for the data that needs sync.

- `lead:email-marketing-new-member-dispatcher`: Retrieve new Leads and dispatch jobs to send data to email marketing platform.
- `lead:email-marketing-update-member-dispatcher`: Retrieve updated Leads and dispatch jobs to send data to email marketing platform.

Both commands have been added to application's command schedule.

## Exceptions

In order to handle specific exceptions, I created the following custom exceptions.

- `LeadNotFoundException`: This exception is used in case of missing Lead.
- `ValidationErrorException`: This exception is used on every `ValidationException`

## Controllers

- `LeadController`: Here is the logic for Leads. Handles all the API requests and executes the required actions.

## Requests

I created two custom requests `StoreLeadRequest` and `UpdateLeadRequest`. Both requests contain a basic preparation for incoming data and run all validation rules.

## Resources

`LeadCollection` and `LeadResource` are used to transform our data into JSON with a specific format.
## Jobs

I created three jobs for all the synchronization needs. All of the are unique to ensure that only one instance of each job is on the queue at any point in time.

- `EmailMarketingMemberAddJob`: This job is responsible to retrieve a Lead from our DB and by using an `EmailMarketingService`, adding the new Lead to the email marketing platform.
- `EmailMarketingMemberDeleteJob`: This job is responsible to keep only the required data for the deleted Lead (as provided by the controller), and by using an `EmailMarketingService`, deleting the Lead from the email marketing platform.
- `EmailMarketingMemberSyncJob`: This job is responsible to retrieve a Lead from our DB and by using an `EmailMarketingService`, updating the new Lead to the email marketing platform.

All jobs have been added to the application's command schedule.

## Providers

In order to use the strategy design pattern for the email marketing service, I had to add a new provider (`EmailMarketingServiceProvider`). This provider binds the interface and class according to the config value `EM_DRIVER`.
## Repositories

I added the `LeadRepository` to decouple the hard dependencies of Lead model from the rest application.

## Services

I added the `EmailMarketingService` as a wrapper for every class that implements `EmailMarketingServiceInterface` and is responsible to execute any of the available actions.

The `MailchimpEmailMarketingService` implements the `EmailMarketingServiceInterface` and is responsible for the interaction with the Mailchimp API. This is the only class that uses the `mailchimp/marketing` [library](https://mailchimp.com/developer/marketing/guides/quick-start/#install-the-client-library-for-your-language) and handles all requests/responses.

The above structure allows us to change the `EM_DRIVER` with any class that implements `EmailMarketingServiceInterface` without the need to change any other code anywhere.

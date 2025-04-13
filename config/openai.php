<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    |
    | This value is the API key for authenticating with the OpenAI API. You can
    | obtain this key from your OpenAI dashboard at https://platform.openai.com/account/api-keys
    |
    */
   'api_key' => env('OPENAI_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Organization ID
    |--------------------------------------------------------------------------
    |
    | This value is the Organization ID for your OpenAI account. This is optional
    | and only needed if you belong to multiple organizations.
    |
    */
   'organization' => env('OPENAI_ORGANIZATION', null),

    /*
    |--------------------------------------------------------------------------
    | Default Model
    |--------------------------------------------------------------------------
    |
    | This value is the default model to use when making requests to the OpenAI API.
    |
    */
    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | This value is the maximum number of seconds to wait for a response from the
    | OpenAI API. If the API does not respond within this time frame, the request
    | will be aborted.
    |
    */
    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 30),
];
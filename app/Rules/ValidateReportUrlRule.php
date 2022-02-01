<?php

namespace App\Rules;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\TransferStats;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class ValidateReportUrlRule implements Rule
{
    /**
     * @var
     */
    var $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct(Request $request, $report = null)
    {
        $client = new HttpClient();

        try {
            $request->reportRequest = $client->request('GET', str_replace('https://', 'http://', $report->fullUrl ?? $request->input('url')), [
                'connect_timeout' => config('settings.report_connection_timeout'),
                'allow_redirects' => [
                    'max'             => 10,        // allow at most 10 redirects.
                    'strict'          => true,      // use "strict" RFC compliant redirects.
                    'referer'         => true,      // add a Referer header
                    'protocols'       => ['http', 'https'], // only allow https URLs
                    'track_redirects' => true
                ],
                'headers' => [
                    'Accept-Encoding' => 'gzip, deflate',
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36'
                ],
                'on_stats' => function (TransferStats $stats) use (&$request) {
                    if ($stats->hasResponse()) {
                        $request->reportRequestTransferStats = $stats;
                    }
                }
            ]);
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->message) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __($this->message);
    }
}

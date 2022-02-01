<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessBase64ConverterRequest;
use App\Http\Requests\ProcessCaseConverterRequest;
use App\Http\Requests\ProcessIpLookupRequest;
use App\Http\Requests\ProcessLoremIpsumGeneratorRequest;
use App\Http\Requests\ProcessMd5GeneratorRequest;
use App\Http\Requests\ProcessPasswordGeneratorRequest;
use App\Http\Requests\ProcessQrGeneratorRequest;
use App\Http\Requests\ProcessTextToSlugRequest;
use App\Http\Requests\ProcessUrlConverterRequest;
use App\Http\Requests\ProcessWordCounterRequest;
use Faker\Provider\Lorem;
use GeoIp2\Database\Reader as GeoIP;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use WhichBrowser\Parser as UserAgent;

class ToolController extends Controller
{
    /**
     * List the Projects.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('tools.list', []);
    }

    /**
     * Show the Text to Slug form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function textToSlug(Request $request)
    {
        return view('tools.content', ['view' => 'text-to-slug']);
    }

    /**
     * Process the Text to Slug.
     *
     * @param ProcessTextToSlugRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processTextToSlug(ProcessTextToSlugRequest $request)
    {
        return view('tools.content', ['view' => 'text-to-slug', 'content' => $request->input('content'), 'result' => Str::slug($request->input('content'))]);
    }

    /**
     * Show the Case Converter form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function caseConverter(Request $request)
    {
        return view('tools.content', ['view' => 'case-converter']);
    }

    /**
     * Process the Case Converter.
     *
     * @param ProcessCaseConverterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processCaseConverter(ProcessCaseConverterRequest $request)
    {
        $method = $request->input('type');

        return view('tools.content', ['view' => 'case-converter', 'content' => $request->input('content'), 'type' => $request->input('type'), 'result' => Str::$method($request->input('content'))]);
    }

    /**
     * Show the Word Counter form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function wordCounter(Request $request)
    {
        return view('tools.content', ['view' => 'word-counter']);
    }

    /**
     * Process the Word Counter.
     *
     * @param ProcessWordCounterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processWordCounter(ProcessWordCounterRequest $request)
    {
        $wordCount = count(explode(' ', preg_replace('/[^\w]/ui', ' ', $request->input('content'))));
        $letterCount = mb_strlen($request->input('content'));

        return view('tools.content', ['view' => 'word-counter', 'content' => $request->input('content'), 'wordCount' => $wordCount, 'letterCount' => $letterCount]);
    }

    /**
     * Show the Lorem Ipsum Generator form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loremIpsumGenerator(Request $request)
    {
        return view('tools.content', ['view' => 'lorem-ipsum-generator']);
    }

    /**
     * Process the Lorem Ipsum Generator.
     *
     * @param ProcessLoremIpsumGeneratorRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processLoremIpsumGenerator(ProcessLoremIpsumGeneratorRequest $request)
    {
        $method = $request->input('type');

        return view('tools.content', ['view' => 'lorem-ipsum-generator', 'type' => $request->input('type'), 'number' => $request->input('number'), 'result' => Lorem::$method($request->input('number'))]);
    }

    /**
     * Show the MD5 Generator form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function md5Generator(Request $request)
    {
        return view('tools.content', ['view' => 'md5-generator']);
    }

    /**
     * Process the MD5 Generator.
     *
     * @param ProcessMd5GeneratorRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processMd5Generator(ProcessMd5GeneratorRequest $request)
    {
        return view('tools.content', ['view' => 'md5-generator', 'content' => $request->input('content'), 'result' => md5($request->input('content'))]);
    }

    /**
     * Show the What is my Browser form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function whatIsMyBrowser(Request $request)
    {
        $result = new UserAgent(getallheaders());

        return view('tools.content', ['view' => 'what-is-my-browser', 'result' => $result]);
    }

    /**
     * Show the What is my IP form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function whatIsMyIp(Request $request)
    {
        // Get the user's geolocation
        try {
            $result = (new GeoIP(storage_path('app/geoip/GeoLite2-City.mmdb')))->city($request->ip())->raw;
        } catch (\Exception $e) {
            $result = null;
        }

        return view('tools.content', ['view' => 'what-is-my-ip', 'result' => $result]);
    }

    /**
     * Show the IP Lookup form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ipLookup(Request $request)
    {
        return view('tools.content', ['view' => 'ip-lookup']);
    }

    /**
     * Process the IP Lookup.
     *
     * @param ProcessIpLookupRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processIpLookup(ProcessIpLookupRequest $request)
    {
        // Get the user's geolocation
        try {
            $result = (new GeoIP(storage_path('app/geoip/GeoLite2-City.mmdb')))->city($request->input('ip'))->raw;
        } catch (\Exception $e) {
            $result = false;
        }

        return view('tools.content', ['view' => 'ip-lookup', 'content' => $request->input('content'), 'result' => $result]);
    }

    /**
     * Show the Password Generator form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function passwordGenerator(Request $request)
    {
        return view('tools.content', ['view' => 'password-generator']);
    }

    /**
     * Process the Password Generator.
     *
     * @param ProcessPasswordGeneratorRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processPasswordGenerator(ProcessPasswordGeneratorRequest $request)
    {
        $length = $request->input('length');

        $characters = [];
        if ($request->input('upper_case')) {
            $characters[] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($request->input('lower_case')) {
            $characters[] = 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($request->input('digits')) {
            $characters[] = '1234567890';
        }
        if ($request->input('symbols')) {
            $characters[] = '!@#$%&*?';
        }

        $all = $password = '';

        foreach ($characters as $character) {
            $password .= $character[array_rand(str_split($character))];
            $all .= $character;
        }

        $all = str_split($all);

        for ($i = 0; $i < $length - count($characters); $i++) {
            $password .= $all[array_rand($all)];
        }

        $password = str_shuffle($password);

        return view('tools.content', ['view' => 'password-generator', 'content' => $request->input('content'), 'lowerCase' => (bool)$request->input('lower_case'), 'upperCase' => (bool) $request->input('upper_case'), 'digits' => (bool) $request->input('digits'), 'symbols' => (bool) $request->input('symbols'), 'result' => $password, 'length' => $length]);
    }

    /**
     * Show the QR Generator form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function qrGenerator(Request $request)
    {
        return view('tools.content', ['view' => 'qr-generator']);
    }

    /**
     * Process the QR Generator.
     *
     * @param ProcessQrGeneratorRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processQrGenerator(ProcessQrGeneratorRequest $request)
    {
        return view('tools.content', ['view' => 'qr-generator', 'content' => $request->input('content'), 'size' => $request->input('size'), 'result' => $request->input('content')]);
    }

    /**
     * Show the URL Converter form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function urlConverter(Request $request)
    {
        return view('tools.content', ['view' => 'url-converter']);
    }

    /**
     * Process the URL Converter.
     *
     * @param ProcessUrlConverterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processUrlConverter(ProcessUrlConverterRequest $request)
    {
        if ($request->input('type') == 'encode') {
            $result = urlencode($request->input('content'));
        } else {
            $result = urldecode($request->input('content'));
        }

        return view('tools.content', ['view' => 'url-converter', 'content' => $request->input('content'), 'type' => $request->input('type'), 'result' => $result]);
    }

    /**
     * Show the Base64 Converter form.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function base64Converter(Request $request)
    {
        return view('tools.content', ['view' => 'base64-converter']);
    }

    /**
     * Process the Base64 Converter.
     *
     * @param ProcessBase64ConverterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processBase64Converter(ProcessBase64ConverterRequest $request)
    {
        if ($request->input('type') == 'encode') {
            $result = base64_encode($request->input('content'));
        } else {
            $result = base64_decode($request->input('content'));
        }

        return view('tools.content', ['view' => 'base64-converter', 'content' => $request->input('content'), 'type' => $request->input('type'), 'result' => $result]);
    }
}

<?php

namespace Jeoip\Server\Http\Controllers;

use Jeoip\Contracts\Exceptions\IQueryException;
use Jeoip\Contracts\IGeoIPService;
use Laravel\Lumen\Routing\Controller;

class ApiController extends Controller
{
    protected IGeoIPService $goeIPService;

    public function __construct(IGeoIPService $goeIPService)
    {
        $this->goeIPService = $goeIPService;
    }

    /**
     * @return mixed
     */
    public function query(string $ip)
    {
        try {
            /**
             * @var array{string,mixed}
             */
            $data = $this->goeIPService->query($ip)->jsonSerialize();
            $data['user_agent'] = request()->userAgent();
            $data['hostname'] = \gethostbyaddr($ip);
            $data['status'] = true;

            return $data;
        } catch (IQueryException $e) {
            return response()->json([
                'status' => false,
                'query' => $e->getQuery(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @return string
     */
    public function ip()
    {
        return request()->ip();
    }

    /**
     * @return string
     */
    public function country(string $ip = null)
    {
        try {
            /**
             * @var string
             */
            $ip = $ip ?? request()->ip();
            $data = $this->goeIPService->query($ip)->getCountry();

            return $data;
        } catch (IQueryException $e) {
            return response()->json([
                'status' => false,
                'query' => $e->getQuery(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @return string
     */
    public function countryCode(string $ip = null)
    {
        try {
            /**
             * @var string
             */
            $ip = $ip ?? request()->ip();
            $data = $this->goeIPService->query($ip)->getCountryCode();

            return $data;
        } catch (IQueryException $e) {
            return response()->json([
                'status' => false,
                'query' => $e->getQuery(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @return string
     */
    public function city(string $ip = null)
    {
        try {
            /**
             * @var string
             */
            $ip = $ip ?? request()->ip();
            $data = $this->goeIPService->query($ip)->getCity();

            return $data;
        } catch (IQueryException $e) {
            return response()->json([
                'status' => false,
                'query' => $e->getQuery(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @return string
     */
    public function asn(string $ip = null)
    {
        try {
            /**
             * @var string
             */
            $ip = $ip ?? request()->ip();
            $data = $this->goeIPService->query($ip)->getAsn();

            return $data;
        } catch (IQueryException $e) {
            return response()->json([
                'status' => false,
                'query' => $e->getQuery(),
                'message' => $e->getMessage(),
            ]);
        }
    }
}

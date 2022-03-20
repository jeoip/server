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
}

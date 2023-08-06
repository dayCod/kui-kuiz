<?php

namespace App\Services\Visitor;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\Guest;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;

class CreateVisitor extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        if (is_null(cache()->get('visitor:'.$dto['ip_address']))) {
            $guest = new Guest([
                'uuid' => $dto['uuid'],
                'ip_address' => $dto['ip_address'],
                'browser' => $this->getUserAgent()->client->browser,
                'device' => $this->getUserAgent()->client->device,
            ]);

            if (!empty($this->getLocation($dto['ip_address'])->location)) {
                $guest['location'] = $this->getLocation($dto['ip_address'])->location->latitude.'-'.$this->getLocation($dto['ip_address'])->location->longitude;
            }

            $guest->save();

            cache()->remember('visitor:'.$dto['ip_address'], 60*60*24, function () use ($guest) {
                return $guest;
            });

            $message = "Visitor Successfully Added";
        } else {
            $guest = cache()->get('visitor:'.$dto['ip_address']);
            $message = "Visitor Had been Added Today";
        }

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = $message;
        $this->results['data'] = $guest;
    }

    private function getLocation($ip_address = null)
    {
        $result['location'] = [];
        $location = Location::get($ip_address);

        if ($location) {
            $result['location'] = $location;
        }

        return (object)$result;
    }

    private function getUserAgent()
    {
        $agent = new Agent();
        return (object) [
            'client' => (object) [
                'browser' => $agent->browser(),
                'device' => $agent->device(),
            ],
        ];
    }
}

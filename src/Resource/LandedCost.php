<?php

namespace SmartDato\DutyRefundsLandmark\Resource;

use Saloon\Http\Response;
use SmartDato\DutyRefundsLandmark\Requests\LandedCost\LandedCost as LandedCostRequest;
use SmartDato\DutyRefundsLandmark\Resource;

class LandedCost extends Resource
{
    public function landedCost(): Response
    {
        return $this->connector->send(new LandedCostRequest);
    }
}

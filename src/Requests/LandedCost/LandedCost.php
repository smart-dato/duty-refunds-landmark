<?php

namespace SmartDato\DutyRefundsLandmark\Requests\LandedCost;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * LandedCost
 *
 * This endpoint accepts shipment data and returns the amount of assessed UK duties and taxes in GBP.
 */
class LandedCost extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/landedCost';
    }

    public function __construct() {}
}

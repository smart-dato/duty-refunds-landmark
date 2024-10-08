<?php

namespace SmartDato\DutyRefundsLandmark\Requests\Shipment;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Plugins\HasTimeout;
use SmartDato\DutyRefundsLandmark\Data\Shipment\ShipmentData;

/**
 * ImportShipment
 *
 * This endpoint creates a shipment in Mercury and generates an Amazon Shipping label for the final
 * mile delivery.
 */
class ImportShipment extends Request implements HasBody
{
    use HasJsonBody, HasTimeout;

    protected int $connectTimeout = 60;

    protected int $requestTimeout = 120;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/shipment';
    }

    public function __construct(
        protected ShipmentData $shipment
    ) {}

    protected function defaultBody(): array
    {
        return $this->shipment->build();
    }
}

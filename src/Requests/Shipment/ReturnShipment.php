<?php

namespace SmartDato\DutyRefundsLandmark\Requests\Shipment;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\DutyRefundsLandmark\Enums\LabelEncoding;
use SmartDato\DutyRefundsLandmark\Enums\LabelFormat;

/**
 * ReturnShipment
 *
 * This endpoint creates a return shipment in Mercury and generates an EVRI label for the first mile
 * delivery. This label is subsequently used for line-haul to the Netherlands.
 */
class ReturnShipment extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;


    public function resolveEndpoint(): string
    {
        return "/return";
    }


    public function __construct(
        protected string $trackingNumber,
        protected array $items,
        protected ?LabelFormat $labelFormat,
        protected ?LabelEncoding $labelEncoding,
        protected ?string $property,
    ) {
    }
}

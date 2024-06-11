<?php

namespace SmartDato\DutyRefundsLandmark\Requests\Shipment;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * ImportShipment
 *
 * This endpoint creates a shipment in Mercury and generates an Amazon Shipping label for the final
 * mile delivery.
 */
class ImportShipment extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/shipment";
	}


	public function __construct()
	{
	}
}

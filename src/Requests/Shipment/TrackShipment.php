<?php

namespace SmartDato\DutyRefundsLandmark\Requests\Shipment;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * TrackShipment
 *
 * Track Shipment By Reference Or TrackingNumber Or PackageReference. This endpoint can also be used to
 * track a return shipment by TrackingNumber.
 * |ℹ Usage Note: The Track Request API should be used to
 * look up tracking information for individual shipments on an ad-hoc basis. Each package may be
 * tracked once per hour (24 times per day).||
 * | ----------- | ----------- |
 *
 * Possible tracking event
 * codes and statuses include:
 *
 * -   50 Shipment Data Uploaded
 * -   60 Shipment inventory allocated
 * -   75 Shipment Processed
 * -   80 Shipment Fulfilled
 * -   90 Shipment held for payment
 * -   100 Shipment information transmitted to carrier
 * -   125 Customs Cleared
 * -   135 Customs Issue
 * -   150 Crossing Border
 * -   155 Crossing Received
 * -   200 Item scanned at postal facility
 * -   225 Item grouped at Landmark or partner facility
 * -   250 Item scanned for crossing
 * -   275 Item in transit with carrier
 * -   300 Item out for delivery
 * -   400 Attempted delivery
 * -   410 Item available for pickup
 * -   450 Item re-directed to new address
 * -   500 Item successfully delivered
 * -   550 Return Received
 * -   800 Claim Issued
 * -   900 Delivery failed
 */
class TrackShipment extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/shipment';
    }

    public function __construct(
        protected ?string $reference = null,
        protected ?string $trackingNumber = null,
        protected ?string $packageReference = null,
        protected ?string $retrievalType = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter([
            'Reference' => $this->reference,
            'TrackingNumber' => $this->trackingNumber,
            'PackageReference' => $this->packageReference,
            'RetrievalType' => $this->retrievalType,
        ]);
    }
}

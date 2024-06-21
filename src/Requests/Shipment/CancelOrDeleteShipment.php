<?php

namespace SmartDato\DutyRefundsLandmark\Requests\Shipment;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * CancelOrDeleteShipment
 *
 * This endpoint cancels a carrier label with Mercury. The Cancel API request unprocesses shipments and
 * also has the option to delete them.
 *
 * This request will void a label of a processed shipment. The
 * label cannot be used to send a shipment after a successful CancelRequest and the client will not be
 * charged for the shipment. Depending on the service used, there will be a different window to
 * unprocess the shipment. After manifesting, however, no shipment can be unprocessed.
 *
 * To delete the
 * shipment in addition to unprocessing it, set the optional DeleteShipment parameter to true. Even if
 * the shipment is already canceled(unprocessed), this parameter can still attempt to delete the
 * shipment.
 *
 * This would typically be used after a Create Shipment call, and before the package leaves
 * the client's facility.
 */
class CancelOrDeleteShipment extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return '/shipment';
    }

    /**
     * @param  null|string  $reason  Required if deleting a shipment.
     */
    public function __construct(
        protected ?string $reference = null,
        protected ?string $trackingNumber = null,
        protected ?bool $deleteShipment = null,
        protected ?string $reason = null,
    ) {
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'Reference' => $this->reference,
            'TrackingNumber' => $this->trackingNumber,
            'DeleteShipment' => $this->deleteShipment,
            'Reason' => $this->reason,
        ]);
    }
}

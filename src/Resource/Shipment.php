<?php

namespace SmartDato\DutyRefundsLandmark\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use SmartDato\DutyRefundsLandmark\Data\ReturnShipment\ReturnShipmentData;
use SmartDato\DutyRefundsLandmark\Data\Shipment\ShipmentData;
use SmartDato\DutyRefundsLandmark\Requests\Shipment\CancelOrDeleteShipment;
use SmartDato\DutyRefundsLandmark\Requests\Shipment\ImportShipment;
use SmartDato\DutyRefundsLandmark\Requests\Shipment\ReturnShipment;
use SmartDato\DutyRefundsLandmark\Requests\Shipment\TrackShipment;
use SmartDato\DutyRefundsLandmark\Resource;

class Shipment extends Resource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function trackShipment(
        ?string $reference = null,
        ?string $trackingNumber = null,
        ?string $packageReference = null,
        ?string $retrievalType = null,
    ): Response {
        return $this->connector->send(
            new TrackShipment(
                $reference,
                $trackingNumber,
                $packageReference,
                $retrievalType
            )
        );
    }

    public function importShipment(ShipmentData $shipment): Response
    {
        return $this->connector->send(new ImportShipment($shipment));
    }

    /**
     * @param  string|null  $reason  Required if deleting a shipment.
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function cancelOrDeleteShipment(
        ?string $reference,
        ?string $trackingNumber,
        ?bool $deleteShipment,
        ?string $reason,
    ): Response {
        return $this->connector->send(
            new CancelOrDeleteShipment(
                $reference,
                $trackingNumber,
                $deleteShipment,
                $reason
            )
        );
    }

    public function returnShipment(ReturnShipmentData $returnShipmentData): Response
    {
        return $this->connector->send(
            new ReturnShipment($returnShipmentData));
    }
}

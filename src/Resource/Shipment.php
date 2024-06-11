<?php

namespace SmartDato\DutyRefundsLandmark\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use SmartDato\DutyRefundsLandmark\Enums\LabelEncoding;
use SmartDato\DutyRefundsLandmark\Enums\LabelFormat;
use SmartDato\DutyRefundsLandmark\Requests\Shipment\CancelOrDeleteShipment;
use SmartDato\DutyRefundsLandmark\Requests\Shipment\ImportShipment;
use SmartDato\DutyRefundsLandmark\Requests\Shipment\ReturnShipment;
use SmartDato\DutyRefundsLandmark\Requests\Shipment\TrackShipment;
use SmartDato\DutyRefundsLandmark\Resource;

class Shipment extends Resource
{
    /**
     * @param  string|null  $reference
     * @param  string|null  $trackingNumber
     * @param  string|null  $packageReference
     * @param  string|null  $retrievalType
     * @return Response
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function trackShipment(
        ?string $reference,
        ?string $trackingNumber,
        ?string $packageReference,
        ?string $retrievalType,
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


    public function importShipment(): Response
    {
        return $this->connector->send(new ImportShipment());
    }


    /**
     * @param  string|null  $reference
     * @param  string|null  $trackingNumber
     * @param  bool  $deleteShipment
     * @param  string|null  $reason  Required if deleting a shipment.
     * @return Response
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


    public function returnShipment(
        string $trackingNumber,
        array $items,
        ?LabelFormat $labelFormat,
        ?LabelEncoding $labelEncoding,
        ?string $property,
    ): Response {
        return $this->connector->send(
            new ReturnShipment(
                $trackingNumber,
                $items,
                $labelFormat,
                $labelEncoding,
                $property
            ));
    }
}

<?php

namespace SmartDato\DutyRefundsLandmark\Data\ReturnShipment;

use SmartDato\DutyRefundsLandmark\Contracts\Data;
use SmartDato\DutyRefundsLandmark\Enums\LabelEncoding;
use SmartDato\DutyRefundsLandmark\Enums\LabelFormat;

class ReturnShipmentData extends Data
{
    /**
     * @param  array<ItemData>  $items
     */
    public function __construct(
        protected string $trackingNumber,
        protected array $items = [],
        protected ?LabelFormat $labelFormat = LabelFormat::PDF,
        protected ?LabelEncoding $labelEncoding = LabelEncoding::LINKS,
    ) {
        //
    }

    public function build(): array
    {

        return [
            'TrackingNumber' => $this->trackingNumber,
            'LabelFormat' => $this->labelFormat?->value,
            'LabelEncoding' => $this->labelEncoding?->value,
            'Items' => array_map(fn ($item) => $item->build(), $this->items),
        ];
    }
}

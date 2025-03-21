<?php

declare(strict_types=1);

namespace SmartDato\DutyRefundsLandmark\Data\Shipment;

use SmartDato\DutyRefundsLandmark\Contracts\Data;
use SmartDato\DutyRefundsLandmark\Enums\Currency;
use SmartDato\DutyRefundsLandmark\Enums\LabelEncoding;
use SmartDato\DutyRefundsLandmark\Enums\LabelFormat;

class ShipmentData extends Data
{
    /**
     * @param  array<ItemData>  $items
     */
    public function __construct(
        protected string $reference,
        protected AddressData $shipTo,
        protected float $shipmentInsuranceFreight,
        protected PackageData $package,
        protected ?VendorData $vendorInformation = null,
        protected ?bool $requiresVATRepresentation = null,
        protected array $items = [],

        protected ?float $orderTotal = null,
        protected ?float $orderInsuranceFreightTotal = null,
        protected ?Currency $itemsCurrency = null,

        protected bool $produceLabel = false,
        protected ?LabelFormat $labelFormat = LabelFormat::PDF,
        protected ?LabelEncoding $labelEncoding = LabelEncoding::LINKS,
    ) {
        //
    }

    public function build(): array
    {
        $body = [
            'Reference' => $this->reference,
            'ShipTo' => $this->shipTo->build(),
            'OrderTotal' => $this->orderTotal,
            'OrderInsuranceFreightTotal' => $this->orderInsuranceFreightTotal,
            'ShipmentInsuranceFreight' => $this->shipmentInsuranceFreight,
            'ItemsCurrency' => $this->itemsCurrency?->value,
            'ProduceLabel' => $this->produceLabel,
            'LabelFormat' => $this->labelFormat?->value,
            'LabelEncoding' => $this->labelEncoding?->value,
            'Package' => $this->package->build(),
            'Items' => array_map(fn ($item) => $item->build(), $this->items),
        ];

        if ($this->vendorInformation) {
            $body['VendorInformation'] = $this->vendorInformation->build();
        }

        if ($this->requiresVATRepresentation !== null) {
            $body['RequiresVATRepresentation'] = $this->requiresVATRepresentation;
        }

        return $body;
    }
}

<?php

declare(strict_types=1);

namespace SmartDato\DutyRefundsLandmark\Data\Shipment;

use SmartDato\DutyRefundsLandmark\Contracts\Data;
use SmartDato\DutyRefundsLandmark\Enums\Country;

class ItemData extends Data
{
    public function __construct(
        protected string $sku = '',
        protected int $quantity = 0,
        protected float $unitPrice = 0.0,
        protected string $description = '',
        protected string $hsCode = '',
        protected Country $countryOfOrigin = Country::ITALY,
        protected string $url = '',

        protected HarmonizedSystemData $hs = new HarmonizedSystemData,

        protected DangerousGoodData $dangerousGood = new DangerousGoodData,
    ) {}

    public function build(): array
    {
        return [
            'Sku' => $this->sku,
            'Quantity' => $this->quantity,
            'UnitPrice' => $this->unitPrice,
            'Description' => $this->description,
            'HSCode' => $this->hsCode,
            'CountryOfOrigin' => $this->countryOfOrigin->value,
            'URL' => $this->url,
            'ReturnCustomsInfo' => $this->hs->build(),
            'DangerousGoodsInformation' => $this->dangerousGood->build(),
        ];
    }
}

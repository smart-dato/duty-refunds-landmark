<?php

declare(strict_types=1);

namespace SmartDato\DutyRefundsLandmark\Data\Shipment;

use SmartDato\DutyRefundsLandmark\Contracts\Data;
use SmartDato\DutyRefundsLandmark\Enums\PackingGroup;
use SmartDato\DutyRefundsLandmark\Enums\Units\VolumeUnit;
use SmartDato\DutyRefundsLandmark\Enums\Units\WeightUnit;

class DangerousGoodData extends Data
{
    public function __construct(
        protected bool $containsDangerousGoods = true,
        protected string $unCode = '',
        protected PackingGroup $packingGroup = PackingGroup::I,
        protected string $packingInstructions = '',
        protected float $weight = 1.0,
        protected WeightUnit $weightUnit = WeightUnit::Kilogram,
        protected float $volume = 1.0,
        protected VolumeUnit $volumeUnit = VolumeUnit::CubicCentimeter,
    ) {
    }

    public function build(): array
    {
        return [
            'ContainsDangerousGoods' => $this->containsDangerousGoods,
            'UNCode' => $this->unCode,
            'PackingGroup' => $this->packingGroup->name,
            'PackingInstructions' => $this->packingInstructions,
            'ItemWeight' => $this->weight,
            'ItemWeightUnit' => $this->weightUnit->value,
            'ItemVolume' => $this->volume,
            'ItemVolumeUnit' => $this->volumeUnit->value,
        ];
    }
}

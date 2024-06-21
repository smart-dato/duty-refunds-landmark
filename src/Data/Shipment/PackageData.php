<?php

declare(strict_types=1);

namespace SmartDato\DutyRefundsLandmark\Data\Shipment;

use SmartDato\DutyRefundsLandmark\Contracts\Data;
use SmartDato\DutyRefundsLandmark\Enums\Units\DimensionUnit;
use SmartDato\DutyRefundsLandmark\Enums\Units\WeightUnit;

class PackageData extends Data
{
    public function __construct(
        protected WeightUnit $weightUnit = WeightUnit::Pound,
        protected float $weight = 1.0,

        protected DimensionUnit $dimensionsUnit = DimensionUnit::Inches,
        protected float $length = 1.0,
        protected float $width = 1.0,
        protected float $height = 1.0,

        protected string $packageReference = '',
    ) {}

    public function build(): array
    {
        return [
            'WeightUnit' => $this->weightUnit->value,
            'Weight' => $this->weight,
            'DimensionsUnit' => $this->dimensionsUnit->value,
            'Length' => $this->length,
            'Width' => $this->width,
            'Height' => $this->height,
            'PackageReference' => $this->packageReference,
        ];
    }
}

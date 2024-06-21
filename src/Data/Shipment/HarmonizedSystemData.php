<?php

declare(strict_types=1);

namespace SmartDato\DutyRefundsLandmark\Data\Shipment;

use SmartDato\DutyRefundsLandmark\Contracts\Data;

class HarmonizedSystemData extends Data
{
    public function __construct(
        protected string $code = '',
        protected string $region = '',
    ) {

    }

    public function build(): array
    {
        return [
            'HSCode' => $this->code,
            'HSRegionCode' => $this->region,
        ];
    }
}

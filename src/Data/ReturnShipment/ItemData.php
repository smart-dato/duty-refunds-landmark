<?php

declare(strict_types=1);

namespace SmartDato\DutyRefundsLandmark\Data\ReturnShipment;

use SmartDato\DutyRefundsLandmark\Contracts\Data;

class ItemData extends Data
{
    public function __construct(
        protected string $sku = '',
        protected int $quantity = 0,
    ) {}

    public function build(): array
    {
        return [
            'Sku' => $this->sku,
            'Quantity' => $this->quantity,
        ];
    }
}

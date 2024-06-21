<?php

declare(strict_types=1);

namespace SmartDato\DutyRefundsLandmark\Data\Shipment;

use SmartDato\DutyRefundsLandmark\Contracts\Data;
use SmartDato\DutyRefundsLandmark\Enums\Country;

class AddressData extends Data
{
    public function __construct(
        protected string $name,
        protected string $address1,
        protected string $city,
        protected string $state,
        protected string $postalCode,
        protected Country $country,
        protected ?string $attention = null,
        protected ?string $address2 = null,
        protected ?string $address3 = null,
        protected ?string $phone = null,
        protected ?string $email = null,
    ) {}

    public function build(): array
    {
        return [
            'Name' => $this->name,
            'Attention' => $this->attention,
            'Address1' => $this->address1,
            'Address2' => $this->address2,
            'Address3' => $this->address3,
            'City' => $this->city,
            'State' => $this->state,
            'PostalCode' => $this->postalCode,
            'Country' => $this->country->value,
            'Phone' => $this->phone,
            'Email' => $this->email,
        ];
    }
}

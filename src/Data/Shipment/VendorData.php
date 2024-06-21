<?php

declare(strict_types=1);

namespace SmartDato\DutyRefundsLandmark\Data\Shipment;

use SmartDato\DutyRefundsLandmark\Contracts\Data;
use SmartDato\DutyRefundsLandmark\Enums\Country;

class VendorData extends Data
{
    public function __construct(
        protected string $name = '',
        protected string $phone = '',
        protected string $email = '',
        protected string $address1 = '',
        protected string $address2 = '',
        protected string $city = '',
        protected string $state = '',
        protected string $postalCode = '',
        protected Country $country = Country::ITALY,

        protected string $businessNumber = '',
        protected string $RGRNumber = '',
        protected string $IOSSNumber = '',
        protected string $EORINumber = '',
    ) {
        //
    }

    public function build(): array
    {
        return [
            'VendorName' => $this->name,
            'VendorPhone' => $this->phone,
            'VendorEmail' => $this->email,
            'VendorAddress1' => $this->address1,
            'VendorAddress2' => $this->address2,
            'VendorCity' => $this->city,
            'VendorState' => $this->state,
            'VendorPostalCode' => $this->postalCode,
            'VendorCountry' => $this->country->value,

            'VendorBusinessNumber' => $this->businessNumber,
            'VendorRGRNumber' => $this->RGRNumber,
            'VendorIOSSNumber' => $this->IOSSNumber,
            'VendorEORINumber' => $this->EORINumber,
        ];
    }
}

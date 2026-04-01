<?php

use SmartDato\DutyRefundsLandmark\Data\Shipment\AddressData;
use SmartDato\DutyRefundsLandmark\Data\Shipment\DangerousGoodData;
use SmartDato\DutyRefundsLandmark\Data\Shipment\HarmonizedSystemData;
use SmartDato\DutyRefundsLandmark\Data\Shipment\ItemData;
use SmartDato\DutyRefundsLandmark\Data\Shipment\PackageData;
use SmartDato\DutyRefundsLandmark\Data\Shipment\ShipmentData;
use SmartDato\DutyRefundsLandmark\Data\Shipment\VendorData;
use SmartDato\DutyRefundsLandmark\Enums\Country;
use SmartDato\DutyRefundsLandmark\Enums\Currency;
use SmartDato\DutyRefundsLandmark\Enums\LabelEncoding;
use SmartDato\DutyRefundsLandmark\Enums\LabelFormat;
use SmartDato\DutyRefundsLandmark\Enums\PackingGroup;
use SmartDato\DutyRefundsLandmark\Enums\Units\DimensionUnit;
use SmartDato\DutyRefundsLandmark\Enums\Units\VolumeUnit;
use SmartDato\DutyRefundsLandmark\Enums\Units\WeightUnit;

it('can create a address', function () {
    $faker = fake('gb');
    $address = new AddressData(
        name: $faker->name(),
        address1: $faker->streetAddress(),
        city: $faker->city(),
        state: $faker->randomLetter().$faker->randomLetter(),
        postalCode: $faker->postcode(),
        country: Country::UNITED_KINGDOM,
    );

    expect($address)->not()->toBeNull();
});

it('can create a full shipment', function () {
    $faker = fake('gb');

    $shipment = new ShipmentData(
        reference: fake()->uuid(),
        shipTo: new AddressData(
            name: $faker->name(),
            address1: $faker->streetAddress(),
            city: $faker->city(),
            state: $faker->randomLetter().$faker->randomLetter(),
            postalCode: $faker->postcode(),
            country: Country::UNITED_KINGDOM,
        ),
        shipmentInsuranceFreight: $faker->randomFloat('2', 1, 100),
        vendorInformation: new VendorData(
            name: $faker->name(),
        ),
        package: new PackageData,
    );

    expect($shipment)->not()->toBeNull();

    ray($shipment->build());
});

it('can create example from documentation', function () {
    $shipment = new ShipmentData(
        reference: '3245325',
        shipTo: new AddressData(
            name: 'Test Company',
            attention: 'Ole Olsen',
            address1: '5130 Halford Drive',
            address2: 'Building #C',
            address3: 'Unit 1',
            city: 'Windsor',
            state: 'ON',
            postalCode: 'N9A6J3',
            country: Country::CANADA,
            phone: '1-519-737-9101',
            email: 'orders@test.com'
        ),
        orderTotal: 187.98,
        orderInsuranceFreightTotal: 20.65,
        shipmentInsuranceFreight: 20.65,
        itemsCurrency: Currency::United_States_Dollar,
        produceLabel: false,
        labelFormat: LabelFormat::PDF,
        labelEncoding: LabelEncoding::LINKS,
        vendorInformation: new VendorData(
            name: 'Test Company Legal Name',
            phone: '12223334444',
            email: 'contact@vendor.com',
            address1: 'Sample Company Street',
            address2: 'Suite 135',
            city: 'Santa Barbara',
            state: 'CA',
            postalCode: '93101',
            country: Country::UNITED_STATES,

            businessNumber: '12345',
            RGRNumber: '123',
            IOSSNumber: 'IM1234567891',
            EORINumber: '12345'
        ),
        package: new PackageData(
            weightUnit: WeightUnit::Pound,
            weight: 4.5,
            dimensionsUnit: DimensionUnit::Inches,
            length: 12,
            width: 12,
            height: 12,
            packageReference: '98233310'
        ),
        items: [
            new ItemData(
                sku: '7224059',
                quantity: 2,
                unitPrice: 93.99,
                description: "Women's Shoes",
                hsCode: '640399.30.00',
                countryOfOrigin: Country::CHINA,
                url: '',
                hs: new HarmonizedSystemData(
                    code: '6403993000',
                    region: 'US'
                ),
                dangerousGood: new DangerousGoodData(
                    containsDangerousGoods: true,
                    unCode: 'UN3481',
                    packingGroup: PackingGroup::II,
                    packingInstructions: 'PS967S1',
                    weight: 10,
                    weightUnit: WeightUnit::Kilogram,
                    volume: 30,
                    volumeUnit: VolumeUnit::CubicCentimeter
                )

            ),
        ]
    );

    ray(json_encode($shipment->build()));
});

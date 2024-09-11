<?php

beforeEach(function () {
    $this->shipment = new \SmartDato\DutyRefundsLandmark\Data\Shipment\ShipmentData(
        reference: '3245325',
        shipTo: new \SmartDato\DutyRefundsLandmark\Data\Shipment\AddressData(
            name: 'Test Company',
            attention: 'Ole Olsen',
            address1: '5130 Halford Drive',
            address2: 'Building #C',
            address3: 'Unit 1',
            city: 'Windsor',
            state: 'ON',
            postalCode: 'N9A6J3',
            country: \SmartDato\DutyRefundsLandmark\Enums\Country::CANADA,
            phone: '1-519-737-9101',
            email: 'orders@test.com'
        ),
        orderTotal: 187.98,
        orderInsuranceFreightTotal: 20.65,
        shipmentInsuranceFreight: 20.65,
        itemsCurrency: \SmartDato\DutyRefundsLandmark\Enums\Currency::United_States_Dollar,
        produceLabel: false,
        labelFormat: \SmartDato\DutyRefundsLandmark\Enums\LabelFormat::PDF,
        labelEncoding: \SmartDato\DutyRefundsLandmark\Enums\LabelEncoding::LINKS,
        vendorInformation: new \SmartDato\DutyRefundsLandmark\Data\Shipment\VendorData(
            name: 'Test Company Legal Name',
            phone: '12223334444',
            email: 'contact@vendor.com',
            address1: 'Sample Company Street',
            address2: 'Suite 135',
            city: 'Santa Barbara',
            state: 'CA',
            postalCode: '93101',
            country: \SmartDato\DutyRefundsLandmark\Enums\Country::UNITED_STATES,

            businessNumber: '12345',
            RGRNumber: '123',
            IOSSNumber: 'IM1234567891',
            EORINumber: '12345'
        ),
        package: new \SmartDato\DutyRefundsLandmark\Data\Shipment\PackageData(
            weightUnit: \SmartDato\DutyRefundsLandmark\Enums\Units\WeightUnit::Pound,
            weight: 4.5,
            dimensionsUnit: \SmartDato\DutyRefundsLandmark\Enums\Units\DimensionUnit::Inches,
            length: 12,
            width: 12,
            height: 12,
            packageReference: '98233310'
        ),
        items: [
            new \SmartDato\DutyRefundsLandmark\Data\Shipment\ItemData(
                sku: '7224059',
                quantity: 2,
                unitPrice: 93.99,
                description: "Women's Shoes",
                hsCode: '640399.30.00',
                countryOfOrigin: \SmartDato\DutyRefundsLandmark\Enums\Country::CHINA,
                url: '',
                hs: new \SmartDato\DutyRefundsLandmark\Data\Shipment\HarmonizedSystemData(
                    code: '6403993000',
                    region: 'US'
                ),
                dangerousGood: new \SmartDato\DutyRefundsLandmark\Data\Shipment\DangerousGoodData(
                    containsDangerousGoods: true,
                    unCode: 'UN3481',
                    packingGroup: \SmartDato\DutyRefundsLandmark\Enums\PackingGroup::II,
                    packingInstructions: 'PS967S1',
                    weight: 10,
                    weightUnit: \SmartDato\DutyRefundsLandmark\Enums\Units\WeightUnit::Kilogram,
                    volume: 30,
                    volumeUnit: \SmartDato\DutyRefundsLandmark\Enums\Units\VolumeUnit::CubicCentimeter
                )

            ),
        ]
    );
});

it('fails to create shipment', function () {
    $connector = new \SmartDato\DutyRefundsLandmark\DutyRefundsLandmark;
    $connector->withMockClient(new \Saloon\Http\Faking\MockClient([
        \SmartDato\DutyRefundsLandmark\Requests\Shipment\ImportShipment::class => \Saloon\Http\Faking\MockResponse::fixture('import_shipment.fail.address_validation'),
    ]));

    $response = (new SmartDato\DutyRefundsLandmark\Resource\Shipment($connector))
        ->importShipment($this->shipment);

    expect($response->status())->toBe(400);
});

it('can create shipment', function () {
    $connector = new \SmartDato\DutyRefundsLandmark\DutyRefundsLandmark;
    $connector->withMockClient(new \Saloon\Http\Faking\MockClient([
        \SmartDato\DutyRefundsLandmark\Requests\Shipment\ImportShipment::class => \Saloon\Http\Faking\MockResponse::fixture('import_shipment.success'),
    ]));

    $response = (new SmartDato\DutyRefundsLandmark\Resource\Shipment($connector))
        ->importShipment($this->shipment);

    expect($response->status())->toBe(200);
});

it('can track shipment', function () {
    $connector = new \SmartDato\DutyRefundsLandmark\DutyRefundsLandmark;
    $connector->withMockClient(new \Saloon\Http\Faking\MockClient([
        \SmartDato\DutyRefundsLandmark\Requests\Shipment\TrackShipment::class => \Saloon\Http\Faking\MockResponse::fixture('track_shipment.success'),
    ]));

    $response = (new SmartDato\DutyRefundsLandmark\Resource\Shipment($connector))
        ->trackShipment(trackingNumber: 'xx');

    expect($response->status())->toBe(200);
});

it('can not find shipment tracking', function () {
    $connector = new \SmartDato\DutyRefundsLandmark\DutyRefundsLandmark;
    $connector->withMockClient(new \Saloon\Http\Faking\MockClient([
        \SmartDato\DutyRefundsLandmark\Requests\Shipment\TrackShipment::class => \Saloon\Http\Faking\MockResponse::fixture('track_shipment.fail'),
    ]));

    $response = (new SmartDato\DutyRefundsLandmark\Resource\Shipment($connector))
        ->trackShipment(trackingNumber: 'xx');

    expect($response->status())->toBe(400);
});

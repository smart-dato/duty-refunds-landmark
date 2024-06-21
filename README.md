# Duty Refunds Landmark API SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smart-dato/duty-refunds-landmark.svg?style=flat-square)](https://packagist.org/packages/smart-dato/duty-refunds-landmark)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/duty-refunds-landmark/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smart-dato/duty-refunds-landmark/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/duty-refunds-landmark/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smart-dato/duty-refunds-landmark/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smart-dato/duty-refunds-landmark.svg?style=flat-square)](https://packagist.org/packages/smart-dato/duty-refunds-landmark)

This is a Laravel plugin for the [Duty Refunds Landmark API](https://duty-refunds-landmark.redoc.ly/) 

## Installation

You can install the package via composer:

```bash
composer require smart-dato/duty-refunds-landmark
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="duty-refunds-landmark-config"
```

This is the contents of the published config file:

```php
return [
    'url' => env('DUTY_REFUNDS_LANDMARK_URL', 'https://api.stage.dutyrefunds.co.uk/landmark'),
    'username' => env('DUTY_REFUNDS_LANDMARK_USERNAME', ''),
    'password' => env('DUTY_REFUNDS_LANDMARK_PASSWORD', ''),
];
```

## Usage

```php
    $shipment = new \SmartDato\DutyRefundsLandmark\Data\Shipment\ShipmentData(
        reference: "3245325",
        shipTo: new \SmartDato\DutyRefundsLandmark\Data\Shipment\AddressData(
            name: "Test Company",
            attention: "Ole Olsen",
            address1: "5130 Halford Drive",
            address2: "Building #C",
            address3: "Unit 1",
            city: "Windsor",
            state: "ON",
            postalCode: "N9A6J3",
            country: \SmartDato\DutyRefundsLandmark\Enums\Country::CANADA,
            phone: "1-519-737-9101",
            email: "orders@test.com"
        ),
        orderTotal: 187.98,
        orderInsuranceFreightTotal: 20.65,
        shipmentInsuranceFreight: 20.65,
        itemsCurrency: \SmartDato\DutyRefundsLandmark\Enums\Currency::United_States_Dollar,
        produceLabel: false,
        labelFormat: \SmartDato\DutyRefundsLandmark\Enums\LabelFormat::PDF,
        labelEncoding: \SmartDato\DutyRefundsLandmark\Enums\LabelEncoding::LINKS,
        vendorInformation: new \SmartDato\DutyRefundsLandmark\Data\Shipment\VendorData(
            name: "Test Company Legal Name",
            phone: "12223334444",
            email: "contact@vendor.com",
            address1: "Sample Company Street",
            address2: "Suite 135",
            city: "Santa Barbara",
            state: "CA",
            postalCode: "93101",
            country: \SmartDato\DutyRefundsLandmark\Enums\Country::UNITED_STATES,

            businessNumber: "12345",
            RGRNumber: "123",
            IOSSNumber: "IM1234567891",
            EORINumber: "12345"
        ),
        package: new \SmartDato\DutyRefundsLandmark\Data\Shipment\PackageData(
            weightUnit: \SmartDato\DutyRefundsLandmark\Enums\Units\WeightUnit::Pound,
            weight: 4.5,
            dimensionsUnit: \SmartDato\DutyRefundsLandmark\Enums\Units\DimensionUnit::Inches,
            length: 12,
            width: 12,
            height: 12,
            packageReference: "98233310"
        ),
        items: [
            new \SmartDato\DutyRefundsLandmark\Data\Shipment\ItemData(
                sku: "7224059",
                quantity: 2,
                unitPrice: 93.99,
                description: "Women's Shoes",
                hsCode: "640399.30.00",
                countryOfOrigin: \SmartDato\DutyRefundsLandmark\Enums\Country::CHINA,
                url: "",
                hs: new \SmartDato\DutyRefundsLandmark\Data\Shipment\HarmonizedSystemData(
                    code: '6403993000',
                    region: 'US'
                ),
                dangerousGood: new \SmartDato\DutyRefundsLandmark\Data\Shipment\DangerousGoodData(
                    containsDangerousGoods: true,
                    unCode: "UN3481",
                    packingGroup: \SmartDato\DutyRefundsLandmark\Enums\PackingGroup::II,
                    packingInstructions: "PS967S1",
                    weight: 10,
                    weightUnit: \SmartDato\DutyRefundsLandmark\Enums\Units\WeightUnit::Kilogram,
                    volume: 30,
                    volumeUnit: \SmartDato\DutyRefundsLandmark\Enums\Units\VolumeUnit::CubicCentimeter
                )

            ),
        ]
    );

    $connector = new \SmartDato\DutyRefundsLandmark\DutyRefundsLandmark();
    $response = (new \SmartDato\DutyRefundsLandmark\Resource\Shipment($connector))
        ->importShipment($shipment);


```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [SmartDato](https://github.com/smart-dato)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

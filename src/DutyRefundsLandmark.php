<?php

namespace SmartDato\DutyRefundsLandmark;

use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Connector;
use SmartDato\DutyRefundsLandmark\Resource\LandedCost;
use SmartDato\DutyRefundsLandmark\Resource\Shipment;

/**
 * Duty Refunds Landmark API
 *
 * ### Overview
 *
 * The Duty Refunds Landmark API can be used to create Landmark and Amazon Shipping shipping labels
 * for eCommerce parcels that are being shipped from Landmark's facility in Brussels to the United
 * Kingdom. This ensures the created shipping labels are compliant and utilizes Duty Refunds' accounts
 * for duty & VAT management. This API can also be used to track and cancel shipments, as well as to
 * create return shipping labels.
 *
 *
 * ### Authentication
 *
 * - The API uses a Basic Auth scheme for secure access.
 *
 * - Authentication requires the Duty Refunds API key and secret for verification.
 *
 *
 * ### Rate Limits and Throttling
 *
 * **Application-level limit:** 300 requests per 1 minute, per endpoint, per client API user
 *
 *
 * ### Getting Access
 *
 * - Obtain a Duty Refunds API key by contacting your account manager or partnerships@dutyrefunds.co.uk
 */
class DutyRefundsLandmark extends Connector
{
    public function __construct(
        public readonly ?string $username = null,
        public readonly ?string $password = null
    ) {}

    public function resolveBaseUrl(): string
    {
        return config('duty-refunds-landmark.url');
    }

    protected function defaultAuth(): BasicAuthenticator
    {
        return new BasicAuthenticator(
            $this->username ?? config('duty-refunds-landmark.username'),
            $this->password ?? config('duty-refunds-landmark.password')
        );
    }

    public function landedCost(): LandedCost
    {
        return new LandedCost($this);
    }

    public function shipment(): Shipment
    {
        return new Shipment($this);
    }
}

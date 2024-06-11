<?php

namespace SmartDato\DutyRefundsLandmark\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SmartDato\DutyRefundsLandmark\DutyRefundsLandmark
 */
class DutyRefundsLandmark extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SmartDato\DutyRefundsLandmark\DutyRefundsLandmark::class;
    }
}

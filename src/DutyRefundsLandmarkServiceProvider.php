<?php

namespace SmartDato\DutyRefundsLandmark;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DutyRefundsLandmarkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('duty-refunds-landmark')
            ->hasConfigFile();
    }
}

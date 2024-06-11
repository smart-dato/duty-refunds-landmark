<?php

namespace SmartDato\DutyRefundsLandmark;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use SmartDato\DutyRefundsLandmark\Commands\DutyRefundsLandmarkCommand;

class DutyRefundsLandmarkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('duty-refunds-landmark')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_duty-refunds-landmark_table')
            ->hasCommand(DutyRefundsLandmarkCommand::class);
    }
}

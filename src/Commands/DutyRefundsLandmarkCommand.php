<?php

namespace SmartDato\DutyRefundsLandmark\Commands;

use Illuminate\Console\Command;

class DutyRefundsLandmarkCommand extends Command
{
    public $signature = 'duty-refunds-landmark';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

<?php

namespace Soandso\LaravelOptions\Console;

use DateTime;
use Illuminate\Console\Command;
use Soandso\LaravelOptions\Jobs\ClearOptionsJob;

class ClearOption extends Command
{
    protected $signature = 'option:clear {date? : Date in Y-m-d format, records older than which should be deleted}';

    protected $description = 'Deletes stored parameter values; Specify the date in the Y-m-d format, records made after which you want to delete';

    public function handle()
    {
        $date = null;
        if ($this->argument('date')) {
            $date = $this->argument('date');
        }

        if (!is_null($date) && $this->validateDate($date) === false) {
            $this->error('The date format is incorrect! That\'s right Y-m-d');
            return false;
        }

        if ($this->confirm('Are you sure you want to delete the specified entries? Deletion without the possibility of recovery', true)) {
            ClearOptionsJob::dispatch($date);
            $this->info('Delete records started! It can take some time');
        }

        $this->error('Delete entries cancelled!');
    }

    private function validateDate(string $date) : bool
    {
        $dateFormat = 'Y-m-d';
        $result = preg_match('@^(\d\d\d\d)-(\d\d)-(\d\d)$@', $date, $matches);
        if (!$result) {
            return false;
        }

        $dateObject = DateTime::createFromFormat($dateFormat, $date);

        return $dateObject && $dateObject->format($dateFormat) == $date;
    }
}
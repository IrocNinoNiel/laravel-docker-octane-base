<?php

declare(strict_types=1);

namespace App\Traits;

trait EventLogging
{
    public function logEvent(string $title, mixed $data): void
    {
        info($title);
        info($data);
        echo $title . PHP_EOL;
    }
}

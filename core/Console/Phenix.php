<?php

declare(strict_types=1);

namespace Core\Console;

use Core\Util\Directory;
use Core\Util\NamespaceResolver;
use Symfony\Component\Console\Application;

class Phenix extends Application
{
    public function __construct()
    {
        parent::__construct('Phenix', '0.0.1');
    }

    public function registerCommands(): void
    {
        $commands = Directory::all(self::getCommandsPath());

        foreach ($commands as $command) {
            $command = NamespaceResolver::parse($command);

            $this->add(new $command());
        }
    }

    private static function getCommandsPath(): string
    {
        return base_path('core'. DIRECTORY_SEPARATOR . 'Console' . DIRECTORY_SEPARATOR . 'Commands');
    }
}

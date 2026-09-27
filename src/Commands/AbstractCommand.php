<?php declare(strict_types=1);

namespace PrinsFrank\PHPRIG\Commands;

use Symfony\Component\Console\Command\Command;

abstract class AbstractCommand extends Command {
    public function __construct(
        protected readonly string $projectRoot,
    ) {
        parent::__construct();
    }
}
<?php declare(strict_types=1);

namespace PrinsFrank\PHPRIG\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalyseCommand extends AbstractCommand {
    protected function configure(): void {
        $this->setName('analyse')
            ->setDescription('Analyse a project');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        return self::SUCCESS;
    }
}
<?php declare(strict_types=1);

namespace PrinsFrank\PHPRIG\Commands;

use PrinsFrank\PHPRIG\Config\Config;
use PrinsFrank\PHPRIG\Config\ListOfStrings;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class InitCommand extends AbstractCommand {
    protected function configure(): void {
        $this->setName('init')
            ->setDescription('Initialize configuration');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        if ($input->isInteractive() === false) {
            $output->writeln('Initialization can only be run in interactive mode');
            return self::FAILURE;
        }

        $configPath = $this->projectRoot . '/phprig.json';
        if (file_exists($configPath)) {
            $output->writeln('Configuration file already exists');
            return self::FAILURE;
        }

        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');
        $pathsToAnalyse = [];
        while (($pathToAnalyse = $questionHelper->ask($input, $output, new Question('(Leave empty to skip) Add a relative path to analyze: '))) !== null) {
            if (file_exists($this->projectRoot . '/' . $pathToAnalyse) === false) {
                $output->writeln('-> Path doesn\'t exist, skipped');
                continue;
            }

            $pathsToAnalyse[] = $pathToAnalyse;
        }

        $config = new Config(new ListOfStrings(...$pathsToAnalyse));
        $json = json_encode($config, JSON_PRETTY_PRINT) . PHP_EOL;
        $output->writeln($json);
        if ($questionHelper->ask($input, $output, new ConfirmationQuestion('Is this configuration correct? (y) ')) === false) {
            return self::FAILURE;
        }

        if (file_put_contents($configPath, $json) === false) {
            $output->writeln('Failed to write configuration');
            return self::FAILURE;
        }

        $output->writeln(sprintf('File written to %s', $configPath));
        return self::SUCCESS;
    }
}
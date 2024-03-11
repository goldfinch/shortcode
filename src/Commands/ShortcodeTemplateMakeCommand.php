<?php

namespace Goldfinch\Shortcode\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:shortcode-template')]
class ShortcodeTemplateMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:shortcode-template';

    protected $description = 'Create shortcode template';

    protected $path = 'themes/[theme]/templates/Shortcodes';

    protected $type = 'shortcode template';

    protected $stub = 'shortcode-template.stub';

    protected $extension = '.ss';

    protected function execute($input, $output): int
    {
        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}

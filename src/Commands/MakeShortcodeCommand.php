<?php

namespace Goldfinch\Shortcode\Commands;

use Goldfinch\Taz\Services\InputOutput;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Question\ChoiceQuestion;

#[AsCommand(name: 'make:shortcode')]
class MakeShortcodeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:shortcode';

    protected $description = 'Make shortcode';

    protected $no_arguments = true;

    protected function execute($input, $output): int
    {
        $tagname = $this->askClassNameQuestion('What [shortcode tag name] should we use? (eg: br, hr, sp, mysupertag)', $input, $output);

        // find config
        $config = $this->findYamlConfigFileByName('app-shortcodes');

        // create new config if not exists
        if (!$config) {

            $command = $this->getApplication()->find('make:config');
            $command->run(new ArrayInput([
                'name' => 'shortcodes',
                '--plain' => true,
                '--after' => 'goldfinch/shortcodes',
                '--nameprefix' => 'app-',
            ]), $output);

            $config = $this->findYamlConfigFileByName('app-shortcodes');
        }

        // update config
        $this->updateYamlConfig(
            $config,
            'Goldfinch\Shortcode\Shortcode' . '.allow_shortcodes',
            [$tagname]
        );

        // add shortcode template

        $command = $this->getApplication()->find('make:shortcode-template');
        $command->run(new ArrayInput([
            'name' => $tagname
        ]), $output);

        return Command::SUCCESS;
    }
}

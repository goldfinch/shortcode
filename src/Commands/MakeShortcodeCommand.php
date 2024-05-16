<?php

namespace Goldfinch\Shortcode\Commands;

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
        $tagname = $this->askClassNameQuestion(
            'What [shortcode tag name] should we use? (eg: br, hr, sp, mysupertag)',
            $input,
            $output
        );

        $sctYes = 'yes (for [hr], [br], etc.)';
        $sctNo = 'no (for [sp]text[/sp], etc.)';
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion('Self closing tag?', [$sctNo, $sctYes]);
        $question->setErrorMessage('The selection %s is invalid.');
        $selfClosingTag = $helper->ask($input, $output, $question);

        $description = $this->askStringQuestion('Description:', $input, $output, '');

        // TODO
        $restricted = false;

        $selfClosingTag = $selfClosingTag == $sctYes ? true : false;

        $options = [
            'self_closing' => $selfClosingTag,
            'description' => $description ? $description : '',
            'restricted' => $restricted,
        ];

        // find config
        $config = $this->findYamlConfigFileByName('app-shortcodes');

        // create new config if not exists
        if (! $config) {
            $command = $this->getApplication()->find('make:config');
            $command->run(
                new ArrayInput([
                    'name' => 'shortcodes',
                    '--plain' => true,
                    '--after' => 'goldfinch/shortcodes',
                    '--nameprefix' => 'app-',
                ]),
                $output
            );

            $config = $this->findYamlConfigFileByName('app-shortcodes');
        }

        // update config
        $this->updateYamlConfig($config, 'Goldfinch\Shortcode\Shortcode'.'.allow_shortcodes.'.$tagname, $options);

        // add shortcode template

        $command = $this->getApplication()->find('make:shortcode-template');
        $command->run(
            new ArrayInput([
                'name' => $tagname,
                '--selfclosing' => $selfClosingTag,
            ]),
            $output
        );

        return Command::SUCCESS;
    }
}

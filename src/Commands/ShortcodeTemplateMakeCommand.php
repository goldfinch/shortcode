<?php

namespace Goldfinch\Shortcode\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\ChoiceQuestion;

#[AsCommand(name: 'make:shortcode-template')]
class ShortcodeTemplateMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:shortcode-template';

    protected $description = 'Create shortcode template';

    protected $path = 'themes/[theme]/templates/Shortcodes';

    protected $type = 'shortcode template';

    protected $stub = 'shortcode-template.stub';

    protected $extension = '.ss';

    protected $selfClosingTag = false;

    protected function configure(): void
    {
        parent::configure();

        $this->addOption(
            'selfclosing',
            null,
            InputOption::VALUE_OPTIONAL,
            'Self closing tag'
        );
    }

    protected function execute($input, $output): int
    {
        $selfclosing = $input->getOption('selfclosing');

        if (is_bool($selfclosing)) {
            $this->selfClosingTag = $selfclosing;
        } else {
            $sctYes = 'yes (for [hr], [br], etc.)';
            $sctNo = 'no (for [sp]text[/sp], etc.)';
            $helper = $this->getHelper('question');
            $question = new ChoiceQuestion(
                'Self closing tag?',
                [$sctNo, $sctYes]
            );
            $question->setErrorMessage('The selection %s is invalid.');
            $selfClosingTag = $helper->ask($input, $output, $question);

            $this->selfClosingTag = $selfClosingTag == $sctYes ? true : false;
        }

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    protected function replacer()
    {
        if ($this->selfClosingTag) {
            $template = '<hr>';
        } else {
            $template = '<strong>$content</strong>';
        }

        return [
            [true, '{{ __template }}', $template],
        ];
    }
}

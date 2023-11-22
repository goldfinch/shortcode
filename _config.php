<?php

use Goldfinch\Shortcode\Shortcode;
use SilverStripe\View\Parsers\ShortcodeParser;

$dir = THEMES_PATH . '/' . ss_theme() . '/templates/Shortcodes/';
$files = scandir($dir);

if (is_dir($dir))
{
    if (count($files))
    {
        foreach($files as $file)
        {
            if (substr($file, -3) == '.ss')
            {
                $name = substr($file, 0, -3);

                ShortcodeParser::get('default')->register($name, [Shortcode::class, 'sc_dynamic']);
            }
        }
    }
}

// dd(ShortcodeParser::get_active()->parse('Here are a few [hh]reasons[/hh] why our [xx] customers choose Sandbox.'));

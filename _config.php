<?php

use SilverStripe\View\Parsers\ShortcodeParser;
use SilverStripe\CMS\Model\SiteTree;

$dir = THEMES_PATH . '/' . ss_theme() . '/templates/Shortcodes/';
$files = scandir($dir);

if (count($files))
{
    foreach($files as $file)
    {
        if (substr($file, -3) == '.ss')
        {
            $name = substr($file, 0, -3);

            ShortcodeParser::get('default')->register($name, [SiteTree::class, 'sc_dynamic']);
        }
    }
}

// dd(ShortcodeParser::get_active()->parse('Here are a few [hh]reasons[/hh] why our [xx] customers choose Sandbox.'));

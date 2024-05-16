<?php

namespace Goldfinch\Shortcode;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\View\ArrayData;

class Shortcode extends SiteTree
{
    private static $db = [];

    private static $has_one = [];

    private static $casting = [
        'sc_dynamic' => 'HTMLText',
    ];

    public static function sc_dynamic($arguments, $content = null, $parser = null, $tagName = null)
    {
        $sctheme = 'Shortcodes/'.$tagName;

        $data = ArrayData::create(['content' => $content]);

        if (ss_theme_template_file_exists($sctheme)) {
            return $data->renderWith($sctheme);
        } else {
            $sctheme .= '-'.$tagName;

            if (ss_theme_template_file_exists($sctheme)) {
                return $data->renderWith($sctheme);
            }
        }

        // return "<em>" . $content . "</em> " . $content . "; " . count($arguments) . " arguments.";
    }
}

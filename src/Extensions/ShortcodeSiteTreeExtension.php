<?php

namespace Goldfinch\Shortcode\Extensions;

use SilverStripe\CMS\Model\SiteTreeExtension;
use SilverStripe\View\ArrayData;
use SilverStripe\CMS\Model\SiteTree;

class ShortcodeSiteTreeExtension extends SiteTreeExtension
{
    private static $db = [];

    private static $has_one = [];

    private static $casting = [
        'sc_dynamic' => 'HTMLText'
    ];

    public static function sc_dynamic($arguments, $content = null, $parser = null, $tagName = null)
    {
        $sctheme = 'Shortcodes/' . $tagName;

        $data = ArrayData::create(['content' => $content]);

        if (ss_theme_template_file_exists($sctheme))
        {
            return $data->renderWith($sctheme);
        }
        else
        {
            $sctheme .=  '-' . $tagName;

            if (ss_theme_template_file_exists($sctheme))
            {
                return $data->renderWith($sctheme);
            }
        }

        // return "<em>" . $content . "</em> " . $content . "; " . count($arguments) . " arguments.";
    }
}

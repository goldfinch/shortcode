<?php

namespace Goldfinch\Shortcode\ORM\FieldType;

use Goldfinch\Shortcode\Shortcode;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBHTMLVarchar;

class DBSCVarchar extends DBHTMLVarchar
{
    protected $processShortcodes = true;

    public function scaffoldFormField($title = null, $params = null)
    {
        return TextField::create($this->name, $title)->setDescription($this->getShortcodeDescription());
    }

    public function getShortcodeDescription()
    {
        $cfg = ss_config(Shortcode::class, 'allow_shortcodes');

        $description = '';

        $onclick = ' onclick="(function(e) {
            var range = document.createRange();
            range.selectNode(e);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand(\'copy\');
            window.getSelection().removeAllRanges();
            setTimeout(() => jQuery(e).animate({top: \'-10px\', opacity: 0}, 250), 250)
            setTimeout(() => jQuery(e).animate({top: 0}, 0).animate({opacity: 1}, 250), 500)
        })(this)"';

        if (isset($cfg)) {
            foreach ($cfg as $tag => $options) {
                $description .=
                    '<div><span style="color: var(--bs-cyan); cursor: pointer; position: relative" title="Click to copy"'.
                    $onclick.
                    '>'.
                    ($options['self_closing']
                        ? '<strong'.$onclick.' style="font-weight: bold">['.$tag.']</strong>'
                        : '<strong style="font-weight: bold">['.
                            $tag.
                            ']</strong><span style="color: #a3a3a3; font-style: italic; padding: 0 3px">text</span><strong style="font-weight: bold">[/'.
                            $tag.
                            ']</strong>').
                    '</span> - <span style="color: #a3a3a3">'.
                    $options['description'].
                    '</span></div>';
            }
        }

        return $description != ''
            ? '<span style="display: flex; justify-content: space-between"><span>Available shortcodes:</span><span style="color: #a3a3a3; font-size: 11px; font-style: italic">click to copy</span></span><div style="margin-top: 10px;background-color: #fdfdfd;border: 1px solid #eee;border-radius: var(--bs-border-radius);padding: 5px 10px;">'.
                    $description.
                    '</div>'
            : '';
    }
}

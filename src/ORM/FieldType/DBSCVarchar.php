<?php

namespace Goldfinch\Shortcode\ORM\FieldType;

use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBHTMLVarchar;

class DBSCVarchar extends DBHTMLVarchar
{
    public function scaffoldFormField($title = null, $params = null)
    {
        return TextField::create($this->name, $title);
    }
}

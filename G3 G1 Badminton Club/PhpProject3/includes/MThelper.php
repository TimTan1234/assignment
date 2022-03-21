<?php

// Return an array of all genders.
function getGenders()
{
    return array(
        'F' => 'Female',
        'M' => 'Male'
    );
}

///////////////////////////////////////////////////////////////////////////////
// HTML helpers ///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////


// Print a <input type="text"> element.
function htmlInputText($name, $value = '', $maxlength = '')
{
    printf('<input type="digit" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}

// Print a <input type="text"> element.
function htmlInputTel($phone, $value = '', $maxlength = '')
{
    printf('<input type="text" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $phone, $phone, $value, $maxlength);
}

// Print a group of <input type="radio"> elements.
function htmlRadioList($name, $items, $selectedValue = '', $break = false)
{
    foreach ($items as $value => $text)
    {
        printf('
            <input type="radio" name="%s" id="%s" value="%s" %s />
            <label for="%s">%s</label>' . "\n",
            $name, $value, $value,
            $value == $selectedValue ? 'checked="checked"' : '',
            $value, $text);

        if ($break)
            echo "<br />\n";
    }
}


?>
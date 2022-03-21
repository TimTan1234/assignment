<?php

// Return an array of all genders.
function getGenders()
{
    return array(
        'F' => 'Female',
        'M' => 'Male'
    );
}

/*function validateStudentID($id)
{
    if ($id == null)
    {
        return 'Please enter <strong>Student ID</strong>.';
    }
    else if (!preg_match('/^\d{2}[A-Z]{3}\d{5}$/', $id))
    {
        return '<strong>Student ID</strong> is of invalid format. Format: 99XXX99999.';
    }
    else if (isStudentIDExist($id))
    {
        return '<strong>Student ID</strong> given already exist. Try another.';
    }
}

// Check if Student ID already exist.
// Used by function validateStudentID().
function isStudentIDExist($id)
{
    $exist = false;

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $id  = $con->real_escape_string($id);
    $sql = "SELECT * FROM register WHERE Student_ID = '$id'";

    if ($result = $con->query($sql))
    {
        if ($result->num_rows > 0)
        {
            $exist = true;
        }
    }

    $result->free();
    $con->close();

    return $exist;
}*/


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

function htmlInputPassword($name, $value = '', $maxlength = '') {
        printf('<input style="font-family: verdana" type="password" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
               $name, $name, $value, $maxlength);
    }
?>
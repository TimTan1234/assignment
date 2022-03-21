<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'badmintonclub');

function getGenders() {
    return array(
        'M' => 'Male',
        'F' => 'Female'
    );
}

function getQty() {
    return array(
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
    );
}

$GENDERS = getGenders();
$QTY     = getQty();

function htmlInputText($name, $value = '', $maxlength = '') {
        printf('<input type="text" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
                $name, $name, $value, $maxlength);
}

function htmlInputPassword($name, $value = '', $maxlength = '') {
        printf('<input style="font-family: verdana" type="password" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
               $name, $name, $value, $maxlength);
}

function htmlRadioList($name, $items, $selectedValue = '', $break = false)  {
        foreach ($items as $value => $text) {
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

function htmlSelect($name, $items, $selectedValue = '', $default = '')
{
    printf('<select name="%s" id="%s">' . "\n",
           $name, $name);

    if ($default != null)
    {
        printf('<option value="">%s</option>', $default);
    }

    foreach ($items as $value => $text)
    {
        printf('<option value="%s" %s>%s</option>' . "\n",
               $value,
               $value == $selectedValue ? 'selected="selected"' : '',
               $text);
    }
    
    echo "</select>\n";
}

function htmlInputHidden($name, $value = '')
{
    printf('<input type="hidden" name="%s" id="%s" value="%s" />' . "\n",
           $name, $name, $value);
}

function validateStudentID($id)
{
    if ($id == null)
    {
        return 'Please enter <strong>Student ID</strong>.';
    }
    else if (!preg_match('/^\d{7}$/', $id))
    {
        return 'Invalid format Student ID. Format: 9999999.';
    }
    else if (isStudentIDExist($id))
    {
        return 'This Student ID is already exist. Pls try again.';
    }
}

function isStudentIDExist($id)
{
    $exist = false;

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $id  = $con->real_escape_string($id);
    $sql = "SELECT * FROM Member WHERE StudentID = '$id'";

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
}

function validateStudentName($studname)
{
    if ($studname == null)
    {
        return 'Please enter your student name.';
    }
    else if (strlen($studname) > 20)
    {
        return 'Student name must not more than 20 letters.';

    }
    else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $studname))
    {
        return 'There are some invalid letters in student name.';
    }
}

function unvalidateStudentID($id)
{
    if ($id == null)
    {
        return 'Please enter <strong>Student ID</strong>.';
    }
    else if (!preg_match('/^\d{7}$/', $id))
    {
        return 'Invalid format Student ID. Format: 9999999.';
    }
    else if (notStudentIDExist($id))
    {
        return 'Pls register an account first.';
    }
}

function notStudentIDExist($id)
{
    $exist = true;

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $id  = $con->real_escape_string($id);
    $sql = "SELECT * FROM Member WHERE StudentID = '$id'";

    if ($result = $con->query($sql))
    {
        if ($result->num_rows > 0)
        {
            $exist = false;
        }
    }

    $result->free();
    $con->close();

    return $exist;
}
?>

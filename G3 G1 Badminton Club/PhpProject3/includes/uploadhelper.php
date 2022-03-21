<?php
///////////////////////////////////////////////////////////////////////////////
// Database connection details ////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Constants. Please change accordingly.


function getGenders()
{
    return array(
        'F' => 'Female',
        'M' => 'Male'
    );
}

///////////////////////////////////////////////////////////////////////////////
// Lookup tables //////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// HTML helpers ///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Print a <input type="text"> element.
function htmlInputText($name, $value = '', $maxlength = '')
{
    printf('<input type="text" name="%s" id="%s" value="%s" maxlength="%s" />' . "\n",
           $name, $name, $value, $maxlength);
}

//Print a <input type="date"> element.
/*function htmlInputDate($name, $value)
{
    printf('<input type="date" name"%s" id="%s" value="%s" required/>'."\n",
            $name, $name, $value);
}*/

function htmlInputTextArea($name, $value = '', $maxlength = '')
{
    printf('<textarea type="text" name="%s" id="%s" value="%s" maxlength="%s"  rows="4" cols="40"/> </textarea>' . "\n",
           $name, $name, $value, $maxlength);
}

// Print a <input type="hidden"> element.
function htmlInputHidden($name, $value = '')
{
    printf('<input type="hidden" name="%s" id="%s" value="%s" />' . "\n",
           $name, $name, $value);
}

function htmlInputInt($name, $value)
{
    printf('<input type="number" name="%s" id="%s" value="%s" />' . "\n",
           $name, $name, $value);
}

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
///////////////////////////////////////////////////////////////////////////////
// Validators /////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Validate Event Name
// Return nothing if no error.
function validateEventName($event)
{
    if ($event == null)
    {
        return 'Please enter <strong>Event Name</strong>.';
    }
    else if (strlen($event) > 50) // Prevent hacks.
    {
        return '<strong>Event Name</strong> must not more than 50 letters.';

    }
    else if (isEventnameExist($event))
    {
        return '<strong>Event Name</strong> given already exist. Try another.';
    }
}

// Check if Event name already exist.
// Used by function validateEventName().
function isEventNameExist($event)
{
    $exist = false;

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $id  = $con->real_escape_string($event);
    $sql = "SELECT * FROM event WHERE Event_name = '$event'";

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

// Validate Date.
// Return nothing if no error.
function validateDate($date)
{
    if ($date == null)
    {
        return 'Please enter <strong>Date</strong>.';
    }
}

// Validate Gathering Time
// Return nothing if no error.
function validateGatheringTime($GT)
{
    if ($GT == null)
    {
        return 'Please enter a <strong>Gathering Time</strong>.';
    }
    else if (strlen($GT) > 50) // Prevent hacks.
    {
        return '<strong>Gathering Time</strong> must not more than 50 letters.';
    }
}

// Validate Category Included.
// Return nothing if no error.
function validateCategoryIncluded($CI)
{
    if ($CI == null)
    {
        return 'Please enter a <strong>Category Included</strong>.';
    }
    else if (strlen($CI) > 1000) // Prevent hacks.
    {
        return '<strong>Category Included</strong> must not more than 1000 letters.';
    }
}

function validateBenefit($BTBC)
{
     if ($BTBC == null)
    {
        return 'Please enter a <strong>Benefit To Become Committees</strong>.';
    }
    else if (strlen($BTBC) > 1000) // Prevent hacks.
    {
        return '<strong>Benefit To Become Committees</strong> must not more than 1000 letters.';
    }
}

function validateAttention($attention)
{
    if ($attention == null)
    {
        return 'Please enter a <strong>Attention</strong>.';
    }
    else if (strlen($attention) > 1000) // Prevent hacks.
    {
        return '<strong>Attention</strong> must not more than 1000 letters.';
    }
}

function validateRegistrationFees($RF)
{
    if ($RF == null)
    {
        return 'Please enter a <strong>Registration Fees</strong>.';
    }
    else if (strlen($RF) > 50) // Prevent hacks.
    {
        return '<strong>Registration Fees</strong> must not more than 1000 letters.';
    }
}
function validateVenue($venue){
     if ($venue == null)
    {
        return 'Please enter a <strong>Venue</strong>.';
    }
    else if (strlen($venue) > 50) // Prevent hacks.
    {
        return '<strong>Venue</strong> must not more than 50 letters.';
    }
}

function validatePrice($price){
    if($price == null){
        return 'Plese enter a <strong>Price</strong>.';
    }
}

function validateStatus($status){
    if($status == null){
        return 'Please enter a <strong>Status</strong>.';
    }
    else if(strlen($status) > 50 )
    {
        return '<strong>Status</strong> must not more than 50 letters.';
    }
}
?>
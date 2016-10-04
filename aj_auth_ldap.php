<?php

/*
 * This Code has been created by Christopher Uzhuthuval
 * for the Project College Information System.
 */
session_start();
include 'classes/Ldap.php';

$username = $_GET[username];
$password = $_GET[password];

$objectLdap = new Ldap();
$objectLdap->setUserPass($username, $password);

$firstcharc = str_split($username);

if (($firstcharc[0] == 'T') && strlen($username) == 6)
{
    $objectLdap->tempStudAuth();
}
else
{
    $objectLdap->ldapAuth();
}

?>

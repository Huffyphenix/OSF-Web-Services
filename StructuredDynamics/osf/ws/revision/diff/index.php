<?php

/*! @ingroup WsRevision Revisioning Web Service   */
//@{

/*! @file \StructuredDynamics\osf\ws\revision\diff\index.php
    @brief Entry point of a query for the Revision: Diff web service
 */
 
include_once("../../../../SplClassLoader.php"); 
  
use \StructuredDynamics\osf\ws\revision\diff\RevisionDiff;
 
// Don't display errors to the users. Set it to "On" to see errors for debugging purposes.
ini_set("display_errors", "Off"); 

ini_set("memory_limit", "64M");

// Check if the HTTP method used by the requester is the good one
if ($_SERVER['REQUEST_METHOD'] != 'GET') 
{
  header("HTTP/1.1 405 Method Not Allowed");  
  die;
}

// Interface to use for this query
$interface = "default";

if(isset($_GET['interface']))
{
  $interface = $_GET['interface'];
}

// Version of the requested interface to use for this query
$version = "";

if(isset($_GET['version']))
{
  $version = $_GET['version'];
}

$dataset = "";

if(isset($_GET['dataset']))
{
  $dataset = $_GET['dataset'];
}

$lrevuri = "";

if(isset($_GET['lrevuri']))
{
  $lrevuri = $_GET['lrevuri'];
}

$rrevuri = "";

if(isset($_GET['rrevuri']))
{
  $rrevuri = $_GET['rrevuri'];
}

$ws_rd = new RevisionDiff($lrevuri, $rrevuri, $dataset, $interface, $version);

$ws_rd->ws_conneg((isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : ""), 
                  (isset($_SERVER['HTTP_ACCEPT_CHARSET']) ? $_SERVER['HTTP_ACCEPT_CHARSET'] : ""), 
                  (isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : ""), 
                  (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : "")); 

$ws_rd->process();

$ws_rd->ws_respond($ws_rd->ws_serialize());

//@}

?>
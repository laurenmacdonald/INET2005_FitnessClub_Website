<?php
/**
 * Configuring session
 */
// setting these options to true.
// session use only cookies ensures that the session is only set using cookies and not something else like the URL
// use strict mode ensures that the website only uses a session created by this website, also makes the session id more complex
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// function that allows the lifetime of the cookie, domain it runs on, the path (any), only use secure connection (https), httponly to true to avoid allowing user to change things via js
session_set_cookie_params(['lifetime' => 1800, 'domain'=> 'localhost', 'path' => '/', 'secure' => true, 'httponly' => true]);

//session started after setting parameters
session_start();
// if condition that updates every 30 minutes to regenerate the cookie to make session more secure
// First check to see if a user is logged in, if yes then append their id
if(isset($_SESSION["user_id"])){
    if(!isset($_SESSION["regeneratedIDTime"])){
        sessionRegenerationIDLoggedIn();
    } else {
        //update session id after 30 minutes
        $interval = 60 * 30;
        if(time() - $_SESSION["regeneratedIDTime"] >= $interval){
            sessionRegenerationIDLoggedIn();
        }
    }
} else {
    if(!isset($_SESSION["regeneratedIDTime"])){
        sessionRegeneration();
    } else {
        //update session id after 30 minutes
        $interval = 60 * 30;
        if(time() - $_SESSION["regeneratedIDTime"] >= $interval){
            sessionRegeneration();
        }
    }
}


function sessionRegeneration(): void
{
    // using the time method to get the current time aka the time that the session ID was last regenerated
    session_regenerate_id(true);
    $_SESSION["regeneratedIDTime"] = time();
}

function sessionRegenerationIDLoggedIn(): void
{
    session_regenerate_id(true);

    // Update the session id to append the user id
    $userID = $_SESSION["user_id"];
    $newSessionID = session_create_id();
    $sessionID = $newSessionID."_".$userID;
    session_id($sessionID);

    $_SESSION["regeneratedIDTime"] = time();
}
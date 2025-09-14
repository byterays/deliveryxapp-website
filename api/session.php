<?php 
// Must be before session_start()
ini_set('session.gc_maxlifetime', 7200);   // Server keeps session data for 2 hours
ini_set('session.cookie_lifetime', 7200); // Cookie valid for 2 hours

session_set_cookie_params(7200);
session_start();
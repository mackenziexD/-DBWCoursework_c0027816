<?php

function clean_data($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isLoggedInAsUser($session) {
    return array_key_exists("loggedin", $session) && true === $session["loggedin"];
  }
  
  function isLoggedInAsAdmin($session) {
    return array_key_exists("Adminloggedin", $session) && true === $session["Adminloggedin"];
  }
  
  function isLoggedIn($session) {
    return isLoggedInAsUser($session) || isLoggedInAsAdmin($session);
  }
  
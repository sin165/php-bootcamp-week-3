<?php

function modifier($score) {
  if($score % 2 === 1){
    $score--;
  }
  $modifier = $score / 2 - 5;
  if ($modifier>=0){
    return '+'.$modifier;
  }else{
    return $modifier;
  }
}

function validate_text($text) {
  global $message;
  $text = test_input($text);
  if (!preg_match("/^[a-zA-Z]{0,50}$/",$text)) {
      $message = "Only English letters allowed. Max length - 50.";
      return '';
  } else {
      return $text;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

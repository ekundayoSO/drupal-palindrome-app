<?php

namespace Drupal\palindrome_module\Controller;


use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Controller\ControllerBase;

class PalindromeController extends ControllerBase {

  public function checkPalindrome($string): Response {
    $result = $this->palindrome($string);
    if ($result) {
      return new Response(t('@string is a palindrome.', ['@string' => $string]));
    }
    else {
      return new Response(t('@string is not a palindrome.', ['@string' => $string]));
    }
  }

  public function palindrome($string) 
  {     
    $string = preg_replace('/[^A-Za-z0-9]/', '', strtolower($string));
    return $string === strrev($string);
  }
}

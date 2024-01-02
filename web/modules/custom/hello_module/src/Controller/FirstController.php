<?php

namespace Drupal\hello_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase {
  public function helloAction() {
    return [
      "#type" => "markup",
      "#markup" => "Hello Drupal World. Time flies an arrow, fruit flies like a banana"
    ];
  }

  public function variableContent($name_1, $name_2) {
    return [
      "#type" => "markup",
      "#markup" => "{$name_1} and {$name_2} say hello to you!"
    ];
  }
}

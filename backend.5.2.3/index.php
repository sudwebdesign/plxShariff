<?php set_time_limit(0);
require_once __DIR__.'/vendor/autoload.php';
use Heise\Shariff\Backend;
class Application{#Application using Shariff Backend
 public static function run(){
  header('Content-type: application/json');
  include ('../../../data/configuration/plugins/plxShariff/config.php');#créé par config.php
  $url = isset($_GET['url']) ? $_GET['url'] : '';
  if ($url) {
   $shariff = new Backend($configuration);
   echo json_encode($shariff->get($url));
  } else {
   echo json_encode(null);
  }
 }
}
Application::run();
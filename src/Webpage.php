<?php


class Webpage {

  private $myUrl;

  public function __construct(string $url) {
    $this->myUrl = $url;
  }

  public function showHighlight(string $requestedUrl) {
    $requestedUrl = $this->myUrl;

    return $requestedUrl;
  }

  private function getFilename(string $url) {
    $filename = '';
    $uriSegments = explode('/', $url);

    foreach($uriSegments as $segment) {
      if (preg_match('(?!\/)\w+(?<!\/)', $segment)) {
        $filename = $segment;
      } else {
        continue;
      }
    }

    return $segment;
  }

  private function checkSection(string $url) {
    
  }

  private function isLanding() {

  }
}

?>
<?php

class Webpage {

  private $myUrl;

  public function __construct(string $url) {
    $this->myUrl = $url;
  }

  public function showHighlight(string $requestedUrl) {
    $hightlightState = false;

    if ($this->getFilename($requestedUrl) == $this->getFilename($this->myUrl)) {
      $hightlightState = true;
    }
    // if ()

    return $highlightState;
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

    return $filename;
  }

  private function getSections(string $url) {
    $sections = [];
    $uriSegments = explode('/', $url);

    foreach($uriSegments as $segment) {
      if (preg_match('(?!\/)\w+[.]\w+', $segment)) {
        $sections += $segment;
      } else {
        continue;
      }
    }

    return $sections;
  }

  private function compareSection(string $section1, string $section2) {
    return $status = ($section1 == $section2 ? true : false);
  }

  private function isLanding(string $filename) {
    if (preg_match('(?!\/)\w+[.]\w+', $filename)&& $filename == 'index.html') {
      return true;
    } else {
      return false;
    }
  }

}

?>
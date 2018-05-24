<?php

class Webpage {

  private $myUrl;

  public function __construct(string $url) {
    $this->myUrl = $url;
  }

  public function showHighlight(string $requestedUrl) {
    $highlightState = false;

    if ($this->myUrl == $requestedUrl) {
      $highlightState = true;
    } else if ($this->compareSections($this->myUrl, $requestedUrl)) {
      $highlightState = true;
    } else {
      $highlightState = false;
    }

    return $highlightState;
  }

  /**
   * @param string $url
   * @return string $filename
   */
  protected function getFilename(string $url) {
    $filename = '';
    $uriSegments = explode('/', $url);

    foreach($uriSegments as $segment) {
      if (preg_match('/(?!\/)\w+[.]\w+/', $segment)) {
        $filename = $segment;
      } else {
        continue;
      }
    }
    
    return $filename;
  }
  
  /**
   * Takes provided $uri path as a string and parses to an array of sections.
   *
   * @param string $url
   * @return array $sections
   */
  private function getSections(string $url) {
    $sections = preg_split('/\//', $url, -1, PREG_SPLIT_NO_EMPTY);
    array_pop($sections);

    return $sections;
  }

  /**
   * compares parsed path sections to help determine highlight.
   *
   * @param string $url
   * @return boolean
   */
  private function compareSections(string $url1, string $url2) {
    $sections1 = $this->getSections($url1);
    $sections2 = $this->getSections($url2);
    $assoc = array_intersect_assoc($sections1, $sections2);
    $result = false;

    if ($assoc == $sections1 || $assoc == $sections2) {
      if ($this->isLanding($url1) || $this->isLanding($url2)) {
        $result = true;
      }
    } 

    return $result;
  }

  /**
   * Checks filename string to return a boolean.
   *
   * @param string $filename
   * @return boolean
   */
  protected function isLanding(string $filename) {
    $result;
    $filename = $this->getFilename($filename);

    if (preg_match('/(?!\/)\w+[.]\w+/', $filename) && fnmatch('index.*', $filename)) {
      $result = true;
    } else {
      $result = false;
    }

    return $result;
  }

}

?>
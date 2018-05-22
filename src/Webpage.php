<?php


class Webpage {

  private $myUrl;

  public function __construct(string $url)
  {
    $this->myUrl = $url;
  }

  public function showHighlight(string $requestedUrl = null) {
    $requestedUrl = $this->myUrl;
    return $requestedUrl;
  }

}

?>
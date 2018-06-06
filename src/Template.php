<?php
require_once 'Webpage.php';

class Template {
private $breadcrumbs;

public function __construct(string $url) {
  $this->breadcrumbs = [];
  $webpage = new Webpage($url);
  $this->breadcrumbs['myUrl'] = $webpage->myUrl;
  $this->breadcrumbs['anchorText'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $webpage->anchorText);
  $this->breadcrumbs['anchorText'] = ucfirst($this->breadcrumbs['anchorText']);

  return $this->breadcrumbs;
}

public function getBreadcrumbNavigation() {
  
}

}

?>
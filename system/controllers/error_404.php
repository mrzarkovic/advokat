<?php

namespace Lamework\Controller;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Page controller
 */
class Error_404 extends Core
{
   public function __construct()
   {
      parent::__construct();
   }

   public function index()
   {
      $this->to_tpl['error'] = "Stranica nije pronađena.";

      $this->template = "404";
   }

}

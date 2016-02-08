<?php

namespace Lamework\Controller;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin controller
 */
class Admin_controller extends Core
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the pages
     * @throws \Exception
     */
    public function pages()
    {
        $this->template = "home";

        return;
    }

}

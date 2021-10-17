<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $invoices = Invoices::find("soft_deleted = 0");

        $this->view->invoices = $invoices;

    }
}


<?php
declare(strict_types=1);

class InvoiceController extends ControllerBase
{

    public function indexAction()
    {

    }

    /**
     * view detail invoice
     *
     * @param integer $id
     * @return void
     */
    public function viewAction(int $id): void
    {
        $invoice = Invoices::findFirstByid($id);
        if (!$invoice) {
            $this->flash->error("invoice was not found");

            $this->dispatcher->forward([
                'controller' => "invoices",
                'action' => 'index'
            ]);

            return;
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null)
    {
        if ($this->request->isPost()) {

            $invoice = new Invoices();
            $invoice->invoice_code = $this->request->getPost("invoice_code");
            $invoice->subject = $this->request->getPost("subject");
            $invoice->issue_date = $this->request->getPost("issue_date");
            $invoice->due_date = $this->request->getPost("due_date");
            $invoice->for = $this->request->getPost("for", "int");
            $invoice->from = $this->request->getPost("from", "int");
            $invoice->is_paid = $this->request->getPost("is_paid");
            $invoice->notes = $this->request->getPost("notes");

            if (!$invoice->save()) {
                foreach ($invoice->getMessages() as $message) {
                    $this->flash->error((string)$message);
                }

            } else {
                $this->flash->success("invoice was created successfully, now you can add the detail item");
                $this->dispatcher->forward([
                    'controller' => "invoice",
                    'action' => 'edit',
                    'params' => [$invoice->id]
                ]);
                // $this->response->redirect(sprintf("invoice/edit/%s", $invoice->id));
                $this->view->disable();
            }
        }

        $customers = Customers::find();
        $this->view->customers = $customers;

        $latest_invoice = Invoices::findFirst(['order' => 'id DESC']);
        $this->view->latest_invoice = $latest_invoice;
    }

    public function editAction(int $id, int $itemId = null, string $do = null):void
    {
        $invoice = Invoices::findFirstByid($id);

        if ($this->request->isPost()) {

            if($itemId) {
                $invoice_detail = InvoiceDetails::findFirstByid($this->request->getPost("item_id"));
                if(!$invoice_detail) {
                    $invoice_detail = new InvoiceDetails();
                }
                $invoice_detail->invoice_id = $this->request->getPost("invoice_id", "int");
                $invoice_detail->product_id = $this->request->getPost("product_id", "int");
                $invoice_detail->quantity = $this->request->getPost("quantity", "int");
                $invoice_detail->notes = $this->request->getPost("notes");

                if (!$invoice_detail->save()) {
                    foreach ($invoice_detail->getMessages() as $message) {
                        $this->flash->error((string)$message);
                    }
                } else {
                    $this->flash->success("invoice item was added successfully");
                }

            } else {
                $invoice->subject = $this->request->getPost("subject");
                $invoice->issue_date = $this->request->getPost("issue_date");
                $invoice->due_date = $this->request->getPost("due_date");
                $invoice->for = $this->request->getPost("for", "int");
                $invoice->from = $this->request->getPost("from", "int");
                $invoice->is_paid = $this->request->getPost("is_paid");
                $invoice->notes = $this->request->getPost("notes");
    
                if (!$invoice->save()) {
                    foreach ($invoice->getMessages() as $message) {
                        $this->flash->error((string)$message);
                    }
                } else {
                    $this->flash->success("invoice was created successfully, now you can add the detail item");
                    $this->response->redirect(sprintf("invoice/edit/%s", $invoice->id));
                    $this->view->disable();
                }
            }

        }

        if ($itemId && $do === 'delete') {
            $invoice_detail = InvoiceDetails::findFirstByid($itemId);
            if (!$invoice_detail) {
                $this->flashSession->error("Failed deleting invoice item, no such item");
            } else {
                if (!$invoice_detail->delete()) {
                    foreach ($invoice_detail->getMessages() as $message) {
                        $this->flashSession->error((string)$message);
                    }
                } else {
                    $this->flashSession->success('Invoice item was deleted successfully');
                }
                $this->response->redirect(sprintf("invoice/edit/%s", $invoice->id));
            }
        }

        if (!empty($invoice)) {

            $this->tag->setDefault("id", $invoice->id);
            $this->tag->setDefault("invoice_code", $invoice->invoice_code);
            $this->tag->setDefault("subject", $invoice->subject);
            $this->tag->setDefault("issue_date", $invoice->issue_date);
            $this->tag->setDefault("due_date", $invoice->due_date);
            $this->tag->setDefault("for", $invoice->for);
            $this->tag->setDefault("from", $invoice->from);
            $this->tag->setDefault("is_paid", $invoice->is_paid);
            $this->tag->setDefault("notes", $invoice->notes);

            $this->view->id = $invoice->id;
            $this->view->invoice = $invoice;
            
        }
        
        if (!$invoice) {
            $this->flash->error("Invoice with given id to edit is not found, create new instead?");
        }

        $customers = Customers::find();
        $this->view->customers = $customers;

        $latest_invoice = Invoices::findFirst(['order' => 'id DESC']);
        $this->view->latest_invoice = $latest_invoice;

        $latest_invoice_detail = InvoiceDetails::findFirst(['order' => 'id DESC']);
        $this->view->latest_invoice_detail = $latest_invoice_detail;

        $products = Products::find();
        $this->view->products = $products;
    }

    /**
     * Delete invoice
     *
     * @param int $id
     * @return void
     */
    public function deleteAction(int $id): void
    {
        $invoice = Invoices::findFirstByid($id);
        if (!$invoice) {
            $this->flash->error("invoice was not found");

            $this->dispatcher->forward([
                'controller' => "index",
                'action' => 'index'
            ]);

            return;
        }

        $invoice->soft_deleted = 1;

        if (!$invoice->save()) {

            foreach ($invoice->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "invoice",
                'action' => 'index'
            ]);

            return;
        }

        $this->flash->success(sprintf("invoice %s was deleted successfully", str_pad((string)$invoice->invoice_code, 4, "0", STR_PAD_LEFT)));

        // $this->response->redirect("index");
        // $this->view->disable();
        $this->dispatcher->forward([
            'controller' => "index",
            'action' => "index"
        ]);
    }

}


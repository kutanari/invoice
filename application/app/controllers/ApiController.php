<?php
declare(strict_types=1);

use Phalcon\Http\Response;

class ApiController extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        $this->view->disable();
    }
    
    public function indexAction()
    {
        $result = [
            'message' => 'Goto /invoice or /invoice/{invoiceCode} to get the data'
        ];
        $response = new Response();
        $response->setHeader('Content-Type', 'application/json');
        $response->setJsonContent($result);
        $response->send();
        exit;
    }

    public function invoicesAction(string $invoice_code = null)
    {
        $result = [
            'message' => '',
            'status' => 'success',
            'data' => []
        ];

        if ($invoice_code) {
            $invoice_id = ltrim($invoice_code, '0');
            $invoice = Invoices::findFirstByid($invoice_id);

            if ($invoice) {
                $result['data'] = $this->buildReponseInvoiceData($invoice);
            }
        } else {
            $invoices = Invoices::find("soft_deleted = 0");
            foreach ($invoices as $invoice) {
                $result['data'][] = $this->buildReponseInvoiceData($invoice);
            }
        }


        $response = new Response();
        $response->setHeader('Content-Type', 'application/json');
        $response->setJsonContent($result);
        $response->send();
        exit;
    }

    /**
     * Undocumented function
     *
     * @param Invoices $invoice
     * @return stdClass
     */
    private function buildReponseInvoiceData(Invoices $invoice): ?stdClass
    {
        $obj = new stdClass();
        $obj->id = $invoice->id;
        $obj->invoice_code = str_pad((string)($invoice->invoice_code), 4, "0", STR_PAD_LEFT);
        $obj->subject = $invoice->subject;
        $obj->issue_date = $invoice->issue_date;
        $obj->due_date = $invoice->due_date;
        $obj->for = $invoice->for;
        $obj->from = $invoice->from;
        $obj->is_paid = $invoice->is_paid;
        $obj->notes = $invoice->notes;
        $obj->subtotal = $invoice::getTotalPrice($invoice);

        $obj->details = [];
        
        foreach ($invoice->invoiceDetails as $item) {
            $objectItem = new stdClass();
            $objectItem->item_type = $item->products->productTypes->name;
            $objectItem->description = $item->products->name;
            $objectItem->quantity = $item->quantity;
            $objectItem->unit_price = $item->products->unit_price;
            $obj->details[] = $objectItem;
        }
        
        return $obj;
    }

}


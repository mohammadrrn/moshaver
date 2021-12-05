<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoicesList()
    {
        $invoicesList = Invoice::where('user_id', auth()->id())->paginate($this->pagination);
        $data = [
            'invoicesList' => $invoicesList
        ];
        return view('panel.invoice.invoicesList', compact('data'));
    }
}

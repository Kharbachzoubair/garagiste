<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Repair;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InvoicesImport;
use Laracsv\Export;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('search');
            $invoices = Invoice::with('repair')
                ->where('id', 'like', '%' . $search . '%')
                ->orWhereHas('repair', function($query) use ($search) {
                    $query->where('client_name', 'like', '%' . $search . '%');
                })
                ->get();

            return response()->json($invoices);
        }

        $invoices = Invoice::with('repair')->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $repairs = Repair::all();
        return view('admin.invoices.create', compact('repairs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'repair_id' => 'required|exists:repairs,id',
            'additional_charges' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $invoice = new Invoice();
        $invoice->repair_id = $request->repair_id;
        $invoice->additional_charges = $request->additional_charges;
        $invoice->total_amount = $request->total_amount;
        $invoice->save();

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice added successfully.');
    }

    public function edit(Invoice $invoice)
    {
        $repairs = Repair::all();
        return view('admin.invoices.edit', compact('invoice', 'repairs'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'repair_id' => 'required|exists:repairs,id',
            'additional_charges' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $invoice->repair_id = $request->repair_id;
        $invoice->additional_charges = $request->additional_charges;
        $invoice->total_amount = $request->total_amount;
        $invoice->save();

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function approve(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->approved = true;
        $invoice->save();

        return redirect()->route('admin.invoices.show', $invoice)->with('success', 'Invoice approved successfully.');
    }

    public function report()
    {
        $invoices = Invoice::with('repair')->get();
        return view('admin.invoices.report', compact('invoices'));
    }

    public function exportCSV()
    {
        $invoices = Invoice::with('repair')->get();
        $csvExporter = new Export();

        $csvExporter->build($invoices, ['id', 'repair_id', 'repair.client_name', 'total_amount', 'status', 'approved'])->download();
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new InvoicesImport, $request->file('csv_file'));

        return redirect()->route('admin.invoices.index')->with('success', 'Invoices imported successfully.');
    }
}

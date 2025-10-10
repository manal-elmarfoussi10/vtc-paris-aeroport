<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerAdminController extends Controller
{
    public function index()  { $customers = Customer::latest()->paginate(20); return view('admin.customers.index', compact('customers')); }
    public function create() { return view('admin.customers.create'); }
    public function store(Request $r) { /* TODO */ return back()->with('success','Customer saved'); }
    public function show(Customer $customer) { return view('admin.customers.show', compact('customer')); }
    public function edit(Customer $customer) { return view('admin.customers.edit', compact('customer')); }
    public function update(Request $r, Customer $customer) { /* TODO */ return back()->with('success','Updated'); }
    public function destroy(Customer $customer) { $customer->delete(); return back()->with('success','Deleted'); }
}
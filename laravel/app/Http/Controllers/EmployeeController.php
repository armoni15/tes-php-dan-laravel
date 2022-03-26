<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crud\EmployeeCrud;
use App\Models\Company;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = EmployeeCrud::read();

        return view('dashboard.employee.list', [
            'employees' => $data
        ]);
    }

    public function create()
    {
        return view('dashboard.employee.create');
    }

    public function validasi(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:100',
            'email' => 'required|email|unique:employees',
            'company' => 'required'
        ]);

        $hasil = EmployeeCrud::create($request->all());
        if ($hasil != null) {
            return redirect('/employee')->with('succes', 'Employee has been create successfully!');
        } else {
            return redirect('/employee')->with('error', 'Employee failed to add!');
        }
    }

    public function show($id)
    {
        $hasil = EmployeeCrud::fecth($id);

        return view('dashboard.employee.edit', [
            'employee' => $hasil
        ]);
    }

    public function data($id)
    {
        $hasil = EmployeeCrud::show($id);
        $company = Company::find($id);

        return view('dashboard.listemcom', [
            'employees' => $hasil,
            'company' => $company
        ]);
    }

    public function edit(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required|min:5|max:100',
            'email' => 'email|unique:employees,email,' . $request->id,
            'company' => 'required'
        ]);

        $hasil = EmployeeCrud::update($validatedData);

        if ($hasil != null) {
            return redirect('/employee')->with('succes', 'Employee has been edited successfully!');
        } else {
            return redirect('/employee')->with('error', 'Employee failed to edit!');
        }
    }

    public function destroy(Request $request)
    {
        $hasil = EmployeeCrud::delete($request->id);

        if ($hasil != null) {
            return redirect('/employee')->with('succes', 'Employee has been deleted successfully!');
        } else {
            return redirect('/employee')->with('error', 'Employee not found!');
        }
    }

    public function createPDF(Request $request)
    {
        // $employees = EmployeeCrud::getList($request->id);
        $employees = Employee::where('company_id', $request->id)->get();
        $data = [
            'title' => $request->company_name,
            'employees' => $employees
        ];

        $pdf = PDF::loadView('pdf.employee', $data);

        return $pdf->download($request->company_name . ' - Employees.pdf');
        // return view('pdf.employee', $data);
    }
}

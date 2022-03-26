<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Crud\CompanyCrud;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = CompanyCrud::read();

        return view('dashboard.company.list', [
            'companies' => $data
        ]);
    }

    public function create()
    {
        return view('dashboard.company.create');
    }

    public function validasi(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:100',
            'email' => 'required|email|unique:companies',
            'logo' => 'required|image|dimensions:min_width=100,min_height=100|mimes:png|max:2024',
            'website' => 'required|min:5|max:100'
        ]);

        $hasil = CompanyCrud::create($validatedData);

        if ($hasil != null) {
            return redirect('/company')->with('succes', 'Company has been create successfully!');
        } else {
            return redirect('/company')->with('error', 'Company failed to add!');
        }
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {

            $term = trim($request->term);
            $posts = DB::table('companies')->select('id', 'name as text')
                ->where('name', 'LIKE',  '%' . $term . '%')
                ->orderBy('name', 'asc')->simplePaginate(10);

            $morePages = true;
            if (empty($posts->nextPageUrl())) {
                $morePages = false;
            }
            $results = array(
                "results" => $posts->items(),
                "pagination" => array(
                    "more" => $morePages
                )
            );

            return response()->json($results);
        }
    }

    public function show($id)
    {
        $hasil = CompanyCrud::fecth($id);

        return view('dashboard.company.edit', [
            'company' => $hasil
        ]);
    }

    public function edit(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required|min:5|max:100',
            'email' => 'email|unique:companies,email,' . $request->id,
            'logo' => 'image|dimensions:min_width=100,min_height=100|mimes:png|max:2024',
            'website' => 'required|min:5|max:100'
        ]);

        if ($request->logo == null) {
            $validatedData['logo'] = null;
        }

        $hasil = CompanyCrud::update($validatedData);

        if ($hasil != null) {
            return redirect('/company')->with('succes', 'Company has been edited successfully!');
        } else {
            return redirect('/company')->with('error', 'Company failed to edit!');
        }
    }

    public function destroy(Request $request)
    {
        $hasil = CompanyCrud::delete($request->id);

        if ($hasil != null) {
            return redirect('/company')->with('succes', 'Company has been deleted successfully!');
        } else {
            return redirect('/company')->with('error', 'Company not found!');
        }
    }
}

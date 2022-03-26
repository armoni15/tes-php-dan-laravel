<?php

namespace App\Crud;

use App\Models\Company;
use App\Models\Employee;

class EmployeeCrud
{
  public static function read()
  {
    $data = Employee::with('company')->latest()->paginate(5);

    return $data;
  }

  public static function create($data)
  {

    $hasil = Employee::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'company_id' => $data['company'],
    ]);

    return $hasil;
  }

  public static function fecth($id)
  {
    $data = Employee::find($id);
    $company = Company::find($data->company_id);

    $data['company_name'] = $company->name;

    return $data;
  }

  public static function show($id)
  {
    $data = Employee::where('company_id', $id)->latest()->paginate(5);

    return $data;
  }

  public static function update($data)
  {

    $hasil = Employee::where('id', $data['id'])
      ->update([
        'name' => $data['name'],
        'email' => $data['email'],
        'company_id' => $data['company'],
      ]);

    return $hasil;
  }

  public static function delete($id)
  {
    $hasil = Employee::destroy($id);

    return $hasil;
  }

  public static function getList($id)
  {
    $hasil = Employee::where('company_id', $id)->get();

    return $hasil;
  }
}

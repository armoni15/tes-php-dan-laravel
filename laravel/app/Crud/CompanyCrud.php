<?php

namespace App\Crud;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyCrud
{
  public static function read()
  {
    $data = DB::table('companies')->latest()->paginate(5);

    return $data;
  }

  public static function create($data)
  {
    $extension = $data['logo']->getClientOriginalExtension();
    $logoname = $data['name'] . '-' . time() . '.' . $extension;
    $path = $data['logo']->storeAs('company',  $logoname);

    $hasil = Company::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'logo' => 'company/' . $logoname,
      'website' => $data['website'],
    ]);

    return $hasil;
  }

  public static function fecth($id)
  {
    $data = Company::find($id);

    return $data;
  }

  public static function update($data)
  {
    $fecth = Company::find($data['id']);

    if ($data['logo'] != null) {
      $extension = $data['logo']->getClientOriginalExtension();
      $logoname = $data['name'] . '-' . time() . '.' . $extension;
      $path = $data['logo']->storeAs('company',  $logoname);
      $logo = 'company/' . $logoname;
      if (Storage::disk('local')->exists($fecth->logo)) {
        Storage::disk('local')->delete($fecth->logo);
      }
    } else {
      $logo = $fecth->logo;
    }

    $hasil = Company::where('id', $data['id'])
      ->update([
        'name' => $data['name'],
        'email' => $data['email'],
        'logo' => $logo,
        'website' => $data['website'],
      ]);

    return $hasil;
  }

  public static function delete($id)
  {
    $data = Company::find($id);
    if (Storage::disk('local')->exists($data->logo)) {
      Storage::disk('local')->delete($data->logo);
    }
    $hasil = Company::destroy($id);
    DB::table('employees')->where('company_id', $id)->delete();

    return $hasil;
  }
}

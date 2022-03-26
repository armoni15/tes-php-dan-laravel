@extends('layouts.appdashboard')

@section('title', 'List Employees '.$company->name)

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $company->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="$('#exportForm').submit();"><i class="bi bi-filetype-pdf"></i> Export PDF</button>
        <form id="exportForm" action="/export/employee/pdf" method="POST" class="d-none">
          @csrf
          <input type="hidden" name="id" value="{{ $company->id }}">
          <input type="hidden" name="company_name" value="{{ $company->name }}">
        </form>
      </div>
    </div>
  </div>

  <div class="col-10">
    <div class="card shadow-sm mt-2">
      <div class="card-header">
        <h4><i class="bi bi-list"></i> List Employees</h4>
      </div>
      <div class="card-body">
        <table class="table" id="tabelData">
          <thead>
            <tr style="font-size: 1.15em;">
              <th scope="col">No.</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Added</th>
            </tr>
          </thead>
          <tbody>
            @if (count($employees) > 0)
            @foreach ($employees as $employee)
            <tr>
              <td>{{ $loop->iteration }}.</td>
              <td>{{ $employee->name }}</td>
              <td>{{ $employee->email }}</td>
              <td>{{ $employee->created_at }}</td>
            </tr>
            @endforeach
            @else
            <tr>
              <td class="text-center" colspan="5">Tidak ada data</td>
            </tr>
            @endif
          </tbody>
        </table>
        {{ $employees->links() }}
      </div>
    </div>
  </div>

</main>

@endsection
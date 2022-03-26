@extends('layouts.appdashboard')

@section('title', 'Employees')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Employees</h1>
  </div>

  @if (session()->has('succes'))
  <div class="alert alert-success alert-dismissible shadow-sm mt-2 col-10" role="alert">
    <span><i class="bi bi-check-circle-fill"></i>&ensp; {{ session('succes') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  @if (session()->has('error'))
  <div class="alert alert-danger alert-dismissible shadow-sm mt-2 col-10" role="alert">
    <span><i class="bi bi-check-circle-fill"></i>&ensp; {{ session('error') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="col-10">
    <div class="card shadow-sm mt-2">
      <div class="card-header">
        <h4><i class="bi bi-list"></i> Lists
          <a href="/employee/create" class="btn btn-primary btn-sm rounded-3 shadow-sm float-end"><span data-feather="plus"></span> Create</a>
        </h4>
      </div>
      <div class="card-body">
        <table class="table" id="tabelData">
          <thead>
            <tr style="font-size: 1.15em;">
              <th scope="col">No.</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Company</th>
              <th scope="col"><i class="bi bi-gear-wide-connected"></i> Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($employees) > 0)
            @foreach ($employees as $employee)
            <tr>
              <td>{{ $loop->iteration }}.</td>
              <td>{{ $employee->name }}</td>
              <td>{{ $employee->email }}</td>
              <td>{{ $employee->company->name }}</td>
              <td>
                <a href="/employee/show/{{ $employee->id }}" class="btn btn-warning btn-sm text-dark rounded-3 shadow-sm"><span data-feather="edit"></span> Edit</a>

                <button type="button" class="btn btn-danger btn-sm rounded-3 shadow-sm" onclick="confirm('Are you sure to delete data?') ? $('#deleteForm{{ $employee->id }}').submit(): false;">
                  <span data-feather="trash-2"></span> Delete
                </button>
                <form id="deleteForm{{ $employee->id }}" action="/employee/delete" method="POST" class="d-none">
                  @method('delete')
                  @csrf
                  <input type="hidden" name="id" value="{{ $employee->id }}">
                </form>
              </td>
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
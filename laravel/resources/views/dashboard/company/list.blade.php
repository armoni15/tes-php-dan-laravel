@extends('layouts.appdashboard')

@section('title', 'Companies')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <!-- Modal Create -->
  <div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ModalLabel">Import Exel Data Companies</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="importExel" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="inputExel" class="form-label">File Exel <span style="color: red;">*</span></label>
              <input class="form-control" type="file" name="file" id="inputExel">
              <small class="text-danger" id="inputExelError"></small>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Companies</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalImport"><i class="bi bi-filetype-exe"></i> Import Exel</button>
      </div>
    </div>
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
          <a href="/company/create" class="btn btn-primary btn-sm rounded-3 shadow-sm float-end"><span data-feather="plus"></span> Create</a>
        </h4>
      </div>
      <div class="card-body">
        <table class="table" id="tabelData">
          <thead>
            <tr style="font-size: 1.15em;">
              <th scope="col">No.</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Website</th>
              <th scope="col"><i class="bi bi-gear-wide-connected"></i> Action</th>
            </tr>
          </thead>
          <tbody>
            @if (count($companies) > 0)
            @foreach ($companies as $company)
            <tr>
              <td>{{ $loop->iteration }}.</td>
              <td>{{ $company->name }}</td>
              <td>{{ $company->email }}</td>
              <td>{{ $company->website }}</td>
              <td>
                <a href="/list/employee/company/{{ $company->id }}" class="btn btn-info btn-sm text-dark rounded-3 shadow-sm"><span data-feather="eye"></span> Employee</a>

                <a href="/company/show/{{ $company->id }}" class="btn btn-warning btn-sm text-dark rounded-3 shadow-sm"><span data-feather="edit"></span> Edit</a>

                <button type="button" class="btn btn-danger btn-sm rounded-3 shadow-sm" onclick="confirm('Are you sure to delete data?') ? $('#deleteForm{{ $company->id }}').submit(): false;">
                  <span data-feather="trash-2"></span> Delete
                </button>
                <form id="deleteForm{{ $company->id }}" action="/company/delete" method="POST" class="d-none">
                  @method('delete')
                  @csrf
                  <input type="hidden" name="id" value="{{ $company->id }}">
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
        {{ $companies->links() }}
      </div>
    </div>
  </div>

</main>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#importExel').on('submit', function(event) {
      event.preventDefault();
      alert('Belum Berfungsi');
    });

  });
</script>
@endsection
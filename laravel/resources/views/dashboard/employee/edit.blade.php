@extends('layouts.appdashboard')

@section('title', 'Edit Employee')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Employee</h1>
  </div>

  <div class="col-8">
    <div class="card shadow-sm mt-2">
      <div class="card-header">
        <h4><i class="bi bi-view-list"></i></i> Form Edit</h4>
      </div>
      <div class="card-body">
        <form action="/employee/update" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <input type="hidden" name="id" value="{{ $employee->id }}">
          <div class="mb-3">
            <label for="editName" class="form-label">Name <span style="color: red;">*</span></label>
            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="editName" value="{{ $employee->name }}">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="editEmail" class="form-label">Email <span style="color: red;">*</span></label>
            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="editEmail" value="{{ $employee->email }}">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="createWebsite" class="form-label">Company <span style="color: red;">*</span></label>
            <br>
            <select class="form-select  @error('company') is-invalid @enderror" name="company" id="selectCompany">
              <option value="{{ $employee->company_id }}" selected>{{ $employee->company_name }}</option>
            </select>
            @error('company')
            <br><small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
      </div>
      <div class="modal-footer">
        <a href="/employee" class="btn btn-danger" id="btnReset">Cancel</a>
        <button type="submit" class="btn btn-primary" id="btnedit">Update</button>
      </div>
      </form>
    </div>
  </div>
  </div>

</main>

<script>
  (function() {

    $("#selectCompany").select2({
      placeholder: 'Select Company',
      allowClear: true,
      ajax: {
        url: '/company/fetch',
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            term: params.term || '',
            page: params.page || 1
          }
        },
        cache: true
      }
    });
  })();
</script>
@endsection
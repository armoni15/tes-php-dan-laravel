@extends('layouts.appdashboard')

@section('title', 'Create Company')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create Company</h1>
  </div>

  <div class="col-8">
    <div class="card shadow-sm mt-2">
      <div class="card-header">
        <h4><i class="bi bi-view-list"></i> Form Create</h4>
      </div>
      <div class="card-body">
        <form action="/company" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="createName" class="form-label">Name <span style="color: red;">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="createName" value="{{ old('name') }}">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="createEmail" class="form-label">Email <span style="color: red;">*</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="createEmail" value="{{ old('email') }}">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3 col-6">
            <label for="createLogo" class="form-label">Logo <span style="color: red;">*</span></label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control  @error('logo') is-invalid @enderror" type="file" name="logo" id="createLogo" onchange="previewImage()">
            @error('logo')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="createWebsite" class="form-label">Website <span style="color: red;">*</span></label>
            <input type="text" name="website" class="form-control  @error('website') is-invalid @enderror" id="createWebsite" value="{{ old('website') }}">
            @error('website')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-danger" id="btnReset">Reset</button>
        <button type="submit" class="btn btn-primary" id="btnCreate">Save</button>
      </div>
      </form>
    </div>
  </div>
  </div>

</main>

<script>
  function previewImage() {
    const logo = document.querySelector('#createLogo');
    const logoPrivew = document.querySelector('.img-preview');

    logoPrivew.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(logo.files[0]);
    oFReader.onload = function(oFREvent) {
      logoPrivew.src = oFREvent.target.result;
    }

  }
</script>

@endsection
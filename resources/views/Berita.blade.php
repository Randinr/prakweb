

{{-- @extends('layout') <!-- Ganti 'layout' dengan nama file layout Anda --> --}}
@extends('master')

@section('title', 'Halaman Berita')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Berita</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Berita</li>
          </ol>
        </div>
      </div>
    </div>
  </section>


  <!-- DataTable for Berita List -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List of Berita</h3>
      </div>
      <div class="card-body">
        <table id="beritaTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID Berita</th>
              <th>Title</th>
              <th>File</th>
              <th>Tanggal Terbit</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Berita Contoh</td>
              <td>file.pdf</td>
              <td>2024-10-19</td>
              <td>
                <button class="btn btn-warning">Edit</button>
                <button class="btn btn-danger">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
@endsection

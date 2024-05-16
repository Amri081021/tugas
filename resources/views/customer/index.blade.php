@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Data Customer
          </h3>
        </div>
        <div class="card-body">
          <form action="#">
            <div class="row">
              <div class="col">
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="ketik keyword disini">
              </div>
              <div class="col-auto">
                <button class="btn btn-primary">
                  Cari
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No Tlp</th>
                  <th>Alamat</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Albert</td>
                  <td>albert@gmail.com</td>
                  <td>085852527575</td>
                  <td>
                    Jln. Jend Sudirman no.1, Yogyakarta
                  </td>
                  <td>
                    Aktif
                  </td>
                  <td>
                    <a href="{{ route('customer.edit', 1) }}" class="btn btn-sm btn-primary">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Albert Lagi</td>
                  <td>albert@gmail.com</td>
                  <td>085852527576</td>
                  <td>
                    Jln. Jend Sudirman no.2, Yogyakarta
                  </td>
                  <td>
                    Aktif
                  </td>
                  <td>
                    <a href="{{ route('customer.edit', 2) }}" class="btn btn-sm btn-primary">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Albert</td>
                  <td>albertlagi@gmail.com</td>
                  <td>085852527577</td>
                  <td>
                    Jln. Jend Sudirman no.3, Yogyakarta
                  </td>
                  <td>
                    Aktif
                  </td>
                  <td>
                    <a href="{{ route('customer.edit', 3) }}" class="btn btn-sm btn-primary">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Albert</td>
                  <td>albert@gmail.com</td>
                  <td>085852527578</td>
                  <td>
                    Jln. Jend Sudirman no.4, Yogyakarta
                  </td>
                  <td>
                    Aktif
                  </td>
                  <td>
                    <a href="{{ route('customer.edit', 4) }}" class="btn btn-sm btn-primary">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Albert</td>
                  <td>albert@gmail.com</td>
                  <td>085852527579</td>
                  <td>
                    Jln. Jend Sudirman no.5, Yogyakarta
                  </td>
                  <td>
                    Aktif
                  </td>
                  <td>
                    <a href="{{ route('customer.edit', 5) }}" class="btn btn-sm btn-primary">Edit</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layout.admin_cms')
@section('title', 'Pesan')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- Start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <div class="card-borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">Table Pesan</h1>
          </div>
          <div class="card-body">
            @if (session('AlertSuccess'))
              <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>{{ session('AlertSuccess') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Pengirim</th>
                    <th scope="col">Tanggal</th>
                    <th class="text-center" width="50" scope="col">Detail</th>
                    <th class="text-center" width="50" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_pesan as $pesan)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$pesan->name}}</td>
                    <td>
                      <?php $created_at = strtotime($pesan->created_at) ?>
                      {{date("d M Y", $created_at)}}
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/pesan/'.$pesan->id) }}"><i class="fas fa-book"></i></a>
                    </td>
                    <td class="text-center">
                      <form action="{{ url('/pesan/'.$pesan->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn-table btn btn-transparent" onclick="return confirm('Anda yakin?')"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>{{-- end table --}}
          </div>
        </div> {{-- end card --}}
      </div> {{-- end container --}}
    </div> {{-- end content --}}
  </div>
@section('footer')
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script>
    $(document).ready(function()
    {
      $('#dataTable').DataTable();
    });
  </script>
@stop
@endsection
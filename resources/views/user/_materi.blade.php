@extends('layout.admin_cms')
@section('title', 'Materi Bridge Gunadarma')
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- Start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <div class="card shadow borderless">
          <div class="card-header">
            <h1 class="text-center font-weight-bold text-info">Materi Bridge Gunadarma</h1>
          </div>
          <div class="card-body">
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Judul Materi</th>
                    <th scope="col">Tanggal Upload</th>
                    <th class="text-center" width="50" scope="col">Detail</th>
                    <th class="text-center" width="50">Download</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_materi as $materi)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                      <a href="{{ url('/_materi/'.$materi->id) }}" class="text-primary">{{strtoupper($materi->mat_title)}}</a>
                    </td>
                    <td>
                      <?php $mat_date = strtotime($materi->mat_date) ?>
                      {{date("d M Y", $mat_date)}}
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/_materi/'.$materi->id) }}"><i class="fas fa-book"></i></a>
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/_materi/'.$materi->id.'/download') }}"><i class="fas fa-download"></i></a>
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
@endsection
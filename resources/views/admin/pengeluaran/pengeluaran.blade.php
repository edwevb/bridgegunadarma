@extends('layout.admin_cms')
@section('title','Pengeluaran Bridge Gunadarma')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
	<div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- Start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <div class="card shadow borderless">
          <div class="card-header">
            <h1 class="text-center font-weight-bold text-info">Pengeluaran Bridge Gunadarma</h1>
          </div>
          <div class="card-body">
            @if(session('AlertDanger'))
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>{{ session('AlertDanger')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            @if(session('AlertWarning'))
              <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong>{{ session('AlertWarning')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-pengeluaran" data-toggle="modal" data-target="#modal-tambah-pengeluaran">Click disini</a> untuk melihat error.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            @if (session('AlertSuccess'))
              <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>{{ session('AlertSuccess') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="mb-2">
              <a id="btn-wh" class="btn bg-gradient-info" data-toggle="modal" data-target="#modal-tambah-pengeluaran"><i class="far fa-plus-square"></i> Tambah data</a>
              <a id="info" class="text-secondary float-right" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="@popoverText"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="left" title="click me"></i></a>
            </div>
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Jenis Pengeluaran</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Biaya</th>
                    <th class="text-center" width="50" scope="col">Detail</th>
                    <th class="text-center" width="50" scope="col">Edit</th>
                    <th class="text-center" width="50" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_pengeluaran as $p)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{strtoupper($p->p_title)}}</td>
                    <td>
                      <?php $date = strtotime($p->p_date) ?>
                      {{date("d M Y", $date)}}
                    </td>
                    <td>@rupiah($p->p_biaya)</td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/pengeluaran/'.$p->id) }}"><i class="fas fa-book"></i></a>
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/pengeluaran/'.$p->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                    </td>
                    <td class="text-center">
                      <form action="{{ url('/pengeluaran/'.$p->id) }}" method="post">
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

  {{-- Modal tambah pengeluaran --}}
  <div class="modal fade" id="modal-tambah-pengeluaran" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Pengeluaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-right mb-4">
            <button id="info" class="btn text-secondary" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="
             <p>Contoh pengisian <b>Biaya Pengeluaran</b> :</p>
              <p>300000 -> tiga ratus ribu rupiah</p>
              <p>300000.33 -> tiga ratus ribu tiga puluh tiga rupiah</p>
              " data-placement="bottom"><h5><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="click me"></i></h5>
            </button>
          </div>
          <form method="post" action="{{ url('/pengeluaran') }}">
            @csrf
            <div class="form-group">
              <label for="p_title">Jenis Pengeluaran</label>
              <input type="text" name="p_title" id="p_title" class="form-style @error('p_title') is-invalid @enderror" value="{{old('p_title')}}">
              @error('p_title')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="p_date">Tanggal</label>
              <input type="date" name="p_date" id="CurrentDate" class="form-style @error('p_date') is-invalid @enderror" value="{{old('p_date')}}">
              @error('p_date')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="p_biaya">Biaya Pengeluaran</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Rp</span>
                </div>
                <input type="text" name="p_biaya" id="p_biaya" class="form-control @error('p_biaya') is-invalid @enderror rp" value="{{old('p_biaya')}}">
                @error('p_biaya')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>	
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea name="p_keterangan" id="p_keterangan" class="form-style" placeholder="Write here..">{{old('p_keterangan')}}</textarea>
            </div>
            <div class="ml-5 pb-5">
              <button onclick="javascript: return confirm('Tambahkan ke DATABASE ?')" type="submit" class="btn-form btn btn-primary form-btn">Insert</button>
              <button type="reset" class="btn-form btn btn-danger form-btn">Reset</button>
              <button type="button" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>{{-- End Modal --}}
@section('footer')
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
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
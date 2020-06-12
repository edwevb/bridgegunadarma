@extends('layout.admin_cms')
@section('title', 'Kas (Iuran SK) Bridge Gunadarma')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
	<div class="row no-gutters mb-5">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg dflex">
			<div class="container">
				<div class="card-borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">Kas (Iuran SK) Bridge Gunadarma</h1>
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-iuranSk" data-toggle="modal" data-target="#modal-tambah-iuranSk">Click disini</a> untuk melihat error.</p>
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
              <a id="btn-wh" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah-iuranSk"><i class="far fa-plus-square"></i> Tambah data</a>
              <a id="info" class="text-secondary float-right" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="@popoverText"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="left" title="click me"></i></a>
            </div>
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr class="text-center">
                    <th scope="col" width="10">No</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Total Pemasukan</th>
                    <th width="50" scope="col">Detail</th>
                    <th width="50" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_sk as $iuranSk)
                  <tr class="text-center">
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                      <a href="{{ url('/iuranSk/'.$iuranSk->id) }}">{{$iuranSk->pta_ata}} | {{$iuranSk->sk_tahun}}</a>
                    </td>
                    <td>
                      @if($iuranSk->atlet->isEmpty())
                        <span class="font-italic text-muted">No data</span>
                      @else
                        @rupiah($iuranSk->totalSk())
                      @endif
                      </td>
                    <td>
                      <a class="btn-table btn btn-transparent" href="{{ url('/iuranSk/'.$iuranSk->id) }}"><i class="fas fa-book"></i></a>
                    </td>
                    <td>
                      <form action="{{ url('/iuranSk/'.$iuranSk->id) }}" method="post">
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
            <div class="card col-md-4 shadow border-left-info mt-4">
              <div class="card-body">
                <h5 class="card-title">Total Kas SK</h5>
                <h6 class="card-subtitle mb-2 text-muted">Pemasukan</h6>
                <p class="card-text">
                  @if($data_sk->isEmpty())
                    @rupiah(0)
                  @else
                    @rupiah($iuranSk->total())
                  @endif
                </p>
              </div>
            </div>
          </div>
        </div> {{-- end card --}}
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>

	{{-- Modal tambah iuranSk --}}
  <div class="modal fade" id="modal-tambah-iuranSk" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Iuran SK</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ url('/iuranSk') }}">
            @csrf
            <div class="row justify-content-center form-group">
              <div class="form-group col-md-12 text-center mb-4">
                <label>Iuran SK untuk periode :</label>
              </div>
              <div class="col-md-4">
                <label for="pta_ata">PTA/ATA</label>
                <select class="form-control  @error('pta_ata') is-invalid @enderror" name="pta_ata" id="pta_ata">
                  <option value="">Choose..</option>
                  <option value="PTA" {{(old('pta_ata') == 'PTA') ? 'selected' : ''}}>PTA</option>
                  <option value="ATA" {{(old('pta_ata') == 'ATA') ? 'selected' : ''}}>ATA</option>
                </select>
                @error('pta_ata')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="col-md-6">
                <?php $sk_tahun = date('Y',strtotime("-1 year")).'/'.date('Y') ?>
                <label for="sk_tahun">Tahun Ajaran</label>
                <input name="sk_tahun" value="{{$sk_tahun}}" hidden>
                <input class="form-control" value="{{$sk_tahun}}" disabled>
                @error('sk_tahun')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="ml-5 pb-5">
              <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary form-btn">Insert</button>
              <button type="reset" class="btn-form btn btn-danger form-btn">Reset</button>
              <button type="button" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>{{-- End Modal --}}
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
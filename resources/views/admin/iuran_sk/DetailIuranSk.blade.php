@extends('layout.admin_cms')
@section('title', 'Iuran SK - '.$iuranSk->pta_ata.' | '.$iuranSk->sk_tahun)
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
        <div class="my-2 text-muted">
          <small>Dashboard / Kas / Iuran SK / {{$iuranSk->pta_ata.' '.$iuranSk->sk_tahun}}</small>
        </div>
				<div class="card-borderless borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">Kas (Iuran SK) Bridge Gunadarma </h1>
          </div>
					<div class="card-body">
						<div class="text-center mb-4 lead">
	          	{{$iuranSk->pta_ata}} | {{$iuranSk->sk_tahun}}
	          </div>
            @if(session('ErrorInputAtlet'))
              {!! session('ErrorInputAtlet') !!}
            @endif
            @if(session('AlertSuccessAtlet'))
              {!!session('AlertSuccessAtlet') !!}
            @endif
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-iuransk-atlet" data-toggle="modal" data-target="#modal-tambah-iuransk-atlet">Click disini</a> untuk melihat error.</p>
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
              <a id="btn-wh" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah-iuransk-atlet"><i class="far fa-plus-square"></i> Tambah data</a>
              <a id="btn-wh" href="{{ url('/iuranSk/exportPdf/'.$iuranSk->id) }}" target="__blank" class="btn bg-danger"><i class="fas fa-file-pdf"></i> Export PDF</a>
              @include('vendor.popover')
            </div>
            <div class="table-responsive-xl">
            	<table class="table table-borderless" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Atlet</th>
                    <th scope="col">Tanggal bayar</th>
                    <th scope="col">Jumlah bayar</th>
                    <th class="text-center" scope="col"> Remove</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($iuranSk->atlet as $atlet)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$atlet->atlet_name}}</td>
                    <td>
                      <?php $tgl_lahir = strtotime($atlet->pivot->sk_date) ?>
                      {{date("D, d M Y", $tgl_lahir)}}
                    </td>
                    <td>@rupiah($atlet->pivot->sk_bayar)</td>
                    <td class="text-center">
                      <a href="{{ url('/iuranSk/'.$iuranSk->id.'/'.$atlet->id.'/removeAtlet') }}" onclick="return confirm('Anda yakin?')"><h5><i class="far fa-minus-square"></i></h5></a>
                    </td>
                  </tr>
                  @endforeach
                  @if($iuranSk->atlet->isEmpty())
                    <th class="text-center font-italic lead" colspan="4">No Data.</th>
                  @else
                  <tr>
                    <td colspan="3" class="text-right"><h5>Total</h5></td>
                    <td>@rupiah($iuranSk->totalSk())</td>
                  </tr>
                  @endif
                </tbody>
            	</table>
          	</div>{{-- end table --}}
	      	</div>
        </div> {{-- end card --}}
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>
  <div class="ml-4 my-5">
    <a href="{{ url('/iuranSk') }}" class="btn btn-dark btn-sm btn-fade rounded-pill px-5 shadow"><span class="lead font-weight-bold"><i class="fas fa-caret-left"></i> Table</span></a>
  </div>
	<!-- Modal Tambah Iuran SK-->
  <div class="modal fade" id="modal-tambah-iuransk-atlet" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Tambah Data Iuran SK Atlet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-right mb-4">
            <button id="info" class="btn text-secondary" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="
              <p>Contoh pengisian <b>Jumlah Tunai</b> :</p>
              <p>300000 -> tiga ratus ribu rupiah</p>
              <p>300000.33 -> tiga ratus ribu tiga puluh tiga rupiah</p>
              " data-placement="bottom"><h5><i class="fas fa-question-circle"></i></h5>
            </button>
          </div>
          <form action="{{ url('/iuranSk/'.$iuranSk->id.'/addAtlet') }}" method="POST">
            @csrf
          	<div class="form-group">
              <label for="atlet">List atlet</label>
              <select class="form-style-static @error('atlet') is-invalid @enderror" name="atlet" id="atlet">
                <option value="">Choose..</option>
                @foreach ($data_atlet as $atlet)
                  <option value="{{$atlet->id}}" {{(old('atlet') == $atlet->id) ? 'selected':''}}>{{$atlet->atlet_name}}</option>
                @endforeach
              </select>
              @error('atlet')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="sk_date">Tanggal bayar</label>
              <input type="date" name="sk_date" id="sk_date" class="form-style @error('sk_date') is-invalid @enderror" value="{{old('sk_date')}}">
              @error('sk_date')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="sk_bayar">Jumlah Tunai yang dibayarkan</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Rp</span>
                </div>
                <input type="text" name="sk_bayar" id="rupiah" class="form-control @error('sk_bayar') is-invalid @enderror" value="{{old('sk_bayar')}}" autocomplete="off">
                @error('sk_bayar')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>	
            <div class="ml-5 pb-5">
              <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Insert</button>
              <button type="reset" class="btn-form btn btn-danger">Reset</button>
              <button type="button" class="btn-form btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @section('footer')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#dataTable').DataTable();
      });
      
      $(document).ready(function(){
          $('#rupiah').mask('#,##0.00', {reverse: true});
      })
    </script>
  @stop
@endsection
@extends('layout.admin_cms')
@section('title', 'Masterpoint Bridge Gunadarma')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<div class="card-borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">Masterpoint Bridge Gunadarma</h1>
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-masterpoint" data-toggle="modal" data-target="#modal-tambah-masterpoint">Click disini</a> untuk melihat error.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            @if(session('AlertWarning'))
              {!! session('AlertWarning') !!}
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
              <a id="btn-wh" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah-masterpoint"><i class="far fa-plus-square"></i> Tambah data</a>
              <a id="info" class="text-secondary float-right" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="@popoverText"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="left" title="click me"></i></a>
            </div>
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Atlet</th>
                    <th class="text-center" scope="col">Kedisplinan</th>
                    <th class="text-center" scope="col">Penguasaan Sistem</th>
                    <th class="text-center" scope="col">Teknik Play</th>
                    <th class="text-center" scope="col">Avarage</th>
                    <th class="text-center" width="50" scope="col">Edit</th>
                    <th class="text-center" width="50" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_mpoint as $mp)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                      <a href="{{ url('/atlet/'.$mp->atlet_id) }}">
                        @isset ($mp->atlet->atlet_name)
                            {{$mp->atlet->atlet_name}}
                        @endisset
                        </a>
                    </td>
                    <td class="text-center">{{$mp->discipline}}</td>
                    <td class="text-center">{{$mp->bidding}}</td>
                    <td class="text-center">{{$mp->play}}</td>
                    <td class="text-center">
                    		{{number_format($mp->AvarageMasterpoint(),2)}}
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/masterpoint/'.$mp->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                    </td>
                    <td class="text-center">
                      <form action="{{ url('/masterpoint/'.$mp->id) }}" method="post">
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
            <div class="mt-4">
              <p>Value Masterpoint berdasarkan penilian Coach.</p>
              <span class="font-weight-bold lead">W.D. Karamoy</span>
            </div>
          </div>
        </div> {{-- end card --}}
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>

	{{-- Modal tambah Masterpoint --}}
  <div class="modal fade" id="modal-tambah-masterpoint" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Masterpoint</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ url('/masterpoint') }}">
            @csrf
            <div class="row justify-content-center">
            	<div class="form-group col-md-6">
                <label for="atlet_id">Atlet</label>
                <select class="form-style-static  @error('atlet_id') is-invalid @enderror" name="atlet_id" id="atlet_id">
	                @foreach ($data_atlet as $atlet)
                    <option value="{{$atlet->id}}" {{ old('atlet_id') == $atlet->id ? 'selected' : ''}}>
                      {{$atlet->atlet_name}}</option>
	                @endforeach
	              </select>
                @error('atlet_id')
                  <div class="invalid-feedback">
                  	{{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="discipline">Kedisiplinan</label>
                <input type="number" name="discipline" id="discipline" class="form-style-static @error('discipline') is-invalid @enderror" step="0.01" value="{{old('discipline')}}" autocomplete="off">
                @error('discipline')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="bidding">Penguasaan Sistem</label>
                <input type="number" name="bidding" id="bidding" class="form-style-static @error('bidding') is-invalid @enderror" step="0.01" value="{{old('bidding')}}" autocomplete="off">
                @error('bidding')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="play">Teknik Play</label>
                <input type="number" name="play" id="play" class="form-style-static @error('play') is-invalid @enderror" value="{{old('play')}}" step="0.01" autocomplete="off">
                @error('play')
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
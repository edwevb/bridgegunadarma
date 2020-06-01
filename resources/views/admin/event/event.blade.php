@extends('layout.admin_cms')
@section('title','Event')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- Start Content --}}
		<div class="col-lg d-flex">
			<div class="container">
			 	<div class="card-borderless">
	        <div class="card-header">
	          <h1 id="cms-header" class="text-center font-weight-bold">Table Event</h1>
	        </div>
	        <div class="card-body">
	        	@if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-event" data-toggle="modal" data-target="#modal-tambah-event">Click disini</a> untuk melihat error.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            @if (session('AlertSuccess'))
              <div class="text-center">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('AlertSuccess') }}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            @endif
						<div class="mb-2">
              <a id="btn-wh" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah-event"><i class="far fa-plus-square"></i> Tambah data</a>
              <a id="info" class="text-secondary float-right" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="@popoverText"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="left" title="click me"></i></a>
            </div>
            <div class="table-responsive-xl mt-4">
		          <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
		            <thead class="thead-dark">
		              <tr>
		                <th scope="col" width="10">No</th>
		                <th scope="col">Judul Event</th>
		                <th scope="col">Tanggal Event</th>
		                <th class="text-center" width="50" scope="col">Detail</th>
		                <th class="text-center" width="50" scope="col">Edit</th>
		                <th class="text-center" width="50" scope="col">Delete</th>
		              </tr>
		            </thead>
		            <tbody>
		              @foreach ($data_event as $event)
		              <tr>
		                <th scope="row">{{$loop->iteration}}</th>
		                <td>
		                	<a href="#" class="text-primary" >{{$event->eve_title}}</a>
		                </td>
		                <td>
		                	<?php $eve_date = strtotime($event->eve_date) ?>
		                  {{date("d M Y", $eve_date)}}
		                </td>
		                <td class="text-center">
		                	<a class="btn-table btn btn-transparent" href="{{ url('/event/'.$event->id) }}"><i class="fas fa-book"></i></a>
		                </td>
		                <td class="text-center">
		                	<a class="btn-table btn btn-transparent" href="{{ url('/event/'.$event->id.'/edit') }}"><i class="fa fa-edit"></i></a>
		                </td>
		                <td class="text-center">
		                  <form action="{{ url('/event/'.$event->id) }}" method="post">
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
	    	</div>{{-- end card --}}
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>

	{{-- Modal tambah event --}}
  <div class="modal fade" id="modal-tambah-event" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Event</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
        <div class="modal-body">
          <div class="text-right mb-4">
            <button id="info" class="btn text-secondary" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="
              <p>Tanda <strong>(*)</strong> Field boleh kosong.</p>
              <p>Contoh pengisian <b>Biaya Pendaftaran</b> :</p>
              <p>300000 -> tiga ratus ribu rupiah</p>
              <p>300000.33 -> tiga ratus ribu tiga puluh tiga rupiah</p>
              <p>Fee lainnya <i>(yang tidak ada pada field biaya pendafraran)</i> bisa ditambahkan pada field  <b>Deskripsi</b></p>
              " data-placement="bottom"><h5><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="click me"></i></h5>
            </button>
          </div>
          <form method="post" action="{{ url('/event') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="form-group col-md-6">
                <label for="eve_title">Judul</label>
                <input type="text" name="eve_title" id="eve_title" class="form-style @error('eve_title') is-invalid @enderror" value="{{old('eve_title')}}">
                @error('eve_title')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="eve_date">Tanggal</label>
                <input type="date" name="eve_date" id="eve_date" class="form-style @error('eve_date') is-invalid @enderror" value="{{old('eve_date')}}">
                @error('eve_date')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="eve_loc">Lokasi</label>
                <input type="text" name="eve_loc" id="eve_loc" class="form-style @error('eve_loc') is-invalid @enderror" value="{{old('eve_loc')}}">
                @error('eve_loc')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
               <label for="gender">URL*</label>
                <input type="text" name="eve_url" id="eve_url" class="form-style @error('eve_url') is-invalid @enderror" placeholder="example : www.bridgegunadarma.com" value="{{old('eve_url')}}">
                @error('eve_url')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="kontak">Kontak*</label>
                <textarea name="kontak" id="kontak" class="form-style" placeholder="No Hp / Social Media yang dapat dihubungi">{{old('kontak')}}</textarea>
              </div>
            </div>
            <div class="row form-group">
              <div class="form-group col-md-12 text-center mb-4">
                <label>Biaya Pendaftaran Team* </label>
              </div>
              <div class="col-md-4">
              	<label for="fee_team_open">Open</label>
                <input type="text" name="fee_team_open" id="fee_team_open" class="form-style @error('fee_team_open') is-invalid @enderror" value="{{old('fee_team_open')}}" min="0.1" step="0.01">
                @error('fee_team_open')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="col-md-4">
              	<label for="fee_team_mhs">Mahasiswa / U26</label>
                <input type="text" name="fee_team_mhs" id="fee_team_mhs" class="form-style  @error('fee_team_mhs') is-invalid @enderror" value="{{old('fee_team_mhs')}}">
                @error('fee_team_mhs')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="col-md-4">
              	<label for="fee_team_u21">Pelajar / U-21</label>
                <input type="text" name="fee_team_u21" id="fee_team_u21" class="form-style @error('fee_team_u21') is-invalid @enderror" value="{{old('fee_team_u21')}}">
                @error('fee_team_u21')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row form-group">
              <div class="form-group col-md-12 text-center mb-4">
                <label>Biaya Pendaftaran Pasangan*</label>
              </div>
              <div class="col-md-4">
                <label for="fee_pas_open">Open</label>
                <input type="text" name="fee_pas_open" id="fee_pas_open" class="form-style @error('fee_pas_open') is-invalid @enderror" value="{{old('fee_pas_open')}}" min="0.1" step="0.01">
                @error('fee_pas_open')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="fee_pas_mhs">Mahasiswa / U26</label>
                <input type="text" name="fee_pas_mhs" id="fee_pas_mhs" class="form-style  @error('fee_pas_mhs') is-invalid @enderror" value="{{old('fee_pas_mhs')}}">
  
                @error('fee_pas_mhs')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="fee_pas_u21">Pelajar / U-21</label>
                <input type="text" name="fee_pas_u21" id="fee_pas_u21" class="form-style @error('fee_pas_u21') is-invalid @enderror" value="{{old('fee_pas_u21')}}">
  
                @error('fee_pas_u21')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group col-md-6 mx-auto">
              <div class="text-center">
                <label for="prizepool">Prizepool*</label>
              </div>
              <input type="text" name="prizepool" id="prizepool" class="form-style-static @error('prizepool') is-invalid @enderror" value="{{old('prizepool')}}">
              @error('prizepool')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="eve_isi">Deskripsi*</label>
                <textarea name="eve_isi" id="eve_isi" class="form-style @error('eve_isi') is-invalid @enderror" placeholder="Event descripton..">{{old('eve_isi')}}</textarea>
                @error('eve_isi')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label>Upload Picture*</label>
              <div class="border-0">
                <img class="rounded col-md-2" id="FilePreview" alt="image preview" src="{{ asset('assets/img/img_eve/default.png') }}">
                @error('img_eve')
                  <div class="invalid-feedback d-flex">
                    {{$message}}
                  </div>
                @enderror
                <small class="form-text text-muted file-desc">max size 2 MB</small>
              </div>
              <div class="custom-file col-md-4 d-flex mt-2">
                <input type="file" class="custom-file-input @error('img_eve') is-invalid @enderror" id="FileSource" name="img_eve" onchange="previewImage();" accept="image/*">
                <label class="custom-file-label" for="img_eve">Choose image..</label>
              </div>
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
  </div>{{-- end modal tambah event --}}
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
{{-- <div class="col-md-3">
  <label for="param">Fee Team</label>
  <p class="card-text"><small class="text-muted">(.) sebagai pemisah decimal</small></p>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-default">Rp</span>
    </div>
    <input type="text" name="param" id="param" class="form-control @error('param') is-invalid @enderror rp" value="{{old('param')}}" min="0.1" step="0.01">
  </div>
</div> --}}
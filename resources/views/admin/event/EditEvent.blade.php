@extends('layout.admin_cms')
@section('title','Edit '.$event->eve_title)
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<div class="my-2 text-muted">
	        <small>Dashboard / Data / Event / Edit / {{$event->eve_title}}</small>
	      </div>
				<section id="edit">
          <div class="card-borderless">
            <div class="card-header borderless rounded shadow-sm">
              <h3 id="cms-header" class="text-center">Form Edit Event</h3>
            </div>
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center m-4" role="alert">
                <p>&nbsp;<a class="font-weight-bold text-danger">Gagal memperbaharui data {{$event->eve_title}}!</a> Cek kembali inputan anda.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="card-body">
            	<div class="text-right mb-4">
            		<button id="info" class="btn text-secondary" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="
			            <p>Tanda <strong>(*)</strong> Field boleh kosong.</p>
			            <p>Contoh pengisian <b>Biaya Pendaftaran</b> :</p>
			            <p>300000 -> tiga ratus ribu rupiah</p>
			            <p>300000.33 -> tiga ratus ribu tiga puluh tiga rupiah</p>
			            <p>Fee lainnya <i>(yang tidak ada pada field biaya pendafraran)</i> bisa ditambahkan pada field  <b>Deskripsi</b></p>
			            " data-placement="bottom"><h5><i class="fas fa-question-circle"></i></h5>
			          </button>
            	</div>
              <form method="post" action="{{ url('/event/'.$event->id) }}" enctype="multipart/form-data">
		            @method('patch')
		            @csrf
		            <div class="row">
		              <div class="form-group col-md-6">
		                <label for="eve_title">Judul</label>
		                <input type="text" name="eve_title" id="eve_title" class="form-style @error('eve_title') is-invalid @enderror" value="{{$event->eve_title}}" autocomplete="off">
		                @error('eve_title')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="form-group col-md-6">
		                <label for="eve_date">Tanggal</label>
		                <input type="date" name="eve_date" id="eve_date" class="form-style-static @error('eve_date') is-invalid @enderror" value="{{$event->eve_date}}">
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
		                <input type="text" name="eve_loc" id="eve_loc" class="form-style @error('eve_loc') is-invalid @enderror" value="{{$event->eve_loc}}" autocomplete="off">
		                @error('eve_loc')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="form-group col-md-6">
		               <label for="gender">URL*</label>
		                <input type="text" name="eve_url" id="eve_url" class="form-style @error('eve_url') is-invalid @enderror" placeholder="example : www.bridgegunadarma.com" value="{{$event->eve_url}}" autocomplete="off">
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
		                <textarea name="kontak" id="kontak" class="form-style" placeholder="No Hp / Social Media yang dapat dihubungi">{!!$event->kontak!!}</textarea>
		              </div>
		            </div>
		            <div class="row form-group">
		              <div class="form-group col-md-12 mb-4 text-center rounded">
		                <label class="lead">Biaya Pendaftaran Team*</label>
		              </div>
		              <div class="col-md-4">
		              	<label for="fee_team_open">Open</label>
		                <input type="text" name="fee_team_open" id="fee_team_open" class="form-style-static @error('fee_team_open') is-invalid @enderror" value="{{$event->fee_team_open}}" autocomplete="off">
		                @error('fee_team_open')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="col-md-4">
		              	<label for="fee_team_mhs">Mahasiswa / U26</label>
		                <input type="text" name="fee_team_mhs" id="fee_team_mhs" class="form-style-static @error('fee_team_mhs') is-invalid @enderror" value="{{$event->fee_team_mhs}}" autocomplete="off">
		                @error('fee_team_mhs')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="col-md-4">
		              	<label for="fee_team_u21">Pelajar / U-21</label>
		                <input type="text" name="fee_team_u21" id="fee_team_u21" class="form-style-static @error('fee_team_u21') is-invalid @enderror" value="{{$event->fee_team_u21}}" autocomplete="off">
		                @error('fee_team_u21')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		            </div>
		            <div class="row form-group">
		              <div class="form-group col-md-12 mb-4 text-center ">
		                <label class="lead">Biaya Pendaftaran Pasangan*</label>
		              </div>
		              <div class="col-md-4">
		                <label for="fee_pas_open">Open</label>
		                <input type="text" name="fee_pas_open" id="fee_pas_open" class="form-style-static @error('fee_pas_open') is-invalid @enderror" value="{{$event->fee_pas_open}}" autocomplete="off">
		                @error('fee_pas_open')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="col-md-4">
		                <label for="fee_pas_mhs">Mahasiswa / U26</label>
		                <input type="text" name="fee_pas_mhs" id="fee_pas_mhs" class="form-style-static @error('fee_pas_mhs') is-invalid @enderror" value="{{$event->fee_pas_mhs}}" autocomplete="off">
		                @error('fee_pas_mhs')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="col-md-4">
		                <label for="fee_pas_u21">Pelajar / U-21</label>
		                <input type="text" name="fee_pas_u21" id="fee_pas_u21" class="form-style-static @error('fee_pas_u21') is-invalid @enderror" value="{{$event->fee_pas_u21}}" autocomplete="off">
		                @error('fee_pas_u21')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group col-md-6 mx-auto">
		              <div class="text-center">
		                <label for="prizepool" class="lead">Prizepool*</label>
		              </div>
		              <input type="text" name="prizepool" id="prizepool" class="form-style-static @error('prizepool') is-invalid @enderror" value="{{$event->prizepool}}" autocomplete="off">
		              @error('prizepool')
		                <div class="invalid-feedback">
		                  {{$message}}
		                </div>
		              @enderror
		            </div>
		            <div class="form-group row">
		              <div class="col-md-12">
		                <label for="eve_isi">Deskripsi</label>
		                <textarea name="eve_isi" id="eve_isi" class="form-style @error('eve_isi') is-invalid @enderror" placeholder="Event descripton..">{{$event->eve_isi}}</textarea>
		                @error('eve_isi')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group border-left-info rounded p-2">
		              <label>Upload Picture*</label>
		              <div class="border-0 col-md-2">
		                <img class="rounded col-md" id="FilePreview" alt="image preview" src="{{ asset('assets/img/img_eve/'.$event->img_eve) }}">
		                @error('img_eve')
		                  <div class="invalid-feedback d-flex">
		                    {{$message}}
		                  </div>
		                @enderror
		                <small class="form-text text-muted file-desc">max size 2 MB</small>
		              </div>
		              <div class="custom-file col-md-5 d-flex mt-2">
		                <input type="file" class="custom-file-input @error('img_eve') is-invalid @enderror" id="FileSource" name="img_eve" onchange="previewImage();" accept="image/*">
		                <label class="custom-file-label" for="img_eve">
			                @if($event->img_eve=='default.png'||$event->img_eve==Null)
	                      Choose an image..
	                    @else
	                    	{!! $event->img_eve !!}
	                    @endif
		                </label>
		              </div>
		            </div>
		            <div class="ml-3">
		              <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary form-btn">Save Changes</button>
		              <button type="reset" class="btn-form btn btn-danger form-btn">Reset</button>
		              <a href="{{ url('/event') }}" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Back</a>
		            </div>
		          </form>
            </div> {{-- end card body --}}
          </div> {{-- end card --}}
        </section>
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>
@section('footer')
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script>
    $(document).ready(function(){
        $('#fee_team_open').mask('#,##0.00', {reverse: true});
        $('#fee_team_mhs').mask('#,##0.00', {reverse: true});
        $('#fee_team_u21').mask('#,##0.00', {reverse: true});
        $('#fee_pas_open').mask('#,##0.00', {reverse: true});
        $('#fee_pas_mhs').mask('#,##0.00', {reverse: true});
        $('#fee_pas_u21').mask('#,##0.00', {reverse: true});
        $('#prizepool').mask('#,##0.00', {reverse: true});
    })
  </script>
@stop
@endsection
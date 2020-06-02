@extends('layout.admin_cms')
@section('title','Edit '.$prestasi->pre_title)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    <div class="col-lg">
      {{-- start content --}}
      <section id="edit">
        <div class="card-borderless"> {{-- card --}}
          <div class="card-header borderless rounded border-l-i_border-r-d shadow-sm bg-white">
            <h3 id="cms-header" class="text-center">Form Edit Prestasi</h3>
          </div>
         @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show text-center m-4" role="alert">
              <p>&nbsp;<a class="font-weight-bold text-danger">Gagal memperbaharui data {{$prestasi->pre_title}}!</a> Cek kembali inputan anda.</p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <div class="card-body">
            <div class="text-right mb-4">
              <button id="info" class="btn text-secondary" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="
                <p>Tanda <strong>(*)</strong> Field boleh kosong.</p>
                " data-placement="bottom"><h5><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="click me"></i></h5>
              </button>
            </div>
            <form novalidate method="post" action="{{ url('/prestasi/'.$prestasi->id) }}" enctype="multipart/form-data">
              @method('patch')
              @csrf
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="pre_title">Judul Tournament/Event</label>
                  <input type="text" name="pre_title" id="pre_title" class="form-style @error('pre_title') is-invalid @enderror" value="{{$prestasi->pre_title}}">
                  @error('pre_title')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label for="pre_date">Date</label>
                  <input type="date" name="pre_date" id="pre_date" class="form-style @error('pre_date') is-invalid @enderror" value="{{$prestasi->pre_date}}">
                  @error('pre_date')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="pre_isi">Prestasi yang didapatkan</label>
                  <textarea type="text" name="pre_isi" id="pre_isi" class="form-style" placeholder="Write here..">{!!$prestasi->pre_isi!!}</textarea>
                </div>
              </div>
              <div class="form-group border-left-info rounded p-2">
                <label>Upload Picture*</label>
                <div class="border-0 col-md-2">
                  <img height="200" width="auto" class="rounded" id="FilePreview" alt="image preview" src="{{ asset('assets/img/img_pre/'.$prestasi->img_pre) }}">
                  @error('img_pre')
                    <div class="invalid-feedback d-flex">
                      {{$message}}
                    </div>
                  @enderror
                  <small class="file-desc form-text text-muted">max size 2 MB</small>
                </div>
                <div class="custom-file col-md-5 d-flex mt-2">
                  <input type="file" class="custom-file-input @error('img_pre') is-invalid @enderror" id="FileSource" name="img_pre" onchange="previewImage();" accept="image/*">
                  <label class="custom-file-label" for="img_pre">
                    @if($prestasi->img_pre=='default.png'||$prestasi->img_pre==Null)
                      Choose an image..
                    @else
                      {!! $prestasi->img_pre !!}
                    @endif
                  </label>
                </div>
              </div>
              <div class="ml-3">
                <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Save Changes</button>
                <button type="reset" class="btn-form btn btn-danger">Reset</button>
                <a href="{{ url('/prestasi') }}" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Back</a>
              </div>
            </form>
          </div>
        </div> {{-- end card --}}
      </section> {{-- end content --}}
    </div>
  </div>
@section('footer')
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
@stop
@endsection
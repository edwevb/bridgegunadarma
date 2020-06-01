@extends('layout.admin_cms')
@section('title','Edit '.$atlet->atlet_name)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <section id="edit">
          <div class="card-borderless">
            <div class="card-header borderless rounded border-l-i_border-r-d shadow-sm bg-white">
              <h3 id="cms-header" class="text-center">Form Edit Atlet</h3>
            </div>
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center m-4" role="alert">
                <p>&nbsp;<span class="font-weight-bold text-danger">Gagal memperbaharui data {{$atlet->atlet_name}}!</span> Cek kembali inputan anda.</p>
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
              <form method="post" action="{{ url('/atlet/'.$atlet->id) }}" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="nik">NIK/NPM</label>
                    <input type="text" name="nik" id="nik" class="form-style @error('nik') is-invalid @enderror" value="{{$atlet->nik}}">
                    @error('nik')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="atlet_name">Nama</label>
                    <input type="text" name="atlet_name" id="atlet_name" class="form-style @error('atlet_name') is-invalid @enderror" value="{{$atlet->atlet_name}}">
                    @error('atlet_name')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-style @error('tgl_lahir') is-invalid @enderror" value="{{$atlet->tgl_lahir}}">
                    @error('tgl_lahir')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                   <label for="gender">Jenis Kelamin</label><br>
                   <?php $gender = ['male', 'female'] ?>
                    <select class="form-style" name="gender" id="gender">
                      <?php $gender = ['Male', 'Female'];
                      foreach($gender as $g):?>
                      @if ($g == $atlet['gender'])
                        <option value=" <?= $g; ?>" selected><?= $g ;?></option>
                      @else
                        <option value=" <?= $g; ?>"><?= $g ;?></option>
                      @endif
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="telp">No Telp</label>
                    <input type="text" name="telp" id="telp" class="form-style @error('telp') is-invalid @enderror" value="{{$atlet->telp}}">
                    @error('telp')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-style @error('email') is-invalid @enderror" value="{{$atlet->email}}">
                    @error('email')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="fakultas">Fakultas</label>
                    <input type="text" name="fakultas" id="fakultas" class="form-style @error('fakultas') is-invalid @enderror" value="{{$atlet->fakultas}}">
                    @error('fakultas')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" name="jurusan" id="jurusan" class="form-style @error('jurusan') is-invalid @enderror" value="{{$atlet->jurusan}}">
                    @error('jurusan')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="alamat">Alamat*</label>
                    <input type="text" name="alamat" id="alamat" class="form-style @error('alamat') is-invalid @enderror" value="{{$atlet->alamat}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="angkatan">Angkatan*</label>
                    <input type="text" name="angkatan" id="angkatan" class="form-style @error('angkatan') is-invalid @enderror" value="{{$atlet->angkatan}}">
                    @error('angkatan')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="row form-group">
                  <div class="form-group col-md-12 text-center mb-4">
                    <label for="fb">Social Media*</label>
                  </div>
                  <div class="col-md-4 mb-4">
                    <input type="text" name="fb" id="fb" class="form-style @error('fb') is-invalid @enderror" value="{{$atlet->fb}}" placeholder="Facebook ID/URL">
                  </div>
                  <div class="col-md-4 mb-4">
                    <input type="text" name="twt" id="twt" class="form-style @error('twt') is-invalid @enderror" value="{{$atlet->twt}}" placeholder="Twitter ID/URL">
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="ig" id="ig" class="form-style @error('ig') is-invalid @enderror" value="{{$atlet->ig}}" placeholder="Instagram ID/URL">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <label for="brg_taught">Deskripsi*</label>
                    <textarea type="text" name="brg_taught" id="brg_taught" class="form-style" placeholder="What have you learned from bridge?">{!!$atlet->brg_taught!!}</textarea>
                  </div>
                </div>
                <div class="form-group border-left-info rounded p-2">
                  <label>Upload Picture*</label>
                  <div class="border-0 col-md-2">
                    <img height="200" width="auto" class="rounded" id="FilePreview" alt="image preview" src="{{ asset('assets/img/img_atlet/'.$atlet->img_atlet) }}">
                  </div>
                  @error('img_atlet')
                    <div class="invalid-feedback d-flex form-text">
                      {{$message}}
                    </div>
                  @enderror
                  <small class="form-text text-muted file-desc">max size 2 MB</small>
                  <div class="custom-file col-md-5 d-flex mt-2">
                    <input type="file" class="custom-file-input @error('img_atlet') is-invalid @enderror" id="FileSource" name="img_atlet" onchange="previewImage();"accept="image/*">
                    <label class="custom-file-label" for="img_atlet">
                      @if($atlet->img_atlet=='default.png'||$atlet->img_atlet==Null)
                        Choose an image..
                      @else
                      {!! $atlet->img_atlet !!}
                      @endif
                    </label>
                  </div>
                </div>
                <div class="ml-3">
                  <button onclick="javascript: return confirm('Tambahkan ke DATABASE ?')" type="submit" class="btn-form btn btn-primary">Save Changes</button>
                  <button type="reset" class="btn-form btn btn-danger">Reset</button>
                  <a href="{{ url('/atlet') }}" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Back</a>
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
@stop
@endsection
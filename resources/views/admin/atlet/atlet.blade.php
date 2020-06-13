@extends('layout.admin_cms')
@section('title', 'Atlet Bridge Gunadarma')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- Content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <div class="card-borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">Atlet Bridge Gunadarma</h1>
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                {{-- <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul> --}}
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-atlet" data-toggle="modal" data-target="#modal-tambah-atlet">Click disini</a> untuk melihat error.</p>
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
              <a id="btn-wh" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah-atlet"><i class="far fa-plus-square"></i> Tambah data</a>
              <a id="btn-wh" href="{{ url('/atlet/exportPdf') }}" target="__blank" class="btn bg-danger"><i class="fas fa-file-pdf"></i> Export PDF</a>
              <a id="info" class="text-secondary float-right" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="@popoverText"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="left" title="click me"></i></a>
            </div>
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th width="10">No</th>
                    <th scope="col">Nama Atlet</th>
                    <th scope="col">No Handphone</th>
                    <th scope="col">Fakultas</th>
                    <th class="text-center" width="50" scope="col">Detail</th>
                    <th class="text-center" width="50" scope="col">Edit</th>
                    <th class="text-center" width="50" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_atlet as $atlet)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$atlet->atlet_name}}</td>
                    <td>{{$atlet->telp}}</td>
                    <td>{{$atlet->fakultas}}</td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/atlet/'.$atlet->id) }}"><i class="fas fa-address-book"></i></a>
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/atlet/'.$atlet->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                    </td>
                    <td class="text-center">
                      <form action="{{ url('/atlet/'.$atlet->id) }}" method="post">
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
      </div>{{-- end container --}}
    </div>{{-- end content --}}
  </div>

  {{-- Modal tambah atlet --}}
  <div class="modal fade" id="modal-tambah-atlet" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Atlet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-right mb-4">
            <button id="info" class="btn text-secondary" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="
              <p>Tanda <strong>(*)</strong> Field boleh kosong.</p>
              " data-placement="bottom"><h5><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="click me"></i></h5>
            </button>
          </div>
          <form method="post" action="{{ url('/atlet') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="form-group col-md-6">
                <label for="nik">NIK/NPM</label>
                <input type="text" name="nik" id="nik" class="form-style  @error('nik') is-invalid @enderror" value="{{old('nik')}}" autocomplete="off">
                @error('nik')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="atlet_name">Nama</label>
                <input type="text" name="atlet_name" id="atlet_name" class="form-style  @error('atlet_name') is-invalid @enderror" value="{{old('atlet_name')}}" autocomplete="off">
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
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-style  @error('tgl_lahir') is-invalid @enderror" value="{{old('tgl_lahir')}}">
                @error('tgl_lahir')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
               <label for="gender">Jenis Kelamin</label>
                <select class="form-style-static @error('gender') is-invalid @enderror" name="gender" id="gender">
                  <option value="">Choose..</option>
                  <option value="Male" {{(old('gender') == 'Male') ? 'selected' : ''}}>Male</option>
                  <option value="Female" {{(old('gender') == 'Female') ? 'selected' : ''}}>Female</option>
                </select>
                @error('gender')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="telp">Telp</label>
                <input type="tel" name="telp" id="telp" class="form-style  @error('telp') is-invalid @enderror" value="{{old('telp')}}" autocomplete="off">
                @error('telp')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-style  @error('email') is-invalid @enderror" value="{{old('email')}}" autocomplete="off">
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
                <input type="text" name="fakultas" id="fakultas" class="form-style  @error('fakultas') is-invalid @enderror" value="{{old('fakultas')}}">
                @error('fakultas')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" class="form-style  @error('jurusan') is-invalid @enderror" value="{{old('jurusan')}}">
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
                <input type="text" name="alamat" id="alamat" class="form-style  @error('alamat') is-invalid @enderror" value="{{old('alamat')}}">
              </div>
              <div class="form-group col-md-6">
                <label for="angkatan">Angkatan*</label>
                <input type="text" name="angkatan" id="angkatan" class="form-style  @error('angkatan') is-invalid @enderror" value="{{old('angkatan')}}" autocomplete="off">
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
              <div class="col-md-4">
                <input type="text" name="fb" id="fb" class="form-style  @error('fb') is-invalid @enderror" value="{{old('fb')}}" placeholder="Facebook ID/URL" autocomplete="off">
              </div>
              <div class="col-md-4">
                <input type="text" name="twt" id="twt" class="form-style  @error('twt') is-invalid @enderror" value="{{old('twt')}}" placeholder="Twitter ID/URL" autocomplete="off">
              </div>
              <div class="col-md-4">
                <input type="text" name="ig" id="ig" class="form-style  @error('ig') is-invalid @enderror" value="{{old('ig')}}" placeholder="Instagram ID/URL" autocomplete="off">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="brg_taught">Deskripsi*</label>
                <textarea name="brg_taught" id="brg_taught" class="form-style" placeholder="What have you learned from bridge?">{{old('brg_taught')}}</textarea>
              </div>
            </div>
            <div class="form-group p-2 border-left-info rounded">
              <label>Upload Picture*</label>
              <div class="border-0 col-md-2">
                <img height="200" width="auto" class="rounded" id="FilePreview" alt="image preview" src="{{ asset('assets/img/img_atlet/default.png') }}">
                @error('img_atlet')
                  <div class="invalid-feedback d-flex">
                    {{$message}}
                  </div>
                @enderror
                <small class="form-text text-muted file-desc">max size 2 MB</small>
              </div>
              <div class="custom-file col-md-4 d-flex mt-2">
                <input type="file" class="custom-file-input @error('img_atlet') is-invalid @enderror" id="FileSource" name="img_atlet" onchange="previewImage();" accept="image/*">
                <label class="custom-file-label" for="img_atlet">Choose an image..</label>
              </div>
            </div>
            <div class="ml-5 pb-5">
              <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Insert</button>
              <button type="reset" class="shadow btn-form btn btn-danger">Reset</button>
              <button type="button" class="shadow btn-form btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>{{-- end modal tambah atlet --}}
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
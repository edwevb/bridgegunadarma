@extends('layout.admin_cms')
@section('title', 'Prestasi Bridge Gunadarma')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- Content --}}
    <div class="col-lg d-flex">
      <div class="container-fluid">
        <div class="card-borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">Prestasi Bridge Gunadarma</h1>
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-prestasi" data-toggle="modal" data-target="#modal-tambah-prestasi">Click disini</a> untuk melihat error.</p>
                {{-- <strong>{{ $error['error_input_data'] }}</strong> --}}
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
              <a id="btn-wh" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah-prestasi"><i class="far fa-plus-square"></i> Tambah data</a>
              <a id="info" class="text-secondary float-right" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="@popoverText"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="left" title="click me"></i></a>
            </div>
            <div class="table-responsive-xl mt-4">
              <table  class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th width="10">No</th>
                    <th scope="col">List Prestasi</th>
                    <th scope="col">Date</th>
                    <th class="text-center" width="50" scope="col">Detail</th>
                    <th class="text-center" width="50" scope="col">Edit</th>
                    <th class="text-center" width="50" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_prestasi as $prestasi)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><a href="{{ url('/prestasi/'.$prestasi->id) }}">{{$prestasi->pre_title}}</a></td>
                    <td>
                      <?php $pre_date = strtotime($prestasi->pre_date); ?> 
                      {{date("d M Y", $pre_date)}}
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/prestasi/'.$prestasi->id) }}"><i class="fas fa-book"></i></a>
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/prestasi/'.$prestasi->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                    </td>
                    <td class="text-center">
                      <form action="{{ url('/prestasi/'.$prestasi->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn-table btn btn-transparent" onclick="return confirm('Anda yakin?')"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>{{-- End Card Table --}}
      </div>{{-- end container --}}
    </div>{{-- end content --}}
  </div>

  {{-- Modal tambah prestasi --}}
  <div class="modal fade" id="modal-tambah-prestasi" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Prestasi</h5>
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
          <form method="post" action="{{ url('/prestasi') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="pre_title">Nama Tournament / Event</label>
              <input type="text" name="pre_title" id="pre_title" class="form-style @error('pre_title') is-invalid @enderror" value="{{old('pre_title')}}">
              @error('pre_title')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="pre_date">Tanggal</label>
              <input type="date" name="pre_date" id="pre_date" class="form-style @error('pre_date') is-invalid @enderror" value="{{old('pre_date')}}">
              @error('pre_date')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label>Prestasi yang didapatkan</label>
                <textarea name="pre_isi" id="pre_isi" class="form-style" placeholder="Write here..">{{old('pre_isi')}}</textarea>
                @error('pre_isi')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>  
            </div>
            <div class="form-group">
              <label>Upload Picture*</label>
              <div class="border-0">
                <img class="rounded col-md-4" id="FilePreview" alt="image preview" src="{{ asset('assets/img/img_pre/default.png') }}">
                @error('img_pre')
                  <div class="invalid-feedback d-flex">
                    {{$message}}
                  </div>
                @enderror
                <small class="form-text text-muted file-desc">max size 2 MB</small>
              </div>
              <div class="custom-file d-flex col-md mt-2">
                <input type="file" class="custom-file-input @error('img_pre') is-invalid @enderror" id="FileSource" name="img_pre" onchange="previewImage();" accept="image/*">
                <label class="custom-file-label" for="img_pre">Choose image..</label>
              </div>
            </div>
            <div class="pb-5 ml-5">
  	          <button onclick="javascript: return confirm('Tambahkan ke DATABASE ?')" type="submit" class="btn-form btn btn-primary form-btn">Insert</button>
  	          <button type="reset" class="btn-form btn btn-danger form-btn">Reset</button>
  	          <button type="button" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>{{-- Modal tambah prestasi --}}
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
@extends('layout.admin_cms')
@section('title', 'Materi Bridge Gunadarma')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- Start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <div class="card-borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">Materi Bridge Gunadarma</h1>
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
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-materi" data-toggle="modal" data-target="#modal-tambah-materi">Click disini</a> untuk melihat error.</p>
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
              <a id="btn-wh" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah-materi"><i class="far fa-plus-square"></i> Tambah data</a>
              <a id="info" class="text-secondary float-right" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="@popoverText"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="left" title="click me"></i></a>
            </div>
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Judul Materi</th>
                    <th scope="col">Tanggal Upload</th>
                    <th class="text-center" width="50" scope="col">Detail</th>
                    <th class="text-center" width="50" scope="col">Edit</th>
                    <th class="text-center" width="50" scope="col">Delete</th>
                    <th class="text-center" width="50">Download</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_materi as $materi)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                      <a href="{{ url('/materi/'.$materi->id) }}" class="text-primary" >{{strtoupper($materi->mat_title)}}</a>
                    </td>
                    <td>
                      <?php $mat_date = strtotime($materi->mat_date) ?>
                      {{date("d M Y", $mat_date)}}
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/materi/'.$materi->id) }}"><i class="fas fa-book"></i></a>
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/materi/'.$materi->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                    </td>
                    <td class="text-center">
                      <form action="{{ url('/materi/'.$materi->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn-table btn btn-transparent" onclick="return confirm('Anda yakin?')"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/materi/'.$materi->id.'/download') }}"><i class="fas fa-download"></i></a>
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

  {{-- Modal tambah materi --}}
  <div class="modal fade" id="modal-tambah-materi" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Materi</h5>
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
          <form method="post" action="{{ url('/materi') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="mat_title">Judul</label>
              <input type="text" name="mat_title" id="mat_title" class="form-style @error('mat_title') is-invalid @enderror" value="{{old('mat_title')}}" autocomplete="off">
              @error('mat_title')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="mat_date">Tanggal Upload</label>
              <input type="date" name="mat_date" id="CurrentDate" class="form-style @error('mat_date') is-invalid @enderror" value="{{old('mat_date')}}">
              @error('mat_date')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Deskripsi*</label>
              <textarea name="mat_keterangan" id="mat_keterangan" class="form-style" placeholder="Write here.. or Upload File below">{{old('mat_keterangan')}}</textarea>
            </div>
            <div class="form-group">
              <label>Upload File*</label>
              <div class="border-0">
                @error('file_mat')
                  <div class="invalid-feedback d-flex">
                    {{$message}}
                  </div>
                @enderror
                <div class="file-desc">
                  <table id="table-file" class="table-borderless">
                    <tr>
                      <th><small class="form-text text-muted">Max size</small></th>
                      <td><small class="form-text text-muted">:</small></td>
                      <td ><small class="form-text text-muted">10 MB</small></td>
                    </tr>
                    <tr>
                      <th><small class="form-text text-muted">Format file</small></th>
                      <td><small class="form-text text-muted">:</small></td>
                      <td><small class="form-text text-muted">such as .pdf .doc .zip etc..</small></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="custom-file d-flex mt-2 col-md-10">
                <input type="file" class="custom-file-input  @error('file_mat') is-invalid @enderror" id="FileSource" name="file_mat" onchange="previewImage();" accept="@file">
                <label class="custom-file-label" for="file_mat">Choose a file..</label>
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
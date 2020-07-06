@extends('layout.admin_cms')
@section('title','Edit '.$materi->mat_title)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    <div class="col-lg d-flex">
      {{-- start content --}}
      <div class="container">
      <div class="my-2 text-muted">
        <small>Dashboard / Data / Materi / Edit / {{$materi->mat_title}}</small>
      </div>
        <div class="card-borderless"> {{-- card --}}
          <div class="card-header borderless rounded shadow-sm">
            <h3 id="cms-header" class="text-center">Form Edit Materi</h3>
          </div>
           @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center m-4" role="alert">
                <p>&nbsp;<a class="font-weight-bold text-danger">Gagal memperbaharui data {{$materi->mat_title}}!</a> Cek kembali inputan anda.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
          <div class="card-body">
            <div class="text-right mb-4">
              <button id="info" class="btn text-secondary" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="
                <p>Tanda <strong>(*)</strong> Field boleh kosong.</p>
                " data-placement="bottom"><h5><i class="fas fa-question-circle"></i></h5>
              </button>
            </div>
            <form method="post" action="{{ url('/materi/'.$materi->id) }}" enctype="multipart/form-data">
              @method('patch')
              @csrf
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="mat_title">Title</label>
                  <input type="text" name="mat_title" id="mat_title" class="form-style @error('mat_title') is-invalid @enderror" value="{{$materi->mat_title}}" autocomplete="off">
                  @error('mat_title')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>
              <input type="date" name="mat_date" id="mat_date" value="{{date('Y-m-d')}}" hidden>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="mat_keterangan">Deskripsi*</label>
                  <textarea type="text" name="mat_keterangan" id="mat_keterangan" class="form-style" placeholder="Write here.. or Upload File below">{!!$materi->mat_keterangan!!}</textarea>
                </div>
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
                <div class="custom-file col-md-4 d-flex mt-2">
                  <input type="file" class="custom-file-input @error('file_mat') is-invalid @enderror" id="FileSource" name="file_mat" onchange="previewImage();" accept="@file">
                  <label class="custom-file-label" for="file_mat">
                    {!! $materi->file_mat !!}
                    @empty($materi->file_mat)
                      Choose a file..
                    @endempty
                  </label>
                </div>
                @if($materi->file_mat)
                  <label class="font-italic"><small>Dokumen sudah ada / pernah diupload.</small></label>
                @endif
                @empty($materi->file_mat)
                  <label class="font-italic"><small>Dokumen belum ada! silahkan upload.</small></label>
                @endempty
              </div>
              <div class="ml-3">
                <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Save Changes</button>
                <button type="reset" class="btn-form btn btn-danger">Reset</button>
                <a href="{{ url('/materi') }}" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Back</a>
              </div>
            </form>
          </div>
        </div> {{-- end card --}}
      </div> {{-- end content --}}
    </div>
  </div>
@section('footer')
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
@stop
@endsection
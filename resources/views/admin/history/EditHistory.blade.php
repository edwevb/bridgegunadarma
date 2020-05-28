@extends('layout.admin_cms')
@section('title','Edit '.$history->hist_title)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    <div class="col-lg">
      {{-- start content --}}
      <section id="edit">
        <div class="card-borderless"> {{-- card --}}
          <div class="card-header borderless rounded border-l-i_border-r-d shadow-sm bg-white">
            <h3 class="text-center text-info">Form Edit Pelatihan</h3>
          </div>
           @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center m-4" role="alert">
                <p>&nbsp;<a class="font-weight-bold text-danger">Gagal memperbaharui data {{$history->hist_title}}!</a> Cek kembali inputan anda.</p>
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
            <form method="post" action="{{ url('/history/'.$history->id) }}" enctype="multipart/form-data">
              @method('patch')
              @csrf
              <div class="row justify-content-center">
              	<div class="form-group col-md-6">
	                <label for="hist_title">Judul</label>
	                <input type="text" name="hist_title" id="hist_title" class="form-style @error('hist_title') is-invalid @enderror" value="{{$history->hist_title}}">
	                @error('hist_title')
	                  <div class="invalid-feedback">
	                    {{$message}}
	                  </div>
	                @enderror
	              </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="hist_date">Date</label>
                  <input type="date" name="hist_date" id="hist_date" class="form-style @error('hist_date') is-invalid @enderror" value="{{$history->hist_date}}">
                  @error('hist_date')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group col-md-6">
	                <label for="hist_loc">Lokasi</label>
	                <input type="text" name="hist_loc" id="hist_loc" class="form-style @error('hist_loc') is-invalid @enderror" value="{{$history->hist_loc}}">
	                @error('hist_loc')
	                  <div class="invalid-feedback">
	                    {{$message}}
	                  </div>
	                @enderror
	              </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="hist_keterangan">Deskripsi*</label>
                  <textarea type="text" name="hist_keterangan" id="hist_keterangan" class="form-style" placeholder="Write here..">{!!$history->hist_keterangan!!}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label>Upload File Distribusi*</label>
                <div class="border-0">
                  @error('hist_dist')
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
                  <input type="file" class="custom-file-input  @error('hist_dist') is-invalid @enderror" id="FileSource" name="hist_dist" onchange="previewImage();" accept="@file">
                  <label class="custom-file-label" for="hist_dist">
                  	{!! $history->hist_dist !!}
                    @empty($history->hist_dist)
                      Choose a file..
                    @endempty
                  </label>
                </div>
                @if($history->hist_dist)
                  <label class="font-italic"><small>Dokumen sudah ada / pernah diupload.</small></label>
                @endif
                @empty($history->hist_dist)
                  <label class="font-italic"><small>Dokumen belum ada! silahkan upload.</small></label>
                @endempty
              </div>
              <div class="ml-3">
                <button onclick="javascript: return confirm('Tambahkan ke DATABASE ?')" type="submit" class="btn-form btn btn-primary">Save Changes</button>
                <button type="reset" class="btn-form btn btn-danger">Reset</button>
                <a href="{{ url('/atlet') }}" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Back</a>
              </div>
            </form>
          </div>
        </div> {{-- end card --}}
      </section> {{-- end content --}}
    </div>
  </div>
@endsection
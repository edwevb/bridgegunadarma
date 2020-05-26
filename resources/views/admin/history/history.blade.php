@extends('layout.admin_cms')
@section('title', 'Pelatihan Bridge Gunadarma')
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<div class="card-borderless">
          <div class="card-header">
            <h1 class="text-center font-weight-bold text-info">Pelatihan Bridge Gunadarma</h1>
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                {{-- @foreach ($errors->all() as $e)
                  {{$e}}
                @endforeach --}}
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-history" data-toggle="modal" data-target="#modal-tambah-history">Click disini</a> untuk melihat error.</p>
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
              <a id="btn-wh" class="btn bg-gradient-info" data-toggle="modal" data-target="#modal-tambah-history"><i class="far fa-plus-square"></i> Tambah data</a>
              <a id="info" class="text-secondary float-right" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="@popoverText"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="left" title="click me"></i></a>
            </div>
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Tanggal</th>
										<th scope="col">Lokasi</th>
                    <th class="text-center" width="50" scope="col">Detail</th>
                    <th class="text-center" width="50" scope="col">Edit</th>
                    <th class="text-center" width="50" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_history as $history)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                      <a href="{{ url('/history/'.$history->id) }}" class="text-primary" >{{$history->hist_title}}</a>
                    </td>
                    <td>
                      <?php $hist_date = strtotime($history->hist_date) ?>
                      {{date("d M Y", $hist_date)}}
                    </td>
                    <td>{!!$history->hist_loc!!}</td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/history/'.$history->id) }}"><i class="fas fa-book"></i></a>
                    </td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/history/'.$history->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                    </td>
                    <td class="text-center">
                      <form action="{{ url('/history/'.$history->id) }}" method="post">
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
        </div> {{-- end card --}}
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>

	{{-- Modal tambah history --}}
  <div class="modal fade" id="modal-tambah-history" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Pelatihan</h5>
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
          <form method="post" action="{{ url('/history') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="hist_title">Judul</label>
              <input type="text" name="hist_title" id="hist_title" class="form-style @error('hist_title') is-invalid @enderror" value="{{old('hist_title')}}">
              @error('hist_title')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="hist_date">Tanggal</label>
              <input type="date" name="hist_date" class="form-style @error('hist_date') is-invalid @enderror" value="{{old('hist_date')}}">
              @error('hist_date')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="hist_loc">Lokasi</label>
              <input type="text" name="hist_loc" id="hist_loc" class="form-style @error('hist_loc') is-invalid @enderror" value="{{old('hist_loc')}}">
              @error('hist_loc')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label>Deskripsi*</label>
              <textarea name="hist_keterangan" id="hist_keterangan" class="form-style" placeholder="Write here..">{{old('hist_keterangan')}}</textarea>
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
              @php
              {{$file='
                application/pdf,application/zip,text/plain,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.wordprocessingml.template,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,xls,xlsx,.odt,.ods,.rtf,.rar,.7z,.tar.gz,.tar,.tex,.htm,.html
                ';}}
              @endphp
              <div class="custom-file d-flex mt-2">
                <input type="file" class="custom-file-input  @error('hist_dist') is-invalid @enderror" id="FileSource" name="hist_dist" onchange="previewImage();" accept="{!!$file!!}">
                <label class="custom-file-label" for="hist_dist">Choose a file..</label>
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
  </div>{{-- End Modal --}}
@endsection

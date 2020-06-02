@extends('layout.admin_cms')
@section('title', 'Dashboard')
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- Content --}}
    <div class="col-lg d-flex">
      <div class="container">
      @if (session('AlertSuccess'))
        <div class="alert alert-success alert-dismissible text-center fade show col-md-6" role="alert">
          <strong>{{ session('AlertSuccess') }}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      {{--ADMIN PAGES--}}
      @if (auth()->user()->role_id == '1')
        <div class="row justify-content-center">
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card bg-gradient-primary border-left-dark shadow py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2 text-center">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                      <h3 class="font-weight-bold text-white">materi ({{$data_materi->count()}})</h3>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-white">
                      <div class="h5 mb-0 font-weight-bold text-white">
                        <a href="{{ url('/materi') }}" class="btn btn-dark btn-sm btn-fade rounded-pill col-8"><i class="fas fa-arrow-right"></i> <i class="fas fa-folder-open"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto text-dark">
                    <i class="fas fa-book fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card bg-gradient-danger border-left-dark shadow py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2 text-center">
                    <div class="font-weight-bold text-uppercase mb-1">
                      <h3 class="font-weight-bold text-white">atlet ({{$data_atlet->count()}})</h3>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-white">
                      <a href="{{ url('/atlet') }}" class="btn btn-dark btn-sm btn-fade rounded-pill col-8"><i class="fas fa-arrow-right"></i> <i class="fas fa-folder-open"></i></a>
                    </div>
                  </div>
                  <div class="col-auto text-dark">
                    <i class="fas fa-users fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card bg-gradient-success border-left-dark shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2 text-center">
                    <div class="font-weight-bold text-uppercase mb-1">
                      <h3 class="font-weight-bold text-white">prestasi ({{$data_prestasi->count()}})</h3>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-white">
                      <div class="h5 mb-0 font-weight-bold text-white">
                        <a href="{{ url('prestasi') }}" class="btn btn-dark btn-sm btn-fade rounded-pill col-8"><i class="fas fa-arrow-right"></i> <i class="fas fa-folder-open"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto text-dark">
                    <i class="fas fa-trophy fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> {{-- end row --}}

        
        <div class="my-5 text-center">
          <h1>Welcome, Admin <i class="fas fa-user-tie"></i></h1><br>
          <a class="btn btn-dark text-white mb-1 rounded-pill px-5" data-toggle="modal" data-target="#modal-announcement" ><h3><i class="fas fa-bullhorn"></i> Announcement</h3></a>
          <button data-toggle="modal" data-target="#modal-edit-announcement" class="btn btn-table btn-transparent"><h3><i class="fa fa-edit"></i></h3> </button>
          {{-- <button class="btn btn-light bg-transparent btn-md" href="javascript:;" data-toggle="collapse" data-target="#form" style="width: 8rem"><h3><i class="fa fa-edit"></i> Edit</h3></button> --}}
        </div>
      @else
        <i class="ml-4 fas fa-user fa-2x"></i>
        <div class="pt-2 ml-3">
          <h1>Hello, {{auth()->user()->name}}</h1>
          <br>
          <a class="btn btn-dark text-white rounded-pill px-5" data-toggle="modal" data-target="#modal-announcement" ><h3><i class="fas fa-bullhorn"></i> Announcement</h3></a>
        </div>
      @endif
      </div>{{-- end container --}}
    </div>{{-- end content --}}
  </div>{{-- End gutters --}}

  {{-- Modal Announcement --}}
  <div class="modal fade" id="modal-announcement" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title"><i class="fas fa-bullhorn"></i> Announcement</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="ml-2">
            @isset($data_ann->ann_title)
              <h5>{{$data_ann->ann_title}}</h5>
            @endisset
            @isset ($data_ann->ann_date)
              <small class="text-muted">
                @php
                  $ann_date = strtotime($data_ann->ann_date);
                @endphp
                {{date("d M Y", $ann_date)}}
              </small>
            @endisset
          </div>
          <hr id="bridgeHr">
          @isset ($data_ann->ann_isi )
            <div class="ml-2">
              {!! $data_ann->ann_isi !!}
            </div>
          @endisset
         </div>
      </div>
    </div>
  </div>{{-- End Modal --}}

  {{-- Modal Edit Announcement --}}
  <div class="modal fade" id="modal-edit-announcement" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Edit Announcement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ url('/dashboard/'.$data_ann->id) }}">
            @method('patch')
            @csrf
            <div class="form-group">
              <label for="ann_title">Judul</label>
              <input type="text" name="ann_title" id="ann_title" class="form-style" value="{{$data_ann->ann_title}}" required>
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea name="ann_isi" id="ann_isi" class="form-style" placeholder="Announce.."required>{!! $data_ann->ann_isi !!}</textarea>
            </div>
            <div class="ml-5 pb-5">
              <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary form-btn">Save Changes</button>
              <button type="clear" class="btn-form btn btn-danger form-btn">Reset</button>
              <button type="button" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> {{-- end modal --}}
@section('footer')
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
@stop
@endsection
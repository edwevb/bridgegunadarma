@extends('layout.admin_cms')
@section('title','Edit '.$pengeluaran->p_title)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    <div class="col-lg">
      {{-- start content --}}
      <section id="edit">
        <div class="card-borderless"> {{-- card --}}
          <div class="card-header borderless rounded border-l-i_border-r-d shadow-sm bg-white">
            <h3 id="cms-header" class="text-center">Form Edit Pengeluaran</h3>
          </div>
           @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center m-4" role="alert">
                <p>&nbsp;<a class="font-weight-bold text-danger">Gagal memperbaharui data {{$pengeluaran->p_title}}!</a> Cek kembali inputan anda.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
          <div class="card-body">
             <div class="text-right mb-4">
                <button id="info" class="btn text-secondary" href="#popover" data-html="true" data-toggle="popover" title="<h5 class='text-muted'>Penjelasan</h5>" data-content="
                 <p>Contoh pengisian <b>Biaya Pengeluaran</b> :</p>
                  <p>300000 -> tiga ratus ribu rupiah</p>
                  <p>300000.33 -> tiga ratus ribu tiga puluh tiga rupiah</p>
                  " data-placement="bottom"><h5><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="click me"></i></h5>
                </button>
              </div>
            <form method="post" action="{{ url('/pengeluaran/'.$pengeluaran->id) }}">
              @method('patch')
              @csrf
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="p_title">Title</label>
                  <input type="text" name="p_title" id="p_title" class="form-style @error('p_title') is-invalid @enderror" value="{{$pengeluaran->p_title}}" autocomplete="off">
                  @error('p_title')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label for="p_date">Date</label>
                  <input type="date" name="p_date" id="p_date" class="form-style @error('p_date') is-invalid @enderror" value="{{$pengeluaran->p_date}}">
                  @error('p_date')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="form-group col-md-6 mx-auto">
                <label for="p_biaya">Biaya Pengeluaran</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Rp</span>
                  </div>
                  <input type="text" name="p_biaya" id="rupiah" class="form-control @error('p_biaya') is-invalid @enderror rp" value="{{$pengeluaran->p_biaya}}" autocomplete="off">
                  @error('p_biaya')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>  
              <div class="form-group row">
                <div class="col-md-12">
                  <label for="p_keterangan">Deskripsi</label>
                  <textarea type="text" name="p_keterangan" id="p_keterangan" class="form-style" placeholder="Write here..">{!!$pengeluaran->p_keterangan!!}</textarea>
                </div>
              </div>
              <div class="ml-3">
                <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Save Changes</button>
                <button type="reset" class="btn-form btn btn-danger">Reset</button>
                <a href="{{ url('/materi') }}" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Back</a>
              </div>
            </form>
          </div>
        </div> {{-- end card --}}
      </section> {{-- end content --}}
    </div>
  </div>
@section('footer')
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script>
    $(document).ready(function(){
        $('#rupiah').mask('#,##0.00', {reverse: true});
    })
  </script>
@stop
@endsection
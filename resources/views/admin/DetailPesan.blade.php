@extends('layout.admin_cms')
@section('title', $pesan->p_title)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <section>
          <div class="card col-md-8 shadow border-left-success mt-4">
              <div class="card-body">
                <h5 class="card-title font-weight-bold">Detail Pesan</h5>
                <div class="text-muted">
                  {{$pesan->name}} |
                  <?php $date = strtotime($pesan->created_at) ?>
                  {{date("d M Y", $date)}}
                </div>
                <div class="p-2">
                    {!!$pesan->pesan!!}
                </div>
                <a href="#delete-pesan" data-toggle="modal" data-target="#delete-pesan" class="text-danger px-2"><i class="fas fa-trash-alt"></i> Delete</a>
              </div>
            </div>
        </section>
      </div>
    </div>{{-- end content --}}
  </div>
  <div class="ml-4 my-5">
    <a href="{{ url('/pesan') }}" class="btn btn-dark btn-sm btn-fade rounded-pill px-5 shadow"><span class="lead font-weight-bold"><i class="fas fa-caret-left"></i> Table</span></a>
  </div>

   {{-- Modal Delete pesan --}}
  <div class="modal fade" id="delete-pesan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete From Database?</h5>
        </div>
        <div class="modal-body"> 
          <form class="d-inline" action="{{ url('/pesan/'.$pesan->id) }}" method="post">
            @method('delete')
            @csrf
            <button class="btn btn-danger"><i class="fa fa-trash"></i> Ya, hapus</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>{{-- End Modal --}}
@endsection
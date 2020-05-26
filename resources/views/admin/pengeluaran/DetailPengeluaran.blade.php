@extends('layout.admin_cms')
@section('title', $pengeluaran->p_title)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <section>
          <div class="card col-md-8 mx-auto shadow border-left-success mt-4">
              <div class="card-body">
                <h5 class="card-title font-weight-bold">Pengeluaran Bridge Gunadarma</h5>
                <div class="mb-4">
                  <a href="{{ url('/pengeluaran/'.$pengeluaran->id.'/edit') }}" class="text-primary px-2"><i class="fas fa-edit"></i> Edit</a>
                  <a href="#delete-pengeluaran" data-toggle="modal" data-target="#delete-pengeluaran" class="text-danger px-2"><i class="fas fa-trash-alt"></i> Delete</a>
                </div>
                <div class="p-4">
                  <table class="table table-borderless">
                    <tr>
                      <td>Jenis Pengeluaran</td>
                      <td>:</td>
                      <td>
                        {{$pengeluaran->p_title}}
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal</td>
                      <td>:</td>
                      <td>
                        <?php $date = strtotime($pengeluaran->p_date) ?>
                        {{date("d M Y", $date)}}
                      </td>
                    </tr>
                    <tr>
                      <td>Biaya</td>
                      <td>:</td>
                      <th>@rupiah($pengeluaran->p_biaya)</th>
                    </tr>
                  </table>
                </div>
                <h6 class="card-subtitle mb-2 text-muted font-italic">Keterangan</h6>
                <div class="p-2">
                  @isset ($pengeluaran->p_keterangan)
                    {!!$pengeluaran->p_keterangan!!}
                  @endisset
                  @empty ($pengeluaran->p_keterangan)
                    <p class="font-italic">No information available.</p>
                  @endempty

                </div>
              </div>
            </div>
        </section>
      </div>
    </div>{{-- end content --}}
  </div>
  <div class="ml-4 my-5">
    <a href="{{ url('/pengeluaran') }}" class="btn btn-dark btn-sm btn-fade rounded-pill px-5 shadow"><span class="lead font-weight-bold"><i class="fas fa-caret-left"></i> Table</span></a>
  </div>

   {{-- Modal Delete Pengeluaran --}}
  <div class="modal fade" id="delete-pengeluaran" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete From Database?</h5>
        </div>
        <div class="modal-body"> 
          <div class="mb-4 font-italic">
            <small>Semua data yang berkaitan dengan <span class="text-danger font-weight-bold">{{$pengeluaran->p_title}}</span> akan terhapus!</small>
          </div>
          <form class="d-inline" action="{{ url('/pengeluaran/'.$pengeluaran->id) }}" method="post">
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
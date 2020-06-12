@extends('layout.admin_cms')
@section('title','Pesan')
@section('section')
	<div class="row no-gutters">
		{{-- start content --}}
		<div class="col-md-2"></div>
		<div class="col-lg d-flex">
			<div class="container">
				<div class="my-2 text-muted">
          Dashboard / Kirim Pesan
        </div>
				<section id="edit">
	        <div class="card-borderless p-1"> {{-- card --}}
	          <div class="card-header">
	            <h3 class="text-center font-weight-bold">Form Kirim Pesan</h3>
	          </div>
	          <div class="card-body">
	            <form method="post" action="{{ url('/pesan') }}">
	              @csrf
	              <input type="text" id="name" name="name" value="{{auth()->user()->name}}" hidden>
		            <div class="form-group row">
	                <div class="col-md-12">
	                  <textarea type="text" name="pesan" id="pesan" class="form-style" placeholder="Write here.."></textarea>
	                </div>
	              </div>
	              <div class="ml-3">
	                <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Send</button>
	                <button type="reset" class="btn-form btn btn-danger">Reset</button>
	              </div>
	            </form>
	          </div>
	        </div> {{-- end card --}}
	      </section> {{-- end content --}}
			</div>
		</div>
	</div>
@section('footer')
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
@stop
@endsection
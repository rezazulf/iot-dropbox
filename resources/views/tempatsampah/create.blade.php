@extends('app')
@section('content')
<div class="row">
   <div class="col-md-6">
      @if($errors->any())
      @foreach($errors->all() as $err)
      <p class="alert alert-danger">{{ $err }}</p>
      @endforeach
      @endif
      <form action="{{ route('tempatsampah.store') }}" method="POST">
         @csrf
         <div class="form-group">
            <label>ID Device <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="id_tempat_sampah" value="{{ old('id_tempat_sampah') }}" />
         </div>
         <div class="form-group">
            <label>Alamat <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="alamat" value="{{ old('alamat') }}" />
         </div>
         <div class="form-group">
            <label>Latitude <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="latitude" value="{{ old('latitude') }}" />
         </div>
         <div class="form-group">
            <label>Longitude <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="longitude" value="{{ old('longitude') }}" />
         </div>

         <div class="form-group">
            <label>Status <span class="text-danger">*</span></label>
            <select class="form-control" name="status" />
            @foreach($status as $key => $val)
            @if($key==old('status'))
            <option value="{{ $key }}" selected>{{ $val }}</option>
            @else
            <option value="{{ $key }}">{{ $val }}</option>
            @endif
            @endforeach
            </select>
         </div>
         <div class="form-group">
            <button class="btn btn-primary">Simpan</button>
            <a class="btn btn-danger" href="{{ route('tempatsampah.index') }}">Kembali</a>
         </div>
      </form>
   </div>
</div>
@endsection
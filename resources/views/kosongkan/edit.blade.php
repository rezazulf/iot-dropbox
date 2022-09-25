@extends('app')
@section('content')
<div class="row">
   <div class="col-md-6">
      @if($errors->any())
      @foreach($errors->all() as $err)
      <p class="alert alert-danger">{{ $err }}</p>
      @endforeach
      @endif
      <form action="{{ route('kosongkan.update', $row) }}" method="POST">
         @csrf
         @method('PUT')
         <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="name" value="{{ old('name', $row->name) }}" />
         </div>
         <div class="form-group">
            <label>Distance <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="distance" value="{{ old('distance', $row->distance) }}" />
         </div>

         <div class="form-group">
            <button class="btn btn-primary">Simpan</button>
            <a class="btn btn-danger" href="{{ route('kosongkan.index') }}">Kembali</a>
         </div>
      </form>
   </div>
</div>
@endsection
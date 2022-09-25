@extends('app')
@section('content')
@if(session('success'))
<p class="alert alert-success">{{ session('success') }}</p>
@endif
<div class="card card-default">
   <div class="card-header">

   </div>
   <div class="card-body p-0 table-responsive">
      <table class="table table-bordered table-striped table-hover mb-0">
         <thead>
            <tr>
               <th>No</th>
               <th>Name</th>
               <th>Latitude</th>
               <th>Longitude</th>
               <th>Distance</th>
               <th>Status</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <?php $no = 1 ?>
         @foreach($rows as $row)
         <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->latitude }}</td>
            <td>{{ $row->longitude }}</td>
            <td>{{ $row->distance }}</td>
            <td>{{ $row->status }}</td>
            <td>
               <a class="btn btn-sm btn-warning" href="{{ route('kosongkan.edit', $row) }}">Kosongkan</a>
            </td>
         </tr>
         @endforeach
      </table>
      <div class="d-felx justify-content-center">
         {{ $rows->links() }}
      </div>
   </div>
</div>
@endsection
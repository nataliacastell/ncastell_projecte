@extends('layout.master')

@section('content')
<div id="app">
  <panel-admin></panel-admin>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/app.js') }}"></script>
@endpush

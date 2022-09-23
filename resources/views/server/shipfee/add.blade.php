@extends('layouts.server.main')
@section('title', 'Thêm Shipping Fee')
@section('title_tab', 'Shipping Fee / Thêm Mới')
@section('content')
    <div id="status_form">
        @if(session()->has('error'))
            <div style="border: 1px solid red; background-color: red;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                <b>{{session()->get('error')}}</b>
            </div>
        @endif
    </div>
<div class="content" style="padding: 0 12px;">
    <span id="error_code" style="font-size: 14px; color: red">Lưu ý : Chỉ nhận file Excel</span>
  <form action="{{route('server.ship.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control" required><br>
    <button class="btn btn-info">Import with Excel</button>
  </form>
</div>
@endsection

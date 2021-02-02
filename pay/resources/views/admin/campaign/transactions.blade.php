@extends('admin.layout')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <h4 class="c-grey-900 mB-20">Lịch sử đăng ký</h4>
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Khách hàng</th>
              <th>Nội dung thanh toán</th>
              <th>Giá trị(đ)</th>
              <th>Trạng thái</th>
              <th>Thời gian tạo</th>
              <th></th>
            </tr>
          </thead>
          <tfoot>
          <tr>
             <th>ID</th>
              <th>Khách hàng</th>
              <th>Nội dung thanh toán</th>
              <th>Giá trị(đ)</th>
              <th>Trạng thái</th>
               <th>Thời gian tạo</th>
              <th></th>
          </tr>
          </tfoot>
          <tbody>
            @foreach($data as $row)
            <tr>
              <td>{{ $row->id }}</td>
              <td>{{ $row->name }}<br/>{{ $row->phone }}<br/>{{ $row->email }}</td>
              <td>{{ $row->content }}</td>
              <td>@php $amount=number_format($row->amount) @endphp {{ $amount }}</td>
              <td>{{ $row->status==1?'Đã thanh toán':'Chưa thanh toán' }}</td>
              <td>{{ $row->created_date }}</td>
              <td></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
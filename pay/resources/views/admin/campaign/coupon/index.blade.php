@extends('admin.layout')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <h4 class="c-grey-900 mB-20">Mã Khuyến Mãi <a href="/admin/campaign/{{ $campaign_id }}/coupon/create"><button class="btn btn-primary pull-right">Tạo mã mới</button></a></h4>
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Mã KM</th>
              <th>Giảm giá</th>
              <th>Thời gian áp dụng</th>
               <th>Đã sử dụng</th>
              <th></th>
            </tr>
          </thead>
          <tfoot>
          <tr>
            <th>Mã KM</th>
            <th>Giảm giá</th>
            <th>Thời gian áp dụng</th>
            <th>Đã sử dụng</th>
            <th></th>
          </tr>
          </tfoot>
          <tbody>
            @foreach($data as $row)
            <tr>
              <td>{{ $row->coupon_code }}@if($row->coupon_type==2)%@endif</td>
              <td>{{ $row->promotion_value }}@if($row->promotion_type==1)%@elseđ@endif</td>
              <td>{{ $row->start_at }} - {{ $row->end_at }}</td>
               <td><a href="/admin/campaign/{{ $row->campaign_id }}/transactions?coupon={{ $row->id }}">{{ $row->transactions->count() }}</a></td>
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
@extends('admin.layout')
@section('content')
 <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Chiến dịch</h4>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Chiến dịch</th>
                            <th>Cấu hình link (googl sheet | Đăng ký | Thanh toán)</th>
                            <th>Thời gian chạy</th>
                             <th></th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Chiến dịch</th>
                            <th>Cấu hình link (googl sheet link | Link đăng ký | Link thanh toán)</th>
                            <th>Thời gian chạy</th>
                            <th></th>
                          </tr>
                        </tfoot>
                        <tbody>
                           @foreach($data as $row)
                          <tr>
                            <td><a href="/admin/campaign/{{ $row->id }}/transactions">{{ $row->campaign }}<br/><em>{{ $row->campaign_key }}<em/><a/></td>
                            <td>{{ $row->gg_sheet_link }}<br/>{{ $row->register_thankyou_url }}<br/>{{ $row->payment_thankyou_url }}</td>
                            <td>{{ $row->start_at }} - {{ $row->end_at }}</td>
                            <td><a href="/admin/campaign/{{ $row->id }}/coupons">Mã Khuyến Mãi</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
@endsection
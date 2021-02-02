@extends('admin.layout')
@section('content')
<div id="mainContent">
   <div class="row gap-20 masonry pos-r" style="position: relative; height: 1096px;">
      <div class="masonry-sizer col-md-12"></div>
      <div class="masonry-item col-md-12" style="position: absolute; left: 0%; top: 364px;">
         <div class="bgc-white p-20 bd">
            <h5 class="c-grey-900">Thêm mã khuyến mãi</h5>
            <div class="mT-30">
               <form action="/admin/campaign/{{ $campaign_id }}/coupon/create" method="POST">

                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Mã khuyến mãi</label>
                     <div class="col-sm-10"><input type="text" class="form-control" name="coupon_code" required=""></div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-2">Loại mã</div>
                     <div class="col-sm-10">
                      @foreach(\App\Coupon::COUPON_TYPES as $key=>$type)
                        <div class="form-check">
                          <label class="form-check-label">
                          <input class="form-check-input" type="radio" @if($key==1) checked=""@endif name="coupon_type" value="{{  $key }}">{{ $type }}</label>
                        </div>
                        @endforeach
                     </div>
                  </div>
                    <div class="form-group row">
                     <div class="col-sm-2">Loại giảm</div>
                     <div class="col-sm-10">
                      @foreach(\App\Coupon::PROMOTION_TYPES as $key=>$type)
                        <div class="form-check">
                          <label class="form-check-label">
                          <input class="form-check-input" @if($key==1) checked="" @endif type="radio" name="promotion_type" value="{{  $key }}">{{ $type }}</label>
                        </div>
                        @endforeach
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Giá trị giảm</label>
                     <div class="col-sm-2"><input type="text" class="form-control" name="promotion_value"></div>
                  </div>
                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Thời gian áp dụng</label>
                     <div class="col-sm-4"><input type="text" class="form-control" name="start_at" required=""></div>
                     <div class="col-sm-4"><input type="text" class="form-control" name="end_at" required=""></div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-6 text-right"><button type="submit" class="btn btn-primary">Tạo</button></div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
@endsection
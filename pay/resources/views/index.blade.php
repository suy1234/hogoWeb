<!DOCTYPE html>
<html lang='en' class=''>

<head>
    <meta charset='UTF-8'>
    <title>Thanh toán online</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
   <style>
        .border{
            border: 1px solid #000;
        }
        .pd10{
            padding: 10px;
            text-align: left;
        }
        .bank_info {
            padding: 0 5px;
        }
        .bank_info p{
            font-size: 14px;
            color: #000;
        }
        .mt10 {
            margin-top: 10px;
        }
        .ml10 {
            margin-left: 10px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }
        .col-close-half {
            width: 49%;
            float: left;
        }
        .ml2p {
            margin-left: 2%;
        }
        #submitRegisterFormBtn {
            cursor: pointer;
        }
        .logo {
            margin: 0 auto;
            text-align: center;
        }
        .logo img {
            max-width: 200px;
        }
        .installment{
            background: #00003a;
        }
        .installment:hover{
            background: #fe330a;
        }
    </style>
</head>

<body>

    <div class="container">
        <form action="/register" method="POST" id="registerForm">
            <div class="row">
                <div class="logo">
                    <img src="https://media.loveitopcdn.com/img//2018/10/25/180-logo-imgroup.png" class="img-responsive" alt="Image">
                </div>
                <h1>Thông Tin Thanh Toán</h1>
                <div class="input-group input-group-icon">
                    <input type="text" placeholder="Họ và Tên" name="name" required="required" id="inputName" value="{{ $name }}" />
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="email" placeholder="Email" name="email" required="required" id="inputEmail" value="{{ $email }}"/>
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                </div>
                <div class="input-group input-group-icon">
                    <input type="number" placeholder="Số Điện Thoại" name="phone" required="required" id="inputPhone" value="{{ $phone }}"/>
                    <div class="input-icon">
                        <i class="fa fa-phone"></i>
                    </div>
                </div>
                <div class="input-group input-group-icon">
                    <input placeholder="Số Tiền" id="inputAmount" name="amount" step="any" required="required" id="inputAmount" value="{{ $amount }}"/>
                    <div class="input-icon">
                        <i class="fa fa-money"></i>
                    </div>
                </div>
                <div class="input-group input-group-icon">
                    <textarea name="content" style="min-width: 100%; min-height: 200px;" required="required" maxlength="100" placeholder="Nhập nội dung thanh toán (ví dụ đăng ký lớp học gì ? gia hạn domain gì? v.v...)" id="inputContent">{{ $content }}</textarea>
                    <div class="input-icon">
                        <i class="fa fa-comments"></i>
                    </div>
                </div>
                <div class="input-group">
                    <input type="hidden" name="course" id="inputCourseName" class="form-control" value="{{ $course }}">
                    <input type="hidden" name="sheet_id" id="inputSheetID" class="form-control" value="{{ $sheet_id }}">
                    <input type="hidden" name="campaign" id="inputCampaign" class="form-control" value="{{ $campaign }}">
                </div>
            </div>
            <div class="row submit_row">
                <button type="submit" id="submitRegisterFormBtn">Thanh Toán Online</button>
            </div>
            @if($is_installment === 'true')
            <div class="row submit_row">
                <button type="submit" name="installment" value="true" class="installment">Trả góp lãi suất 0%</button>
            </div>
            @endif
           <div class="row submit_row pd10 mt10">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
                    <p class="title">
                        Hoặc chuyển khoản vào tài khoản CEO Nguyễn Minh Đức
                    </p>
                </div>
                @if(app('request')->segment(1) !== 'si')
                <div>
                    <div class="col-close-half bank_info border" style="margin-bottom: 2%;">
                        <p>Ngân hàng: Techcombank</p>
                        <p>Số tài khoản: 19035704764021</p>
                        <p>Chủ tài khoản: Nguyễn Minh Đức</p>
                        <p>Chi nhánh: Gia định</p>
                    </div>
                    <div class="col-close-half bank_info border ml2p" style="margin-bottom: 2%;">
                        <p>Ngân hàng: Vietcombank</p>
                        <p>Số tài khoản: 0531000280056</p>
                        <p>Chủ tài khoản: Nguyễn Minh Đức</p>
                        <p>Chi nhánh: Bình Thạnh</p>
                    </div>
                </div>
                <div class="bank_info border" style="clear: both;">
                    <p>Ngân hàng: Á Châu ACB</p>
                    <p>Số tài khoản: 132667059</p>
                    <p>Chủ tài khoản: Nguyễn Minh Đức</p>
                    <p>Chi nhánh: Hàng Xanh</p>
                </div>
                @else
                <div class="bank_info border ml2p text-center">
                  <p>Ngân hàng: TMCP Ngoại Thương Việt Nam</p>
                    <p>Số tài khoản: 0421000487494</p>
                    <p>Chủ tài khoản: Nguyễn Minh Đức</p>
                    <p>Chi nhánh ngân hàng: Hùng Vương</p>
                </div>
                @endif
            </div>
        </form>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://nosir.github.io/cleave.js/dist/cleave.min.js"></script>
    <script src="/js/script.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>

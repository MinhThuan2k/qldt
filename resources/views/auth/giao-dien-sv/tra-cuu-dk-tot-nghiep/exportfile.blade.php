<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Đơn xét tốt nghiệp</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    
  <style>
   table, th, td {
       border: 1px solid black;
       border-collapse: collapse;
      }
      body{font-family:'DejaVu Sans;';
          size: 794px 1120px;
          margin-top: 30px;
          text-align: justify;
      }
    </style>

    <body>
    <table style="width:660px" align = "center">
        <th align = "middle" style="width:160px">
          <img src="{{asset('images/logovlute.png')}}" alt="Logo VLUTE" style= "width:100px;height:100px;">
        </th>
        <th style="font-size: 18px; vertical-align:middle;">
          ĐƠN XIN XÉT TỐT NGHIỆP <br> TRÌNH ĐỘ ĐẠI HỌC <br> (đợt .... năm 20....)
        </th>
       
        <td style="font-size: 14px; vertical-align: top;width:180px">Mã số: BM-ĐT-32-00 <br> Ngày hiệu lực: 18/5/2020</td>
    </table>
    @foreach($data as $item)
        <p style="font-weight:bold; font-size: 13px; text-align:center">Kính gửi:&nbsp;&nbsp;&nbsp;&nbsp;<i>Hội đồng xét tốt nghiệp trường Đại học Sư phạm Kỹ thuật Vĩnh Long</i></p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Họ và tên:  {{$item->ho." ".$item->ten}}</p> 
        <p style="font-size: 13px; margin-left: 60%; margin-top:-30px">Mã số sinh viên : {{$item->id_hoc_vien}}</p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ngày sinh: 12/01/2001</p> 
        <p style="font-size: 13px; margin-left: 40%; margin-top:-30px">Nơi sinh (tỉnh): Vĩnh Long</p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Là sinh viên lớp: {{$item->ten_lop_hoc}}</p> 
        <p style="font-size: 13px; margin-left: 60%; margin-top:-30px">Điện thoại: {{$item->sdt}}</p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Đã hoàn thành chương trình đào tạo ngành: {{$item->ten_chuyen_nganh}}</p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;và đủ điều kiện nộp hồ sơ xét tốt nghiệp đợt này. Kính gửi hồ sơ tốt nghiệp và mong được Hội</p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;đồng tiếp nhận, xét tốt nghiệp theo quy định hiện hành.</p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trân trọng!</p>
        <p style="font-size: 13px; font-style:italic; margin-left:53%">Vĩnh Long, ngày&nbsp;&nbsp;....&nbsp;&nbsp;tháng&nbsp;&nbsp;....&nbsp;&nbsp;năm 20....</p>
        <p style="font-size: 13px; margin-left:66%">Người viết đơn</p> <br><br><br>
        <p style="font-weight:bold; font-size: 13px; text-align:center">XÁC NHẬN CỦA CỐ VẤN HỌC TẬP</p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Căn cứ Chương trình đào tạo và Quy định về điều kiện tốt nghiệp;</p> 
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Căn cứ hồ sơ tốt nghiệp;</p> 
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CVHT xác nhận sinh viên: {{$item->ho." ".$item->ten}}</p> 
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mã số sinh viên: {{$item->id_hoc_vien}} &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; Lớp: {{$item->ten_lop_hoc}}</p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Đã hoàn thành chương trình đào tạo, đảm bảo tích lũy đủ số tín chỉ tối thiểu theo quy định để</p>
        <p style="font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nộp hồ sơ xét tốt nghiệp.</p>
        <p style="font-size: 13px; font-style:italic; margin-left:53%">Vĩnh Long, ngày&nbsp;&nbsp;....&nbsp;&nbsp;tháng&nbsp;&nbsp;....&nbsp;&nbsp;năm 20....</p>
        <p style="font-size: 13px; margin-left:64%; font-weight:bold">CỐ VẤN HỌC TẬP</p>
        <p style="font-size: 13px; margin-left:62.5%; font-style:italic">(ký tên, ghi rõ họ tên)</p> <br><br><br>
        <p style="font-size: 13px; font-style:italic;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SV phải nộp Phiếu điểm Xét tốt nghiệp để CVHT kiểm tra.</p>
    @endforeach
  </body>
</div>
</body>
</html>

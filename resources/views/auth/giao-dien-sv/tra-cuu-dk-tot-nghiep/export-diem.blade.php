
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Phiểu điểm</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    
  <style>
       @font-face {
        font-family: 'times new roman Custom'serif !important;
        src: url('{{ asset('storage/fonts/font-times-new-roman.ttf') }}') format("truetype");
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
}
   table, th, td {
       border: 1px solid black;
       border-collapse: collapse;
      }
      body{font-family:'DejaVu Sans;';
          size: 794px 1120px;
          margin-top: 10px;
          margin-left: -12px;
          text-align: justify;
      }
      .none{
        border: none
      }
    </style>

    <body>
    <table style="width:740px; " class="none" align = "center">
        @foreach($data as $item)
        <tr>
            <td class="none">BỘ LAO ĐỘNG - THƯƠNG BINH VÀ XÃ HỘI</td>
            <th class="none">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</th>
        </tr>
        <tr>
            <td class="none" align = "left" style="font-weight:bold">&nbsp;&nbsp;TRƯỜNG ĐẠI HỌC SPKT VĨNH LONG</td>
            <th class="none" style="font-size: 15px">Độc Lập - Tự Do - Hạnh Phúc</th>
        </tr>
        <tr>
            <td class="none"><hr width="60%" color="black" size="2.4"></td>
            <td class="none"><hr width="60%" color="black" size="2.4"></td>
        </tr>
        <tr>
            <th class="none" style="width:1px"><img src="{{asset('images/logovlute.png')}}" alt="Logo VLUTE" style= "width:100px;height:100px"></th>
        </tr>
        <b style="position: absolute; font-size: 30px;margin-top:-78px;margin-left:38%">PHIẾU ĐIỂM</b>
        <tr>
            <td class="none" align = "middle" style="width:360px">Họ và tên:<b> {{$item->ho." ".$item->ten}}</b></th>
            <td class="none" align = "middle" >Mã số sinh viên: {{$item->id_hoc_vien}}</td>
        </tr>
        <tr>
            <td class="none" align = "middle" style="width:360px">Sinh ngày: 02/10/2001</td>
            <td class="none" align = "middle" >Nơi sinh: Vĩnh Long</td>
        </tr>
        <tr>
            <td class="none" align = "middle" style="width:360px">Trình độ đào tạo: Đại học</td>
            <td class="none" align = "middle" >Hình thức đào tạo: Chính quy</td>
        </tr>
        <tr>
            <td class="none" align = "middle" style="width:360px">Ngành: <b>{{$item->ten_chuyen_nganh}}</b></td>
        </tr>
       
        @break
        @endforeach
    </table>
    <h4><b>I- ĐIỂM CÁC HỌC PHẦN NĂM HỌC 2019-2023:</b></h4>
    <table style="width:700px" align = "center">
        <tr>
            <th align = "middle" style="width:40px" rowspan="2">STT</th>
            <th align = "middle" style="width:420px" rowspan="2">Tên học phần</th>
            <th align = "middle" style="width:70px" rowspan="2">Tín chỉ</th>
            <th align = "middle" style="width:140px" colspan="2">Điểm HP</th>
        </tr>
        <tr>
            <th>Chữ</th>
            <th>Hệ 4</th>
        </tr>
        @foreach($data as $item)
            <tr>
                <td style="text-align: center">{{$i=$i+1}}</td>
                <td>&nbsp;{{$item->ten_hoc_phan}}</td>
                <td style="text-align: center">{{$item->tongTinChi}}</td>
                    @if($item -> diem10 >= 8.5 && $item -> diem10 <= 10 )
                        <td style="text-align: center">A</td>
                        <td style="text-align: center">4.0</td>
                    @elseif($item -> diem10 >= 8 && $item -> diem10 < 8.5 )
                        <td style="text-align: center">B+</td>
                        <td style="text-align: center">3.5</td>
                    @elseif($item -> diem10 >= 7 && $item -> diem10 < 8 )
                        <td style="text-align: center">B</td>
                        <td style="text-align: center">3.0</td>
                    @elseif($item -> diem10 >= 6.5 && $item -> diem10 < 7 )
                        <td style="text-align: center">C+</td>
                        <td style="text-align: center">2.5</td>
                    @elseif($item -> diem10 >= 5.5 && $item -> diem10 < 6.5 )
                        <td style="text-align: center">C</td>
                        <td style="text-align: center">2.0</td>
                    @elseif($item -> diem10 >= 5 && $item -> diem10 < 5.5 )
                        <td style="text-align: center">D+</td>
                        <td style="text-align: center">1.5</td>
                    @elseif($item -> diem10 >= 4 && $item -> diem10 < 5 )
                        <td style="text-align: center">D</td>
                        <td style="text-align: center">1.0</td>
                    @elseif($item -> diem10 < 4 )
                        <td style="text-align: center">F</td>
                        <td style="text-align: center">0</td>
                    @endif
            </tr>
        @endforeach
    </table>
    <h4><b>II- KẾT QUẢ HỌC TẬP:</b></h4>
    <p style="font-weight:bold; margin-left:60px">- Điểm trung bình chung năm học: {{$diemTichLuyCanHoc}}</p>
    <p style="font-weight:bold; margin-left:60px">- Xếp loại: {{$hocluc}}</p>
    <p style="font-style:italic; margin-left:52%">Vĩnh Long, ngày&nbsp;&nbsp;....&nbsp;&nbsp;tháng&nbsp;&nbsp;....&nbsp;&nbsp;năm 20....</p>
    <p style="margin-left:67%; font-weight:bold">HIỆU TRƯỞNG</p>
  </body>
</div>
</body>
</html>

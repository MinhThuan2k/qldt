# Hệ thống quản lý đào tạo trực tuyến

#### 1. Cấu hình Laravel

Laravel là một PHP Framework mã nguồn mở miễn phí, được phát triển bởi Taylor Otwell với phiên bản đầu tiên được ra mắt vào tháng 6 năm 2011. Laravel ra đời nhằm mục đích hỗ trợ phát triển các ứng dụng web, dựa trên mô hình MVC (Model – View – Controller).

**Link** https://github.com/laravel/laravel

##### 2. Cấu hình ban đầu
Chạy lệnh `php composer.phar install`

Copy file `.env.example` -> `.env` sau đó chạy lệnh `php artisan key:generate`


##### 3. Quy định về kiến trúc

###### a. Thư mục giao diện `resources/views/auth`

- Mỗi thư mục tương ứng với một tính năng trên giao diện

Ví dụ: `resources/views/auth/don-vi/don-vi.blade.php`

Trong đó `don-vi` là thư mục và `don-vi.blade.php` là giao diện sử dụng

###### b. Quy định đặt tên

- `resources/views/auth`: Đặt tên tiếng việt, không dấu mỗi từ cách nhau dấu gạch nối, ví dụ như `don-vi.blade.php`
- `app/Traits/*`: Đặt tên theo database và in hoa chữ cái đầu mỗi từ, ví dụ `DonVi.php`
- `app/Models/*`: Đặt tên theo database và in hoa chữ cái đầu mỗi từ và có hậu tố **Model**  `DonViModel.php`
- `app/Http/Controllers/*`: Đặt tên theo database và in hoa chữ cái đầu mỗi từ và có hậu tố **Controller** `DonViCOntroller.php`

#### 4. Laravel SQL

Trước tiên điền thông tin cấu hình kết nối CSDL vào file .env

``` dotenv
# Nội dung file .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Sử dụng Laravel SQL RAW https://laravel.com/docs/8.x/database#running-a-select-query

#### 5. Laravel tạo Controller

```
php artisan make:controller DemoController
```

#### 6. Laravel Mix

```dotenv
mix.styles([
    'public/css/bootstrap.min.css',
    'public/css/bootstrap-timepicker.min.css',
    'public/css/lte.css'
], 'public/css/all.css').version();

mix.js('resources/js/auth/don-vi/don-vi.js', 'public/js').version();


npm install
npm run dev
npm run production
```


#### 7. Function Helpers

https://laravel.com/docs/8.x/helpers

##### 7.1 Create Custom Helper Functions

Tạo một file ở vị trí ```app/Helpers.php```
```php
function toAttrJson($data, $list = []){
    if (count($list)){
        $tmp = array();
        $data = (array)$data;
        foreach ($list as $key){
            $tmp[$key] = $data[$key];
        }
        return json_encode($tmp);
    }
    return json_encode($data);
}
```

Thêm file vừa tạo vào ```composer.json```

```composer.json
"autoload": {
    "files": [
        "app/helpers.php"
    ]
},
```

Sau đó cập nhật các thay đổi qua câu lệnh ```php composer.phar dump-autoload```

<?php
dd(json_decode(file_get_contents('https://cdn.24h.com.vn/upload/html-live/ck-trang-chu-2023.json'), true));

// Lấy giá vàng
$file = file_get_contents('https://giavangsjc.net/widgets/giavangfull/dat-gia-vang');
        $file = str_replace(['giavangsjc.net', 'G-QKG2NW1RFL'], ['kiemtranhanh.com', 'G-H0KD1N0NRW'], $file);
        dd($file);
?>

<script type="text/javascript" src="https://giavangsjc.net/widgets/GiavangFullScript/dat-gia-vang"> </script>


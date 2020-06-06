<?php

//Fungsi Nominal
function nominal($parameter){
    $hasil = number_format($parameter,0,',','.');
    return $hasil;

}

date_default_timezone_set("Asia/Jakarta");         //Menyesuaikan dengan Waktu WIB

//Fungsi format_tgl1 : Display tanggal 12 Agustus 2015, dari format tanggal 2015-08-12
function format_tgl1($parameter){                  //Membuat fungsi format_tgl yang akan memproses nilai yang ditaruh di parameter
    $tanggal = substr($parameter,8,2);             //Mengambil 2 Digit dari index ke-8 (urutan ke-9)
    $bln_angka = substr($parameter,5,2);           //Mengambil 2 Digit dari index ke-5 (urutan ke-6)
    switch ($bln_angka){                           //Convert format angka pada bulan ke bentuk string
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
        
    }

}

?>
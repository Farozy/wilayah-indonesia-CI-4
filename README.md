# API Data Wilayah Indonesia

## Apa yang dimaksud API statis?
API statis adalah API yang endpoint-nya terdiri dari file statis.

## Keuntungan API statis?
- Dapat dihosting pada static file hosting seperti Github Page, Netlify, dsb.
- Proses lebih cepat karena tidak membutuhkan server-side scripting.

## Bagaimana cara kerjanya?
- Daftar provinsi, kab/kota, kecamatan, kelurahan/desa disimpan pada folder data berupa file csv (agar mudah diedit).
- Kemudian script generate.php dijalankan. Script ini akan membaca file csv didalam folder data, kemudian men-generate ribuan endpoint (file) kedalam folder static/api.
- API siap 'dihidangkan'.

## Saya mau hosting di Github saya sendiri, bagaimana caranya?
- Fork repository ini.
- Buka cmd/terminal.
- git clone https://github.com/usernamekamu/api-wilayah-indonesia.git.
- echo "" > hello.txt.
- git add hello.txt.
- git push origin master.
- Tunggu beberapa saat sampai Github build Github Page kamu.
- Buka URL https://usernamekamu.github.io/api-wilayah-indonesia.

# ENDPOINTS
#### 1.  Mengambil Daftar Provinsi
GET https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json
> Contoh Response
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json
```
```
[
  {
    "id": "35",
    "name": "JAWA TIMUR"
  },
  {
    "id": "33",
    "name": "JAWA TENGAH"
  },
  ...
]
```

2.  Mengambil Daftar Kab/Kota pada Provinsi Tertentu
> Contoh Response
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{provinceId}.json
```
Contoh untuk mengambil daftar kab/kota di provinsi Jawa Timur (ID = 135):
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/regencies/135.json
```
> Contoh Response
```
[
  {
    "id": "3514",
    "province_id": "35",
    "name": "KABUPATEN PASURUAN"
  },
  {
    "id": "3575",
    "province_id": "35",
    "name": "KOTA PASURUAN"
  },
  ...
]
```

3.  Mengambil Daftar Kecamatan pada Kab/Kota Tertentu
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/districts/{regencyId}.json
```
Contoh untuk mengambil daftar kecamatan di Pasuruan (ID = 3575):
> Contoh Response
```
[
  {
    "id": "3514240",
    "regency_id": "3514",
    "name": "NGULING"
  },
  {
    "id": "3514220",
    "regency_id": "3514",
    "name": "GRATI"
  },
  ...
]
```

4.  Mengambil Daftar Kelurahan pada Kecamatan Tertentu
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/villages/{districtId}.json
```
Contoh untuk mengambil daftar kelurahan di Nguling (ID = 3514220):
> Contoh Response
```
[
  {
    "id": "3514240012",
    "district_id": "3514240",
    "name": "KEDAWANG"
  },
  {
    "id": "3514240011",
    "district_id": "3514240",
    "name": "MLATEN"
  },
  ...
]
```

5. Mengambil Data Provinsi berdasarkan ID Provinsi
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/province/{provinceId}.json
```
Contoh untuk mengambil data provinsi Jawa Timur (ID = 35):
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/province/35.json
```
> Contoh Response
```
{
  "id": "35",
  "name": "JAWA TIMUR"
}
```

6.  Mengambil Data Kab/Kota berdasarkan ID Kab/Kota
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/regency/{regencyId}.json
```
Contoh untuk mengambil data kabupaten Pasuruan (ID = 3514):
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/regency/3514.json
```
> Contoh Response:
```
{
  "id": "3514",
  "province_id": "35",
  "name": "KABUPATEN PASURUAN"
}
```

7.  Mengambil Data Kecamatan berdasarkan ID Kecamatan
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/district/{districtId}.json
```
Contoh untuk mengambil data kecamatan Nguling (ID = 3514240):
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/district/3514240.json
```
> Contoh Response:
```
{
  "id": "3514240",
  "regency_id": "3514",
  "name": "NGULING"
}
```

8. Mengambil Data Kelurahan berdasarkan ID Kelurahan
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/village/{villageId}.json
```
Contoh untuk mengambil data kelurahan Jambo Dalem (ID = 3514240012):
```
GET https://emsifa.github.io/api-wilayah-indonesia/api/village/3514240012.json
```
> Contoh Response:
```
{
  "id": "3514240012",
  "district_id": "3514240",
  "name": "KEDAWANG"
}
```

# Limitasi
Karena API ini dihosting di Github Page, Github Page sendiri memberikan batasan bandwith 100GB/bulan. Rata-rata endpoint disini memiliki ukuran 1KB/endpoint, jadi kurang lebih request yang dapat digunakan adalah 100.000.000 request per bulan, atau sekitar 3.000.000 request/hari.

Karena limitasi ini, disarankan untuk hosting API ini di github kamu sendiri.

Untuk lebih detail tentang limitasi Github Page, bisa dilihat [disini](https://docs.github.com/en/pages/getting-started-with-github-pages/about-github-pages#usage-limits)







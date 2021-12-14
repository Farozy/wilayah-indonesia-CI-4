<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
        }
        .select2-selection__arrow {
            height: 38px !important;
        }
        .select2-selection__clear {
            position: absolute !important;
            right: 20px !important;
        }
    </style>
    <title>Wilayah Indonesia</title>
</head>

<body>
    <div class="container mt-4">
            <h3>Periksa ongkos kirim dengan cepat di sini</h3>
            <form action="<?= base_url('home/proses_pengiriman'); ?>" method="POST">
                <div class="form-group">
                    <label for="">Pilih Provinsi</label>
                    <select class="custom-select" id="provinsi"></select>
                </div>
                <div class="form-group">
                    <label for="">Pilih Kabupaten / Kota</label>
                    <select class="custom-select" id="kabupaten"></select>
                </div>
                <div class="form-group">
                    <label for="">Pilih Kecamatan</label>
                    <select class="custom-select" id="kecamatan"></select>
                </div>
                <div class="form-group">
                    <label for="">Pilih Keluarahan</label>
                    <select class="custom-select" id="kelurahan"></select>
                </div>
            </form>
        <hr/>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kabupaten').prop('disabled', true);
            $('#kecamatan').prop('disabled', true);
            $('#kelurahan').prop('disabled', true);
            $('#provinsi').select2({
                // minimumResultsForSearch: Infinity,
                placeholder: 'Pilih Provinsi',
                allowClear: true,
                ajax: {
                    url: 'http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                    type: 'get',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term, // "search" = match the expected API URL variable
                            page: params.page,
                            fields: "version,filename,description", // extra search variables can be added
                            search_fields: "name,id" // the query can be restricted to specific fields
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });

            $("#provinsi").change(function(){
                var id_provinces = $(this).val(); 
                if( id_provinces != null ) {
                    var placeholder = 'Pilih Kabupaten / Kota';
                    $('#kabupaten').prop('disabled', false);
                } else {
                   $('#kabupaten').empty();
                   $('#kabupaten').prop('disabled', true);
                }
                $('#kabupaten').select2({
                    // minimumResultsForSearch: Infinity,
                    placeholder: placeholder,
                    language: "id",
                    "language": {
                        "noResults": function(){
                            return "Tidak ada data";
                        }
                    },
                    allowClear: true,
                    ajax: {
                        url: 'http://www.emsifa.com/api-wilayah-indonesia/api/regencies/'+ id_provinces +'.json',
                        type: 'get',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });                
            });

            $("#kabupaten").change(function(){
                var id_kabupaten = $(this).val(); 
                if( id_kabupaten != null ) {
                    var placeholder = 'Pilih Kecamatan';
                    $('#kecamatan').prop('disabled', false);
                } else {
                    $('#kecamatan').empty();
                    $('#kecamatan').prop('disabled', true);
                }
                $('#kecamatan').select2({
                    // minimumResultsForSearch: Infinity,
                    placeholder: placeholder,
                    allowClear: true,
                    language: "id",
                    "language": {
                        "noResults": function(){
                            return "Tidak ada data";
                        }
                    },
                    ajax: {
                        url: 'http://www.emsifa.com/api-wilayah-indonesia/api/districts/'+ id_kabupaten +'.json',
                        type: 'get',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });                
            });

            $("#kecamatan").change(function(){
                var id_kecamatan = $(this).val(); 
                if( id_kecamatan != null ) {
                    var placeholder = 'Pilih Kelurahan';
                    $('#kelurahan').prop('disabled', false);
                } else {
                    $('#kelurahan').empty();
                    $('#kelurahan').prop('disabled', true);
                }
                $('#kelurahan').select2({
                    // minimumResultsForSearch: Infinity,
                    placeholder: placeholder,
                    allowClear: true,
                    ajax: {
                        url: 'http://www.emsifa.com/api-wilayah-indonesia/api/villages/'+ id_kecamatan +'.json',
                        type: 'get',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });                
            });
        })
    </script>
</body>
</html>

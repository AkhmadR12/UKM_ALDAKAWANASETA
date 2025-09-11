<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-signature/1.2.1/jquery.signature.min.js"></script>

<!-- jQuery Signature -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-signature/1.2.1/jquery.signature.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-signature/1.2.1/jquery.signature.min.js"></script>
{{-- untuk signature --}}
{{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script> --}}
<!-- jQuery -->
<script src="{{ asset('admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>
 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">


<!-- jQuery Scrollbar -->
<script src="{{ asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('admin/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('admin/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js "></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
{{-- <script src="{{ asset('admin/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/assets/js/plugin/jsvectormap/world.js') }}"></script> --}}

<!-- Sweet Alert -->
<script src="{{ asset('admin/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('admin/assets/js/kaiadmin.min.js') }}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset('admin/assets/js/setting-demo.js') }}"></script>
{{-- <script src="{{ asset('admin/assets/js/demo.js') }}"></script> --}}

<script>
    $(document).ready(function() {
        // Sparkline Charts
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)"
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)"
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)"
        });

        // DataTables Initialization
        if (!$.fn.DataTable.isDataTable('#basic-datatables')) {
            $("#basic-datatables").DataTable({});
        }

        if (!$.fn.DataTable.isDataTable('#multi-filter-select')) {
            $("#multi-filter-select").DataTable({
                pageLength: 5,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this)
                                    .val());
                                column.search(val ? "^" + val + "$" : "", true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                "</option>");
                        });
                    });
                }
            });
        }

        // $("#add-row").DataTable({
        //   pageLength: 5,
        // });

        // var action =
        //   '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        // $("#addRowButton").click(function () {
        //   $("#add-row")
        //     .dataTable()
        //     .fnAddData([
        //       $("#addName").val(),
        //       $("#addPosition").val(),
        //       $("#addOffice").val(),
        //       action,
        //     ]);
        //   $("#addRowModal").modal("hide");
        // });

        if (!$.fn.DataTable.isDataTable('#add-row')) {
            $("#add-row").DataTable({
                pageLength: 5,
                language: {
                    paginate: {
                        previous: "Previous",
                        next: ""
                    },
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    lengthMenu: "Show _MENU_ entries"
                },
                dom: '<"top"lf>rt<"bottom"ip><"clear">',
                pagingType: "simple_numbers", // Menggunakan tipe paginasi dengan angka
                drawCallback: function(settings) {
                    var api = this.api();
                    var pageInfo = api.page.info();

                    // Sembunyikan paginasi hanya jika tidak ada entri atau hanya satu halaman
                    if (pageInfo.pages <= 1 && pageInfo.recordsDisplay === 0) {
                        $('.dataTables_paginate, .dataTables_info').hide();
                    } else {
                        $('.dataTables_paginate, .dataTables_info').show();
                    }
                }
            });
        }

        // Kode untuk menambahkan baris baru
        $("#addRowButton").click(function() {
            var table = $("#add-row").DataTable();
            table.row.add([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action
            ]).draw(false);

            $("#addRowModal").modal("hide");
        });

        // Kondisi Button Action Pemohon
        $(document).ready(function() {
            $('.btn-kondisi').on('click', function() {
                var button = $(this);
                var kondisiId = button.data('id');

                $.ajax({
                    url: '{{ url('/signature-kondisi-pemohon') }}/' + kondisiId,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            button.text(response.kondisi);
                            button.removeClass('btn-success btn-danger').addClass(
                                'btn-' + (response.kondisi === 'ON' ?
                                    'success' : 'danger'));
                        } else {
                            alert('Gagal mengubah kondisi.');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });

        $("#alert_demo_7").click(function(e) {
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                buttons: {
                    confirm: {
                        text: "Yes, delete it!",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                },
            }).then((Delete) => {
                if (Delete) {
                    swal({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        type: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                } else {
                    swal.close();
                }
            });
        });

        // Kondisi Button Action Data
        $(document).ready(function() {
            $('.btn-kondisi').on('click', function() {
                var button = $(this);
                var kondisiId = button.data('id');

                $.ajax({
                    url: '{{ url('/data-kondisi') }}/' + kondisiId,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            button.text(response.verifikasi);
                            button.removeClass('btn-success btn-danger').addClass(
                                'btn-' + (response.verifikasi === 'ON' ?
                                    'success' : 'danger'));
                        } else {
                            alert('Gagal mengubah verifikasi.');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });

        // // Signature
        // var sig = $('#sig').signature({
        //     syncField: '#signature',
        //     syncFormat: 'PNG'
        // });
        // $('#clear').click(function(e) {
        //     e.preventDefault();
        //     sig.signature('clear');
        //     $("#signature64").val('');
        // });


    });
    // Get the modal
    var modal;
    var modalImg;
    var captionText;

    $('.myImg').on('click', function() {
        modal = $(this).next('.myModal');
        modalImg = modal.find('.modal-content');
        captionText = modal.find('.caption');

        modal.css('display', 'block');
        modalImg.attr('src', $(this).attr('src'));
        captionText.text($(this).attr('alt'));
    });

    // When the user clicks on <span> (x), close the modal
    $('.close').on('click', function() {
        $(this).closest('.modal').css('display', 'none');
    });
    $(document).ready(function() {
        $('#search-menu').on('keyup', function() {
            let query = $(this).val();

            $.ajax({
                url: "{{ url('/menus/search') }}",
                type: "GET",
                data: {
                    query: query
                },
                success: function(data) {
                    let menuList = $("#menu-list");
                    menuList.empty();

                    if (data.length > 0) {
                        data.forEach(menu => {
                            menuList.append(
                                `<li class="p-2 hover:bg-gray-700 cursor-pointer">${menu.name}</li>`
                            );
                        });
                    } else {
                        menuList.append(
                            `<li class="p-2 text-gray-400">Menu tidak ditemukan</li>`);
                    }
                }
            });
        });
    });
    // <script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>



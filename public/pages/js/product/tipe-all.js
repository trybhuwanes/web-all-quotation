"use strict";
var KTUsersList = (function () {
    var o = document.getElementById("kt_table_users");

    const l = () => {
        // Logika lain seperti event listener untuk checkbox dan delete bisa diletakkan di sini jika diperlukan
    };

    return {
        init: function () {
            o &&
                $(o).DataTable({
                    info: !1,
                    order: [],
                    paging: false,
                    lengthChange: !1,
                    columnDefs: [
                        {
                            orderable: !1,
                            targets: 0,
                        },
                    ],
                }).on("draw", function () {
                    l();
                });
            l();

            // Event listener untuk tombol "Tipe Baru"
            $("#kt_ecommerce_add_product_type .card-toolbar").on("click", ".new", function () {
                const productId = $(this).attr("data-kt-user-id");
                console.log(productId);
                // Tentukan URL rute baru untuk create tipe
                const Url = route('product.type.create', {productId: productId});
                // Arahkan ke rute tersebut
                window.location.href = Url;
            });
            // Event listener untuk tombol "Edit Tipe"
            $("#kt_table_users tbody").on("click", ".edit", function () {
                const productId = $(this).attr("data-kt-user-id");
                const typeId = $(this).attr("data-kt-tipe-id");
                // console.log(typeId);
                // Tentukan URL rute baru untuk create tipe
                const Url = route('product.type.edit', {productId: productId, typeId: typeId,});
                // Arahkan ke rute tersebut
                window.location.href = Url;
            });
        },
        search: function (q) {
            console.log(`searching for ${q}...`);
            const currentParams = route().params;
            delete currentParams.q;
            delete currentParams.page;
            const params = {
                q,
                ...currentParams,
            };
            const url = route('product.index', params);
            window.location.href = url;
        },
        edit: function (data) {
            document.querySelector("#product-name").value = data.nama_product;
            if (data.thumbnail) {
                document.querySelector(".change-file-thumb").style.backgroundImage = `url(${data.thumbnail})`;
            }
            document.querySelector("#kt_form_create_product").scrollIntoView();
        },
    };
})();

// Inisialisasi saat DOM sudah siap
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});

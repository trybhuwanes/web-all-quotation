"use strict";
var KTUsersList = (function () {
    var o = document.getElementById("kt_table_carts");

    return {
        delete: function (data) {
            const id = data.id;
            const nama_kategori = data.nama_kategori;
            const url = route("cart.delete", { id: id });

            Swal.fire({
                text: `Apakah Anda yakin ingin menghapus item ?`,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary",
                },
            }).then(function (t) {
                if (t.value) {
                    axios
                        .delete(url)
                        .then(({ data }) => {
                            if (data.success) {
                                Swal.fire({
                                    text: `Data dihapus`,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, lanjutkan!",
                                    customClass: {
                                        confirmButton:
                                            "btn fw-bold btn-primary",
                                    },
                                }).then(function () {
                                    return window.location.reload(true);
                                });
                            }
                        })
                        .catch((error) => {
                            Swal.fire({
                                text: "Sorry",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, lanjutkan!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                },
                            });
                        });
                } else if (t.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        text: `Data tidak dihapus`,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lanjutkan!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        },
                    });
                }
            });
        },

        updateQuantity: function (id, action) {
            const url = route("cart.updateQuantity", { id: id });
            axios
                .post(url, { action: action })
                .then(({ data }) => {
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        text: "Sorry",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lanjutkan!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        },
                    });
                });
        },

        deletecart: function (data) {
            const id = data.id;
            const nama_kategori = data.nama_kategori;
            const url = route("cart.destroy", { id: id });

            Swal.fire({
                text: "Apakah Anda yakin, menghapus seluruh keranjang Anda ?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary",
                },
            }).then(function (t) {
                if (t.value) {
                    axios
                        .delete(url)
                        .then(({ data }) => {
                            if (data.success) {
                                Swal.fire({
                                    text: window.i18n.common.form_has_submitted,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText:
                                        window.i18n.common.btn_ok_got_it,
                                    customClass: {
                                        confirmButton:
                                            "btn fw-bold btn-primary",
                                    },
                                }).then(function () {
                                    let Url = route("product-overview.index");
                                    window.location.href = Url;
                                });
                            }
                        })
                        .catch((error) => {
                            Swal.fire({
                                text: "Terjadi kesalahan coba, lagi nanti!",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, lanjutkan!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                },
                            });
                        });
                } else if (t.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        text: "Batal menghapus!",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, lanjutkan!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        },
                    });
                }
            });
        },

        checkout: function () {
            const url = route("checkout.process");
            const isShippingToOnsite = $("#use_shipping_checkbox").is(
                ":checked"
            );

            const payload = {
                use_shipping_to_onsite: isShippingToOnsite,
            };

            if (isShippingToOnsite) {
                const totalKg = $("[data-kt-pos-element='total']")
                    .text()
                    .replace(" Kg", "")
                    .trim();
                const totalVolume = $("[data-kt-pos-element='discount']")
                    .text()
                    .replace(" M3", "")
                    .trim();

                const perusahaan = $("#desti_company").val().trim();
                const provinsi = $("#desti_state").val();
                const kota = $("#desti_city").val();
                const alamatDetail = $("#desti_address").val().trim();

                const alamatComplete = `${alamatDetail}, ${kota}, ${provinsi}`;
                payload.total_kg = totalKg;
                payload.total_volume = totalVolume;
                payload.perusahaan = perusahaan;
                payload.provinsi = provinsi;
                payload.kota = kota;
                payload.address_destination = alamatComplete;
            }

            if (!payload.use_shipping_to_onsite) {
                Swal.fire({
                    text: "Masukan alamat pengiriman, untuk melanjutkan!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, saya mengerti!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    },
                });
                return; 
            }

            Swal.fire({
                text: "Pastikan produk yang dipilih benar, Apakah Anda yakin ingin melanjutkan pesanan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Proses",
                cancelButtonText: "Tidak, Batal",
                customClass: {
                    confirmButton: "btn fw-bold btn-success",
                    cancelButton: "btn fw-bold btn-active-light-primary",
                },
            }).then(function (t) {
                if (t.value) {
                    axios
                        .post(url, payload)
                        .then(function (response) {
                            const code = response.data.data;
                            Swal.fire({
                                text: "Checkout successful!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Lihat orderan anda",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                },
                            }).then(function (e) {
                                let Url = route("order.detail", { code: code });
                                window.location.href = Url;
                            });
                        })
                        .catch(function (error) {
                            const errorMessage =
                                error.response &&
                                error.response.data &&
                                error.response.data.message
                                    ? error.response.data.message
                                    : "Maaf Terjadi Kesalahan.";
                            Swal.fire({
                                text: errorMessage,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, lanjutkan!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                },
                            });
                        });
                }
            });
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    $("#kt_table_carts tbody").on("click", ".delete", function () {
        const data = {
            id: $(this).attr("data-kt-detailcart-id"),
        };
        KTUsersList.delete(data);
    });


    $("#kt_table_carts tbody").on(
        "click",
        "[data-kt-dialer-control='decrease']",
        function () {
            const id = $(this)
                .closest("tr")
                .find(".delete")
                .attr("data-kt-detailcart-id");
            KTUsersList.updateQuantity(id, "decrease");
        }
    );

    $("#kt_table_carts tbody").on(
        "click",
        "[data-kt-dialer-control='increase']",
        function () {
            const id = $(this)
                .closest("tr")
                .find(".delete")
                .attr("data-kt-detailcart-id");
            KTUsersList.updateQuantity(id, "increase");
        }
    );

    $("#kt_delete_cart").on("click", ".deletecart", function () {
        console.log("test");
        const data = {
            id: $(this).attr("data-kt-cart-id"),
        };
        KTUsersList.deletecart(data);
    });

    $(document).on("click", "#outcheck .xtp", function () {
        KTUsersList.checkout();
    });
});

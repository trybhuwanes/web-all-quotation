"use strict";
var KTQuotationsCreate = (function () {
    const form = document.getElementById("kt_create_quotation_form");

    function initProductSelect2(el) {
        $(el).select2({
            ajax: {
                url: route("select2.item-productmain"),
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return { q: params.term, page: params.page };
                },
                processResults: function (data) {
                    return { results: data };
                },
                cache: true,
            },
            dropdownParent: "#kt_create_quotation_form",
        });
    }

    function initAdditionalProductSelect2(el) {
        $(el).select2({
            ajax: {
                url: function () {
                    const mainProductId = $("#main-product").val(); // ambil product utama
                    if (!mainProductId) {
                        return route("select2.item-productadditional", {
                            mainProductId: 0,
                        });
                    }
                    return route("select2.item-productadditional", {
                        mainProductId: mainProductId,
                    });
                },
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return { q: params.term, page: params.page };
                },
                processResults: function (data) {
                    const selected = getSelectedAdditionalProducts();
                    return {
                        results: data
                            .filter(
                                (item) => !selected.includes(item.id.toString())
                            )
                            .map((item) => ({
                                id: item.id,
                                text: item.text,
                                harga: item.harga,
                            })),
                    };
                },
                cache: true,
            },
            templateResult: function (data) {
                if (!data.id) return data.text;
                return `${data.text} - Rp ${new Intl.NumberFormat(
                    "id-ID"
                ).format(data.harga)}`;
            },
            dropdownParent: "#kt_create_quotation_form",
        });
        // event saat pilih produk tambahan
        $(el).on("select2:select", function (e) {
            const data = e.params.data;
            const row = e.target.closest("tr");
            const rateInput = row.querySelector(".rate");
            if (rateInput) {
                rateInput.value = data.harga; // isi rate otomatis
            }
            // trigger hitung ulang
            recalcTotal();
        });
    }

    function getSelectedAdditionalProducts() {
        return Array.from(
            document.querySelectorAll("#additional-items tbody select")
        )
            .map((select) => select.value)
            .filter((val) => val); // hanya yang terisi
    }

    function initCompanySelect2() {
        $("#company-select").select2({
            ajax: {
                url: route("select2.company"),
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return { q: params.term, page: params.page };
                },
                processResults: function (data) {
                    return { results: data };
                },
                cache: true,
            },
            dropdownParent: "#kt_create_quotation_form",
        });

        $("#company-select").on("select2:select", function (e) {
            let companyId = e.params.data.id;

            axios
                .get(route("select2.company.show", { id: companyId }))
                .then(({ data }) => {
                    // isi otomatis quotation for
                    $("input[name='from_business']").val(data.company);
                    $("input[name='from_email']").val(data.email);
                    $("input[name='from_contact']").val(data.phone);
                    $("textarea[name='from_address']").val(data.address);
                })
                .catch((err) => console.error("Error fetching client:", err));
        });
    }

    function initClientSelect2() {
        $("#client-select").select2({
            ajax: {
                url: route("select2.client"),
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return { q: params.term, page: params.page };
                },
                processResults: function (data) {
                    return { results: data };
                },
                cache: true,
            },
            dropdownParent: "#kt_create_quotation_form",
        });

        $("#client-select").on("select2:select", function (e) {
            const clientId = e.params.data.id;

            axios.get(route("select2.client.show", { id: clientId }))
                .then(({ data }) => {
                    console.log("Client data:", data);
                    console.log("Client ID:", clientId);
                    // isi otomatis quotation to
                    $("input[name='to_name']").val(data.name);
                    $("input[name='to_business']").val(data.company);
                    $("input[name='to_contact']").val(data.phone);
                    $("textarea[name='to_address']").val(data.location_company);
                })
                .catch(err => {
                    console.error("Gagal mengambil data klien:", err);
                    Swal.fire("Error", "Tidak dapat mengambil data dari database", "error");
                });
        });
    }

    function handleAddClient() {
        $("#form-add-client").on("submit", function (e) {
            e.preventDefault();
            console.log("Intercepted! Submitting via AJAX..."); // <-- cek ini muncul
            let form = $(this);
            let action = form.attr("action");

            axios
                .post(action, form.serialize())
                .then(({ data }) => {
                    if (data.success) {
                        // tutup modal
                        $("#modal-add-client").modal("hide");

                        // tambahkan client ke dropdown select2
                        let newOption = new Option(
                            data.data.name,
                            data.data.id,
                            true,
                            true
                        );
                        $("#client-select").append(newOption).trigger("change");

                        Swal.fire("Berhasil", data.message, "success");
                    }
                })
                .catch((err) => {
                    console.error(err);
                    Swal.fire("Error", "Gagal menambahkan client", "error");
                });
        });
    }

    function submitForm() {
        $("#kt_create_quotation_form").on("submit", function (e) {
            e.preventDefault();

            const form = $(this);
            const formData = form.serialize();

            axios.post(route("equipment.order.store"), formData)
                .then(({ data }) => {
                    if (data.success) {
                        Swal.fire("Berhasil", data.message, "success").then(() => {
                            window.location.href = route("equipment.order.index");
                        });
                    } else {
                        Swal.fire("Gagal", data.message, "error");
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire("Error", "Terjadi kesalahan saat menyimpan order", "error");
                });
        });
    }

    function shippingDetail() {}

    function recalcTotal() {
        let total = 0;

        // hitung item utama
        const mainItem = document.getElementById("main-item");
        if (mainItem) {
            const qty = parseFloat(mainItem.querySelector(".qty").value) || 0;
            const rate = parseFloat(mainItem.querySelector(".rate").value) || 0;
            const amount = qty * rate;
            mainItem.querySelector(".amount").value = amount.toFixed(2);
            total += amount;
        }

        // hitung item tambahan
        document
            .querySelectorAll("#additional-items tbody tr")
            .forEach((row) => {
                const qty = parseFloat(row.querySelector(".qty").value) || 0;
                const rate = parseFloat(row.querySelector(".rate").value) || 0;
                const amount = qty * rate;
                row.querySelector(".amount").value = amount.toFixed(2);
                total += amount;
            });

        // update total
        document.getElementById("quotation-total").innerText = formatRupiah(
            total.toFixed(0)
        );
    }

    function formatRupiah(angka) {
        return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    return {
        init: function () {
            // init select2 default
            document
                .querySelectorAll(".product-select")
                .forEach(initProductSelect2);
            document
                .querySelectorAll(".additional-product-select")
                .forEach(initAdditionalProductSelect2);

            // tambah row item tambahan
            document.addEventListener("click", function (e) {
                if (e.target.classList.contains("add-row")) {
                    const target = e.target.dataset.target;
                    const table = document
                        .querySelector(target)
                        .querySelector("tbody");
                    const index = table.rows.length;

                    // clone row baru
                    const newRow = table.rows[0].cloneNode(true);

                    // reset input
                    newRow.querySelectorAll("input").forEach((input) => {
                        input.value = "";
                        let name = input.getAttribute("name");
                        name = name.replace(/\d+/, index);
                        input.setAttribute("name", name);
                        if (input.classList.contains("amount"))
                            input.value = "0";
                    });

                    // reset select2
                    newRow.querySelectorAll("select").forEach((select) => {
                        // hapus markup select2 lama kalau ada
                        $(select).next(".select2-container").remove();

                        select.innerHTML = "<option></option>"; // kosongkan
                        let name = select.getAttribute("name");
                        name = name.replace(/\d+/, index);
                        select.setAttribute("name", name);

                        initAdditionalProductSelect2(select); // init ulang
                    });

                    table.appendChild(newRow);
                }
            });

            // hapus row
            document.addEventListener("click", function (e) {
                if (e.target.classList.contains("remove-row")) {
                    const row = e.target.closest("tr");
                    const tbody = row.closest("tbody");
                    if (tbody.rows.length > 1) row.remove();
                    recalcTotal();
                }
            });

            // kalkulasi saat input
            document.addEventListener("input", function (e) {
                if (
                    e.target.classList.contains("qty") ||
                    e.target.classList.contains("rate")
                ) {
                    recalcTotal();
                }
            });

            // ambil tipe produk utama via ajax setelah pilih produk
            $("#main-product").on("change", function () {
                const productId = $(this).val();
                if (!productId) return;

                console.log("Fetching types for product:", productId);

                axios
                    .get(route("product.type", { id: productId }))
                    .then(({ data }) => {
                        console.log("Types response:", data);

                        let html = "";
                        data.forEach((type) => {
                            html += `
                                <div class="col-6 col-sm-4 col-md-3 mb-3">
                                    <input class="btn-check" type="radio" 
                                        name="main_product_type" 
                                        id="type_${type.id}" 
                                        value="${type.id}" 
                                        data-harga="${type.harga}" />
                                    <label class="btn btn-outline border-hover-primary btn-active-success btn-color-muted w-100" 
                                        for="type_${type.id}">
                                        ${type.type_name}
                                    </label>
                                </div>`;
                        });
                        document.getElementById(
                            "main-product-types"
                        ).innerHTML = `<div class="row">${html}</div>`;

                        // bind event listener utk radio baru
                        document
                            .querySelectorAll("input[name='main_product_type']")
                            .forEach((radio) => {
                                radio.addEventListener("change", function () {
                                    const harga = this.dataset.harga;
                                    // isi otomatis rate utk produk utama
                                    const rateInput = document.querySelector(
                                        "input[name='main_rate']"
                                    );
                                    if (rateInput) {
                                        rateInput.value = harga;
                                    }
                                    // trigger kalkulasi ulang
                                    recalcTotal();
                                });
                            });
                    })
                    .catch((err) => {
                        console.error("Error fetching types:", err);
                    });

                // reset semua dropdown produk tambahan
                document
                    .querySelectorAll(".additional-product-select")
                    .forEach((select) => {
                        $(select).val(null).trigger("change");
                        initAdditionalProductSelect2(select);
                    });
            });

            initCompanySelect2();
            initClientSelect2();
            handleAddClient();
            shippingDetail();
            recalcTotal();
            submitForm();
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTQuotationsCreate.init();

    // Get current date and time
    var now = new Date();

    // Format the date and time
    var datetime = now.toLocaleString();

    // Insert date and time into HTML
    document.getElementById("datetime").innerHTML = datetime;

    // toggle tampil shipping
    const toggleShipping = document.getElementById("toggle-shipping");
    const shippingSection = document.getElementById("shipping-section");

    toggleShipping.addEventListener("change", function () {
        shippingSection.classList.toggle("d-none", !this.checked);
    });

    // copy shipping from = quotation from
    document
        .getElementById("copy-from-quotation")
        .addEventListener("change", function () {
            const fromCompany = document.querySelector(
                "input[name='from_business']"
            ).value;
            const fromAddress = document.querySelector(
                "textarea[name='from_address']"
            ).value;
            const fromContact = document.querySelector(
                "input[name='from_contact']"
            ).value;

            if (this.checked) {
                document.querySelector(
                    "input[name='shipping_from_company']"
                ).value = fromCompany;
                document.querySelector(
                    "textarea[name='shipping_from_address']"
                ).value = fromAddress;
                document.querySelector(
                    "input[name='shipping_from_contact']"
                ).value = fromContact;
            } else {
                document.querySelector(
                    "input[name='shipping_from_company']"
                ).value = "";
                document.querySelector(
                    "input[name='shipping_from_address']"
                ).value = "";
                document.querySelector(
                    "input[name='shipping_from_contact']"
                ).value = "";
            }
        });

    // copy shipping for = quotation for
    document
        .getElementById("copy-for-quotation")
        .addEventListener("change", function () {
            const toCompany = document.querySelector(
                "input[name='to_business']"
            ).value;
            const toAddress = document.querySelector(
                "textarea[name='to_address']"
            ).value;
            const toContact = document.querySelector(
                "input[name='to_contact']"
            ).value;

            if (this.checked) {
                document.querySelector(
                    "input[name='shipping_to_company']"
                ).value = toCompany;
                document.querySelector(
                    "textarea[name='shipping_to_address']"
                ).value = toAddress;
                document.querySelector(
                    "input[name='shipping_to_contact']"
                ).value = toContact;
            } else {
                document.querySelector(
                    "input[name='shipping_to_company']"
                ).value = "";
                document.querySelector(
                    "textarea[name='shipping_to_address']"
                ).value = "";
                document.querySelector(
                    "input[name='shipping_to_contact']"
                ).value = "";
            }
        });
});

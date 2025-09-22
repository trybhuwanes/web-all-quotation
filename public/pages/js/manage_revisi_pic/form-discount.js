"use strict";
var KTDicountAdd = (function () {
    const modalElement = document.getElementById("kt_modal_discount"),
        formElement = modalElement.querySelector("#kt_modal_discount_form"),
        modal = new bootstrap.Modal(modalElement),
        submitButton = modalElement.querySelector(
            '[data-kt-discount-modal-action-type="submit"]'
        );

    return {
        init: function () {
            // Initialize submit button
            submitButton.addEventListener("click", (event) => {
                event.preventDefault();
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                setTimeout(function () {
                    KTDicountAdd.submitForm();
                }, 2000);
            });

            // Initialize cancel and close buttons
            KTGlobal().cancelForm(
                '[data-kt-discount-modal-action-type="cancel"], [data-kt-discount-modal-action-type="close"]',
                modalElement,
                () => {
                    KTDicountAdd.clearForm();
                    KTGlobal().resetErrorbags();
                },
                modal
            );

            // Event listener for bid option buttons
            const discOptionButtons = modalElement.querySelectorAll(
                '[data-kt-modal-discount="option"]'
            );
            discOptionButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    let discAmount = this.textContent;
                    discAmount = discAmount.replace(/\./g, "");
                    formElement.querySelector(
                        'input[name="discount_amount"]'
                    ).value = discAmount;
                });
            });

            const discOptionWrapper = modalElement.querySelector("#discount-options");
            const discTypeSelect = modalElement.querySelector("#discount_type");

            // Default event untuk tombol opsi
            const bindOptionEvents = () => {
                const buttons = discOptionWrapper.querySelectorAll('[data-kt-modal-discount="option"]');
                buttons.forEach((button) => {
                    button.addEventListener("click", function () {
                        let value = this.textContent.replace(/\./g, "").replace("%", "").trim();
                        formElement.querySelector('input[name="discount_amount"]').value = value;
                    });
                });
            };

            // Inisialisasi pertama
            bindOptionEvents();

            // Ubah opsi tombol saat discount_type diganti
            discTypeSelect.addEventListener("change", function () {
                let type = this.value;
                let html = "";

                if (type === "fixed") {
                    html = `
                        <button type="button" class="btn btn-light-primary w-100" data-kt-modal-discount="option">1.000.000</button>
                        <button type="button" class="btn btn-light-primary w-100" data-kt-modal-discount="option">2.000.000</button>
                        <button type="button" class="btn btn-light-primary w-100" data-kt-modal-discount="option">3.000.000</button>
                    `;
                } else if (type === "percentage") {
                    html = `
                        <button type="button" class="btn btn-light-primary w-100" data-kt-modal-discount="option">2%</button>
                        <button type="button" class="btn btn-light-primary w-100" data-kt-modal-discount="option">5%</button>
                        <button type="button" class="btn btn-light-primary w-100" data-kt-modal-discount="option">10%</button>
                    `;
                }

                discOptionWrapper.innerHTML = html;
                bindOptionEvents(); // re-bind event ke tombol baru
            });
        },

        edit: function (data) {
            // Mengisi form dengan data yang akan diedit
            $("#o-id").val(data.id);
            $("#discount").val(data.discount_p);

            // Menampilkan modal
            modal.show();
        },

        // Function to clear the form
        clearForm: function () {
            formElement.reset();
            // Reset bid amount input
            formElement.querySelector('input[name="discount_amount"]').value =
                "";
            $("#o-id").val("");
        },

        // Function to submit form
        submitForm: function () {
            let url = "";
            const oId = $("#o-id").val();
            const discountP = $("#discount").val();
            const discountType = $("#discount_type").val(); // ambil jenis diskon
            
            let formData = new FormData();

            // Check if editing or adding dataw
            if (oId) {
                url = route("give-discounts.update", { id: oId });
                formData.append("_method", "put");
                formData.append("id", oId);
            }
            formData.append("discount_amount", discountP);
            formData.append("discount_type", discountType); // kirim discount type ke server
            
            // Send data using axios
            axios
                .post(url, formData)
                .then(({ data }) => {
                    if (data.success) {
                        Swal.fire({
                            text: `Data berhasil disimpan`,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, lanjutkan!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        }).then((result) => {
                            if (result.isConfirmed) {
                                modal.hide();
                                window.location.reload(true);
                            }
                        });
                    }
                })
                .catch(({ response }) => {
                    // Handle errors
                    $("#form-error").removeClass("d-none");
                    $("#form-error-message").text(response.data.message);
                    if (response.data.errors) {
                        $("#error-category-name").text(
                            response.data.errors.nama_kategori || ""
                        );
                        $("#error-category-description").text(
                            response.data.errors.deskripsi || ""
                        );
                        $("#error-logo").text(
                            response.data.errors.avatar || ""
                        );
                    }
                })
                .finally(() => {
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                });
        },
    };
})();

// Initialize after DOM is ready
KTUtil.onDOMContentLoaded(function () {
    KTDicountAdd.init();

    // Event handler for edit button
    $("#kt_ecommerce_sales_order_summary").on(
        "click",
        ".edit-discount",
        function () {
            console.log("diskon");
            const data = {
                id: $(this).attr("data-kt-o-id"),
                discount_p: $(this).attr("data-kt-discount-p"),
            };
            KTDicountAdd.edit(data);
        }
    );
});

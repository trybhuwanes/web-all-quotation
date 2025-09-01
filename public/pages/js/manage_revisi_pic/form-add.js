"use strict";
var KTDproductAdd = (function () {
    const modalElement = document.getElementById("kt_modal_addproduct"),
        formElement = modalElement.querySelector("#kt_modal_addproduct_form"),
        modal = new bootstrap.Modal(modalElement),
        submitButton = modalElement.querySelector(
            '[data-kt-discount-modal-action-type="submit"]'
        );

    return {
        init: function () {
            // Initialize cancel and close buttons
            KTGlobal().cancelForm(
                '[data-kt-discount-modal-action-type="cancel"], [data-kt-discount-modal-action-type="close"]',
                modalElement,
                () => {
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
        },

        edit: function (data) {
            // Mengisi form dengan data yang akan diedit
            $("#o-id").val(data.id);
            $("#discount").val(data.discount_p);

            // Menampilkan modal
            modal.show();
        },
    };
})();

// Initialize after DOM is ready
KTUtil.onDOMContentLoaded(function () {
    KTDproductAdd.init();

    // Event handler for edit button
    $("#kt_ecommerce_sales_order_summary").on(
        "click",
        ".edit-additional-product",
        function () {
            console.log("add produk");
            const data = {
                id: $(this).attr("data-kt-o-id"),
            };
            KTDproductAdd.edit(data);
        }
    );
});

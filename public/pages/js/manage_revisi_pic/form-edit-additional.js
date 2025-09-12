"use strict";

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("kt_modal_edit_additional_price");
    const form = document.getElementById("form-edit-additional-price");
    const inputId = document.getElementById("additional_item_id");
    const inputPrice = document.getElementById("custom_price_input");

    // Klik tombol edit → buka modal dengan data
    document.querySelectorAll(".edit-additional-price").forEach(btn => {
        btn.addEventListener("click", function () {
            let id = this.dataset.id;
            let price = this.dataset.price;

            form.action = route('pic.cart.updateAdditionalProductPrice', { id: id });
            // form.action = `/cart/update-additional-product/${id}`
            inputId.value = id;
            inputPrice.value = price;
        });
    });
});

"use strict";

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("kt_modal_edit_quantity");
    const form = document.getElementById("form-edit-quantity");
    const inputId = document.getElementById("quantity_id");
    const inputQuantity = document.getElementById("quantity_input");

    // Klik tombol edit → buka modal dengan data
    document.querySelectorAll(".edit-quantity").forEach(btn => {
        btn.addEventListener("click", function () {
            let id = this.dataset.id;
            let quantity = this.dataset.quantity;

            form.action = route('pic.cart.updateQuantity', { id: id });
            inputId.value = id;
            inputQuantity.value = quantity;
        });
    });
});

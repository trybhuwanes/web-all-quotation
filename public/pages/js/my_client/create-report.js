"use strict";

var KTFormComposeClient = (function () {
    const formElement = document.getElementById("kt_inbox_compose_form"),
        submitButton = formElement.querySelector("#kt_diskusi_submit");
        

    const submitForm = () => {

        var editorElement = document.querySelector('.ql-editor');
        const messageContent = editorElement.innerHTML;

        // Ambil nilai dari input radio
        const nextTodo = formElement.querySelector('input[name="next_todo"]:checked');
        if (!nextTodo) {
            Swal.fire({
                text: "Anda harus memilih 'Next to do' sebelum menyimpan!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "OK, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });
            return;
        }

        // Ambil nilai dari input hidden report_id
        const reportId = formElement.querySelector('input[name="report_id"]').value;

        // Kirim data ke server
        const url = formElement.getAttribute('action');
        let formData = new FormData();
        formData.append('message', messageContent);
        formData.append('next_todo', nextTodo.value);
        formData.append('report_id', reportId);

        submitButton.setAttribute("data-kt-indicator", "on");
        submitButton.disabled = true;

        console.log(formData);

        axios.post(url, formData)
            .then(({ data }) => {
                if (data.success) {
                    Swal.fire({
                        text: "Data berhasil disimpan!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Oke!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            window.location.href = '/pic/client';
                        }
                    });
                }
            })
            .catch(({ response }) => {
                console.log(response);
                // Tangani kesalahan
            })
            .finally(() => {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
            });
    };

    return {
        init: function () {
            submitButton.addEventListener("click", function (event) {
                event.preventDefault();
                submitForm();
            });
        }
    };
})();

document.addEventListener("DOMContentLoaded", function () {
    KTFormComposeClient.init();
});

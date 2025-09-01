document.getElementById('kt_modal_new_mps_form').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    let hasError = false;

    // Reset error dan border sebelumnya
    const fields = form.querySelectorAll('.required-field');
    fields.forEach(field => {
        field.classList.remove('is-invalid');
        const errorElement = document.getElementById('error-' + field.name);
        if (errorElement) {
            errorElement.style.display = 'none';
            errorElement.innerText = '';
        }
    });

    // Loop semua required field untuk validasi
    fields.forEach(field => {
        const value = field.value.trim();
        const name = field.name;
        const errorElement = document.getElementById('error-' + name);

        if (!value) {
            // Kosong
            field.classList.add('is-invalid');
            if (errorElement) {
                errorElement.innerText = `Field ${name.toUpperCase()} wajib diisi.`;
                errorElement.style.display = 'block';
            }
            hasError = true;
        } else {
            // Bisa tambah validasi custom kalau mau, contoh:
            const val = parseFloat(value);
            if (name === 'cod' && (val < 1 || val > 99999)) {
                field.classList.add('is-invalid');
                if (errorElement) {
                    errorElement.innerText = 'COD harus di antara 1 - 99999 mg/L.';
                    errorElement.style.display = 'block';
                }
                hasError = true;
            }
            if (name === 'bod' && (val < 1 || val > 99999)) {
                field.classList.add('is-invalid');
                if (errorElement) {
                    errorElement.innerText = 'BOD harus di antara 1 - 99999 mg/L.';
                    errorElement.style.display = 'block';
                }
                hasError = true;
            }
            if (name === 'tss' && (val < 1 || val > 99999)) {
                field.classList.add('is-invalid');
                if (errorElement) {
                    errorElement.innerText = 'TSS harus di antara 1 - 99999 mg/L.';
                    errorElement.style.display = 'block';
                }
                hasError = true;
            }
            if (name === 'q_flowrate' && (val < 1 || val > 99999)) {
                field.classList.add('is-invalid');
                if (errorElement) {
                    errorElement.innerText = 'Flowrate harus di antara 1 - 99999.';
                    errorElement.style.display = 'block';
                }
                hasError = true;
            }
        }
    });

    // Stop submit kalau ada error
    if (hasError) {
        return;
    }

    const submitButton = document.getElementById('kt_modal_new_mps_submit');

    // Loading
    submitButton.disabled = true;
    submitButton.querySelector('.indicator-label').style.display = 'none';
    submitButton.querySelector('.indicator-progress').style.display = 'inline-block';

    axios.post('/count', formData)
        .then(response => {
            const data = response.data.data;
            const resultContainer = document.getElementById('calculation-results-mps');

            resultContainer.innerHTML = `
                <hr>
                <div class="alert alert-success">Perhitungan berhasil!</div>
                <ul class="list-group mt-3">
                    <li class="list-group-item"><strong>Qss (Sludege Production):</strong> ${data.qss} CMD</li>
                    <li class="list-group-item"><strong>TSS Removed:</strong> ${data.tss_remove} mg/L</li>
                    <li class="list-group-item"><strong>TSS Output:</strong> ${data.tss_output} mg/L</li>
                    <li class="list-group-item"><strong>Xi Actual:</strong> ${data.xi_actual} kg DS/day</li>
                    <li class="list-group-item"><strong>Xi Actual Hourly:</strong> ${data.xi_actual_hourly} kg/ DS/hr</li>
                    <li class="list-group-item"><strong>Xr:</strong> ${data.xr} kg DS/day</li>
                    <li class="list-group-item"><strong>Xr Hourly:</strong> ${data.xr_hourly} kg DS/hr</li>
                    <li class="list-group-item"><strong>Xo:</strong> ${data.xo} kg DS/day</li>
                    <li class="list-group-item"><strong>Xo Hourly:</strong> ${data.xo_hourly} kg DS/hr</li>
                    <li class="list-group-item"><strong>Ssy - t:</strong> ${data.ssy_t} kg Cake/day</li>
                    <li class="list-group-item"><strong>Qf:</strong> ${data.qf} CMD</li>
                    <li class="list-group-item"><strong>Rekomendasi Type MPS:</strong> ${Array.isArray(data.recommended_mps) ? data.recommended_mps.join(', ') : data.recommended_mps}</li>
                    <!-- Tambahkan parameter lainnya sesuai kebutuhan -->
                </ul>
            `;
        })
        .catch(error => {
            console.error(error);
            alert("Terjadi kesalahan. Silakan coba lagi.");
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.querySelector('.indicator-label').style.display = 'inline-block';
            submitButton.querySelector('.indicator-progress').style.display = 'none';
        });
});

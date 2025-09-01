document.getElementById('kt_modal_new_fas_form').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    let hasError = false;

    // Reset semua error dan border
    const fields = form.querySelectorAll('.required-field');
    fields.forEach(field => {
        field.classList.remove('is-invalid'); // Bootstrap class untuk border merah
        const errorElement = document.getElementById('error-' + field.name);
        if (errorElement) {
            errorElement.style.display = 'none';
            errorElement.innerText = '';
        }
    });

    // Loop semua required field
    fields.forEach(field => {
        const value = field.value.trim();
        const name = field.name;
        const errorElement = document.getElementById('error-' + name);

        if (!value) {
            // Jika kosong
            field.classList.add('is-invalid');
            if (errorElement) {
                errorElement.innerText = `Field ${name} wajib diisi.`;
                errorElement.style.display = 'block';
            }
            hasError = true;
        } else {
            // Validasi spesifik per field
            if (name === 'kedalaman') {
                const val = parseFloat(value);
                if (val < 2 || val > 6) {
                    field.classList.add('is-invalid');
                    if (errorElement) {
                        errorElement.innerText = 'Kedalaman harus antara 2 sampai 6 meter.';
                        errorElement.style.display = 'block';
                    }
                    hasError = true;
                }
            }
            if (name === 'panjang') {
                const val = parseFloat(value);
                if (val < 1 || val > 140) {
                    field.classList.add('is-invalid');
                    if (errorElement) {
                        errorElement.innerText = 'Panjang maximal 140 meter(m).';
                        errorElement.style.display = 'block';
                    }
                    hasError = true;
                }
            }
            if (name === 'lebar') {
                const val = parseFloat(value);
                if (val < 1 || val > 140) {
                    field.classList.add('is-invalid');
                    if (errorElement) {
                        errorElement.innerText = 'Lebar maximal 140 meter(m).';
                        errorElement.style.display = 'block';
                    }
                    hasError = true;
                }
            }
        }
    });

    // Kalau ada error, stop submit
    if (hasError) {
        return;
    }

    const submitButton = document.getElementById('kt_modal_new_fas_submit');

    // Tampilkan loading
    submitButton.disabled = true;
    submitButton.querySelector('.indicator-label').style.display = 'none';
    submitButton.querySelector('.indicator-progress').style.display = 'inline-block';

    axios.post('/count', formData)
        .then(response => {
            const data = response.data.data;
            const resultContainer = document.getElementById('calculation-results-fas');

            resultContainer.innerHTML = `
                <hr>
                <div class="alert alert-success">Perhitungan berhasil!</div>
                <ul class="list-group mt-3">
                    <li class="list-group-item"><strong>Kedalaman:</strong> ${data.kedalaman} m</li>
                    <li class="list-group-item"><strong>Panjang:</strong> ${data.panjang} m</li>
                    <li class="list-group-item"><strong>Lebar:</strong> ${data.lebar} m</li>
                    <li class="list-group-item"><strong>Rekomendasi Type FAS:</strong> ${data.recommended_fas}</li>
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

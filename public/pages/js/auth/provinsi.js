const rawData = [
    {"11":"ACEH"},
    {"11,ACEH":"11.01,KAB. ACEH SELATAN"},
    {"11,ACEH":"11.01.01,Bakongan"},
    {"11,ACEH":"11.01.01.2001,Keude Bakongan"},
    {"11,ACEH":"11.01.01.2002,Ujong Mangki"},
    {"11,ACEH":"11.01.01.2003,Ujong Padang"},
    {"11,ACEH":"11.01.01.2004,Gampong Drien"},
    {"11,ACEH":"11.01.01.2015,Darul Ikhsan"}
];

const data = {};

// Mengonversi rawData menjadi format nested
rawData.forEach(item => {
    const key = Object.keys(item)[0]; // Ambil kunci (provinsi)
    const value = item[key].split(','); // Pisahkan kode dan nama

    const [code, name] = value;

    const [provinsiCode, provinsiName] = key.split(',');

    // Inisialisasi objek jika belum ada
    if (!data[provinsiName]) {
        data[provinsiName] = {};
    }

    // Memisahkan kabupaten/kota dan kelurahan
    if (code.startsWith('11.01')) {  // Kabupaten
        data[provinsiName][name] = [];
    } else if (code.startsWith('11.01.01')) { // Kelurahan
        const kabupaten = Object.keys(data[provinsiName]).find(kab => kab.includes('KAB. ACEH SELATAN'));
        if (kabupaten) {
            data[provinsiName][kabupaten].push(name);
        }
    }
});

// Menampilkan hasil
console.log(data);

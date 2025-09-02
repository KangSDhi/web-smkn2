export const convertIsoDateTimeToDateString = (isoDateTime) => {
    // Buat Date object dari string
    const date = new Date(isoDateTime);

    // Ambil bagian-bagian tanggal
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // bulan mulai dari 0
    const year = date.getFullYear();

    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');

    // Gabungkan jadi format dd-mm-yyyy hh:mm:ss
    return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
}

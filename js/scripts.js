document.addEventListener("DOMContentLoaded", function () {
    const editLinks = document.querySelectorAll(".edit-btn");

    editLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah navigasi default
            const row = this.closest("tr");
            const cells = row.querySelectorAll("td");
            const isEditing = row.classList.contains("editing");

            if (!isEditing) {
                row.classList.add("editing"); 
                this.textContent = "Simpan";

                cells.forEach((cell, index) => {
                    if (index < cells.length - 1) { // Abaikan kolom aksi
                        const currentValue = cell.textContent.trim();
                        cell.innerHTML = `<input type="text" value="${currentValue}" class="edit-input">`;
                    }
                });
            } else {
                row.classList.remove("editing");
                this.textContent = "Ubah";

                const data = {};
                cells.forEach((cell, index) => {
                    if (index < cells.length - 1) { // Abaikan kolom aksi
                        const input = cell.querySelector(".edit-input");
                        if (input) {
                            const columnName = cell.getAttribute("data-column");
                            data[columnName] = input.value.trim();
                            cell.textContent = input.value.trim();
                        }
                    }
                });

                // Tambahkan ID baris ke data
                data.ID = row.getAttribute("data-ID");
                data.action = 'update';

                console.log("Mengirim data ke server:", data);

                // Kirim data ke server
                fetch('admin-dashboard.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(data).toString(),
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        alert('Data berhasil diperbarui');
                    } else {
                        alert('Gagal memperbarui data: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
});

// Fungsi untuk menambah angka
function increaseValue() {
    const counter = document.getElementById("counter");
    let currentValue = parseInt(counter.textContent, 10); // Ambil nilai saat ini dan ubah ke angka
    counter.textContent = currentValue + 1; // Tambahkan 1 ke nilai saat ini
}

// Fungsi untuk mengurangi angka
function decreaseValue() {
    const counter = document.getElementById("counter");
    let currentValue = parseInt(counter.textContent, 10); // Ambil nilai saat ini dan ubah ke angka
    if (currentValue > 0) {
        counter.textContent = currentValue - 1; // Kurangi 1 jika nilai lebih besar dari 0
    }
};


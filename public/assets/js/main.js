const BASE_URL = 'http://localhost:8080/'
const modalHapusElement = document.getElementById('modalHapus')
const modalInfoElement = document.getElementById('modalInfo')
const modalInfo = new bootstrap.Modal(modalInfoElement)
const modalHapus = new bootstrap.Modal(modalHapusElement)
if (modalHapusElement && modalInfoElement) {

    // Tambahkan event listener untuk event 'hidden.bs.modal'
    modalInfoElement.addEventListener('hidden.bs.modal', function (event) {
        // Refresh halaman
        window.location.reload();
    });

    modalHapusElement.addEventListener('show.bs.modal', async (event) => {
        const button = event.relatedTarget
        const id = button.getAttribute('data-bs-id')
        const btnPositive = document.getElementById('modal-btn-positive');
        btnPositive.addEventListener('click', async function () {
            try {
                const response = await fetch(BASE_URL + 'api/produk/delete/' + id, {
                    method: "DELETE"
                });
                const result = await response.json();
                if (result) {
                    modalInfoElement.querySelector('h1').innerText = 'Berhasil menghapus produk!';
                    modalInfoElement.querySelector('div.modal-body').innerText = 'Telah berhasil menghapus produk ' + (result.nama ?? '');
                } else {
                    modalInfoElement.querySelector('h1').innerText = 'Gagal menghapus produk!';
                }
                modalInfo.show();
            } catch (e) {
                modalInfoElement.querySelector('h1').innerText = 'Terjadi kendala pada aplikasi';
                modalInfoElement.querySelector('div.modal-body').innerText = 'Terjadi kendala pada aplikasi, mohon hubungi admin';
                modalInfo.show();
            } finally {
                modalHapus.hide();
            }
        })
    })


}
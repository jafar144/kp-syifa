// const status = document.getElementById('status_chip').innerHTML;
document.addEventListener("DOMContentLoaded", function (event) {
    const statusChip = document.querySelectorAll('.status_chip');
    statusChip.forEach(status => {
        if (status.innerHTML == 'Menunggu') status.classList.add('Menunggu');
        else if (status.innerHTML == 'Selesai') status.classList.add('Selesai');
        else if (status.innerHTML == 'Berlangsung') status.classList.add('Berlangsung');
    })
});
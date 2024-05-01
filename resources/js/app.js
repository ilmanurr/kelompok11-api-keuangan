// Setelah menerima respons JSON dari server
fetch('/api/expenses', {
    method: 'POST',
    body: formData, // FormData yang berisi data pengeluaran baru
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        ...formData,
        from_web: true // Tandai bahwa permintaan berasal dari halaman web
    })
})
.then(response => response.json())
.then(data => {
    // Redirect pengguna ke halaman pengeluaran
    window.location.href = data.redirect;
})
.catch(error => {
    console.error('Error:', error);
});

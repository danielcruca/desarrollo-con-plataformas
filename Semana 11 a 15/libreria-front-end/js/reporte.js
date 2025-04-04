document.addEventListener('DOMContentLoaded', () => {
alert("hola")
fetchBooks()
});


const API_URL = "http://localhost/libreria/api/v1/public/index.php";

function fetchBooks() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', API_URL+'/libros', true);
    xhr.onload = function () {
        if (this.status === 200) {
            const cleanedText = this.responseText.replace(/^\uFEFF/, '').trim();
            try {
                const books = JSON.parse(cleanedText);
                const tbody = document.querySelector('#libro-table tbody');
                tbody.innerHTML = ''; // Limpiar contenido previo
                books.forEach(book => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${book.titulo}</td>
                        <td>$${book.precio}</td>
                        <td>${book.cantidad_stock}</td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (e) {
                console.error('Error parsing JSON:', e);
            }
        } else {
            console.error('Error fetching books:', this.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Request error...');
    };
    xhr.send();
}



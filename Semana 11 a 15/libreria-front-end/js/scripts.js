// Definicion de constante
// Ubicacion de la API.


document.addEventListener('DOMContentLoaded', () => {


    // eventos para el menu de navegacion
    document.getElementById('link-books').addEventListener('click', () => mostrarSeccion('libros'));
    document.getElementById('link-transactions').addEventListener('click', () => mostrarSeccion('transactions'));
    document.getElementById('link-authors').addEventListener('click', () => mostrarSeccion('autores'));
    
    obtenerTodosLosAutores();
    obtenerTodosLosLibros();
   // fetchTransactions();

    document.getElementById('agregar-libro-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = this;
        const data = {
            titulo: form.titulo.value,
            id_autor: parseInt(form.id_autor.value),
            precio: parseFloat(form.precio.value),
            cantidad_stock: parseInt(form.cantidad_stock.value)
        };
        guardarLibro(data);
        form.reset();
    });

    document.getElementById('update-book-form').addEventListener('submit', function(event) {

        event.preventDefault();
        const form = this;
        console.log(form.id_libro.value);
        const data = {
            id_libro: parseInt(form.id_libro.value),
            titulo: form.titulo.value,
            id_autor: parseInt(form.id_autor.value),
            precio: parseFloat(form.precio.value),
            cantidad_stock: parseInt(form.cantidad_stock.value)
        };
        actualizarLibro(data);
        form.reset();
        form.style.display = 'none';
    });

    
});


function mostrarSeccion(section) {
    document.getElementById('libros-section').style.display = 'none';
    document.getElementById('transactions-section').style.display = 'none';
    document.getElementById('autores-section').style.display = 'none';
    console.log(section);
    if (section === 'libros') {
        document.getElementById('libros-section').style.display = 'block';
    } else if (section === 'transactions') {
        document.getElementById('transactions-section').style.display = 'block';
    } else if (section === 'autores') {
        document.getElementById('autores-section').style.display = 'block';
    }
}

function obtenerTodosLosAutores() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', API_URL + '/autores', true);
    xhr.onload = function () {
        if (this.status === 200) {
            const cleanedText = this.responseText.replace(/^\uFEFF/, '').trim();
            try {
                const authors = JSON.parse(cleanedText);
                const tbody = document.querySelector('#author-table tbody');
                tbody.innerHTML = ''; 
                authors.forEach(author => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${author.nombre}</td>
                        <td>${author.apellido}</td>
                        <td>${author.nacionalidad}</td>
                    `;
                    tbody.appendChild(tr);
                });

                // Llenar el select de autores en los formularios
                const authorSelects = document.querySelectorAll('select[name="id_autor"]');
                authorSelects.forEach(select => {
                    select.innerHTML = '<option value="">Selecciona un autor</option>'; // Opción predeterminada
                    authors.forEach(author => {
                        const option = document.createElement('option');
                        option.value = author.id_autor;
                        option.textContent = `${author.nombre} ${author.apellido}`;
                        select.appendChild(option);
                    });
                });

            } catch (e) {
                console.error('Error parsing JSON:', e);
            }
        } else {
            console.error('Error fetching authors:', this.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Request error...');
    };
    xhr.send();
}











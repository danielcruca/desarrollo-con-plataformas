const API_URL = "http://localhost/libreria/api/v1/public/index.php";


function obtenerTodosLosLibros() {

    const xhr = new XMLHttpRequest();
    xhr.open('GET', API_URL+'/libros', true);
    //     xhr.setRequestHeader('Authorization', 'Bearer 0cc175b9c0f1b6a831c399e269772661');



    xhr.onload = function () {

        // Nos conectamos a la API por el endpoint usando get
        // si el status 200 significa que esta bien.
        // Leemos la respuesta de la api. 
        // Selecionas la tabla  #libro-table
        // creamos logica para tomar todos esos datos y adjuntarlos(append) a #libro-table
        if (this.status === 200) {


            console.log("Respuesta: " + this.responseText);
           // console.log(this.responseText);
            const cleanedText = this.responseText.replace(/^\uFEFF/, '').trim();
           
           
           
           
           
           
            try {
                const libros = JSON.parse(cleanedText);
                document.querySelector('#libro-table tbody').innerHTML = ''; // Limpiar de la tabla primero.
                console.log(libros);

                libros.forEach(book => {
                    console.log("Autor: "+ book.autor
                    )
                });
                libros.forEach(libro => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${libro.titulo}</td>
                         <td>${libro.autor}</td>
                        <td>$${libro.precio}</td>
                        <td>${libro.cantidad_stock}</td>
                        <td>
                         <button onclick="mostrarFormActualizarLibro(${libro.id_libro}, '${libro.titulo}', ${libro.id_autor}, ${libro.precio}, ${libro.cantidad_stock})">Actualizar</button>
                         <button onclick="eliminarLibro(${libro.id_libro})">Eliminar</button>
                        </td>
                    `;
                    document.querySelector('#libro-table tbody').appendChild(tr);
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


function guardarLibro(data) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST',  API_URL+'/libros', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
 //     xhr.setRequestHeader('Authorization', 'Bearer 0cc175b9c0f1b6a831c399e269772661');

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Libro guardado exitosamente');
            obtenerTodosLosLibros(); // Actualizar lista de libros después de guardar
        } else {
            console.error('Error al guardar el libro:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud');
    };
    xhr.send(JSON.stringify(data));
}


function actualizarLibro(data) {
    const xhr = new XMLHttpRequest();
    xhr.open('PUT', API_URL + '/libros?id=' + data.id_libro, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    //xhr.setRequestHeader('Authorization', 'Bearer 0cc175b9c0f1b6a831c399e269772661');

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Libro actualizado exitosamente');
            obtenerTodosLosLibros(); // Actualizar lista de libros después de actualizar
        } else {
            console.error('Error al actualizar el libro:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud');
    };
    xhr.send(JSON.stringify(data));
}


function eliminarLibro(bookId) {
    const xhr = new XMLHttpRequest();
    xhr.open('DELETE', API_URL + '/libros?id=' + bookId, true);
    //xhr.setRequestHeader('Authorization', 'Bearer 0cc175b9c0f1b6a831c399e269772661');

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Libro eliminado exitosamente');
            obtenerTodosLosLibros(); // Actualizar lista de libros después de eliminar
        } else {
            console.error('Error al eliminar el libro:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud');
    };
    xhr.send();
}

/* Metodo que muestra el formulario para actualizar con la informacion de los libros.*/

function mostrarFormActualizarLibro(id_libro, titulo, id_autor, precio, cantidad_stock) {

    alert("Mostrar formulario para actualizar")
    console.log(id_autor)
    const form = document.getElementById('update-book-form');
    form.querySelector('#update-id_libro').value = id_libro;
    form.querySelector('#update-titulo').value = titulo;
    form.querySelector('#update-id_autor').value = id_autor;
    form.querySelector('#update-precio').value = precio;
    form.querySelector('#update-cantidad_stock').value = cantidad_stock;
    form.style.display = 'block';
}

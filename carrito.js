const carrito = [];
const carritoLista = document.getElementById('carrito-lista');
const carritoTotal = document.getElementById('carrito-total');
const carritoContenedor = document.getElementById('carrito');
const carritoBoton = document.querySelector('.carrito-boton');
const alertaContenedor = document.getElementById('alerta-contenedor');

// Mostrar/Ocultar carrito al hacer clic en el botón del navbar
carritoBoton.addEventListener('click', () => {
    carritoContenedor.style.display = (carritoContenedor.style.display === 'block') ? 'none' : 'block';
});

// Cuando hagan click en "Agregar al carrito"
document.querySelectorAll('.buy').forEach(boton => {
    boton.addEventListener('click', (e) => {
        e.preventDefault();
        const preview = boton.closest('.preview');
        const nombre = preview.querySelector('h3').textContent;
        const precioTexto = preview.querySelector('p:nth-of-type(2)').textContent;
        const precio = parseInt(precioTexto.replace(/[$.]/g, ''));

        carrito.push({ nombre, precio });
        actualizarCarrito();
        mostrarAlerta(`${nombre} agregado al carrito 🛒`);
    });
});

// Función para actualizar el carrito
function actualizarCarrito() {
    carritoLista.innerHTML = '';
    let total = 0;

    carrito.forEach((producto, index) => {
        const li = document.createElement('li');
        li.innerHTML = `
            ${producto.nombre} - $${producto.precio.toLocaleString()}
            <button class="btn-eliminar" data-index="${index}">❌</button>
        `;
        carritoLista.appendChild(li);
        total += producto.precio;
    });

    carritoTotal.textContent = `Total: $${total.toLocaleString()}`;

    // Botones eliminar individuales
    document.querySelectorAll('.btn-eliminar').forEach(boton => {
        boton.addEventListener('click', (e) => {
            const index = e.target.getAttribute('data-index');
            carrito.splice(index, 1);
            actualizarCarrito();
        });
    });
}

// Botón vaciar carrito
document.getElementById('vaciar-carrito').addEventListener('click', () => {
    carrito.length = 0;
    actualizarCarrito();
});

// Función para mostrar alerta bonita
function mostrarAlerta(mensaje) {
    const alerta = document.createElement('div');
    alerta.className = 'alerta';
    alerta.textContent = mensaje;
    alertaContenedor.appendChild(alerta);

    setTimeout(() => {
        alerta.remove();
    }, 3000); // Desaparece en 3 segundos
}

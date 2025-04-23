let previewContainer = document.querySelector('.products-preview');
let previewBoxes = document.querySelectorAll('.products-preview .preview');

document.querySelectorAll('.btn1').forEach(btn => {
    btn.addEventListener('click', () => {
        const productCard = btn.closest('[data-name]');
        const name = productCard?.getAttribute('data-name');

        previewContainer.style.display = 'flex';

        previewBoxes.forEach(preview => {
            const target = preview.getAttribute('data-target');
            if (name === target) {
                preview.classList.add('active');
            } else {
                preview.classList.remove('active');
            }
        });
    });
});

document.querySelectorAll('.fa-times').forEach(closeBtn => {
    closeBtn.addEventListener('click', () => {
        previewContainer.style.display = 'none';
        previewBoxes.forEach(preview => preview.classList.remove('active'));
    });
});

const carrito = [];
const carritoLista = document.getElementById('carrito-lista');
const carritoTotal = document.getElementById('carrito-total');
const carritoContenedor = document.getElementById('carrito');
const carritoBoton = document.querySelector('.carrito-boton');
const alertaContenedor = document.getElementById('alerta-contenedor');

carritoBoton.addEventListener('click', () => {
    carritoContenedor.style.display = (carritoContenedor.style.display === 'block') ? 'none' : 'block';
});

document.querySelectorAll('.buy').forEach(boton => {
    boton.addEventListener('click', (e) => {
        e.preventDefault();
        const preview = boton.closest('.preview');
        const nombre = preview.querySelector('h3').textContent;
        const precioTexto = preview.querySelector('p:nth-of-type(2)').textContent;
        const precio = parseInt(precioTexto.replace('$', '').replace('.', ''));

        carrito.push({ nombre, precio });
        actualizarCarrito();
        mostrarAlerta(`${nombre} agregado al carrito 🛒`);
    });
});

function actualizarCarrito() {
    carritoLista.innerHTML = '';
    let total = 0;

    carrito.forEach((producto, index) => {
        const li = document.createElement('li');
        li.innerHTML = `
            ${producto.nombre} - $${producto.precio}
            <button class="btn-eliminar" data-index="${index}">❌</button>
        `;
        carritoLista.appendChild(li);
        total += producto.precio;
    });

    carritoTotal.textContent = `Total: $${total.toLocaleString()}`;

    const contadorCarrito = document.getElementById('contador-carrito');
    contadorCarrito.textContent = carrito.length;

    document.querySelectorAll('.btn-eliminar').forEach(boton => {
        boton.addEventListener('click', (e) => {
            const index = e.target.getAttribute('data-index');
            carrito.splice(index, 1);
            actualizarCarrito();
        });
    });
}

document.getElementById('vaciar-carrito').addEventListener('click', () => {
    carrito.length = 0;
    actualizarCarrito();
});

function mostrarAlerta(mensaje) {
    const alerta = document.createElement('div');
    alerta.className = 'alerta';
    alerta.textContent = mensaje;
    alertaContenedor.appendChild(alerta);

    setTimeout(() => {
        alerta.remove();
    }, 3000); // Desaparece en 3 segundos
}

document.getElementById('pagar-carrito').addEventListener('click', () => {
    if (carrito.length === 0) {
        alert('Tu carrito está vacío 🛒');
    } else {
        alert('¡Gracias por tu compra! 🧼✨');
        carrito.length = 0;
        actualizarCarrito();
        carritoContenedor.style.display = 'none';
    }
});

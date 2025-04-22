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

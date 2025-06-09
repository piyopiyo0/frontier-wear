document.querySelectorAll('.pageContent__accordion-top').forEach(header => {
    header.addEventListener('click', () => {
        const parentItem = header.closest('.pageContent__accordion-item');
        const isActive = parentItem.classList.contains('active');
        document.querySelectorAll('.pageContent__accordion-item').forEach(item => {
            item.classList.remove('active');
        });
        if (!isActive) {
            parentItem.classList.add('active');
        }
    });
});
document.querySelectorAll('.pageContent__product-size input').forEach(input => {
    input.addEventListener('change', () => {
        const buttonContainer = document.querySelector('.pageContent__product-buttons');
        if (input.getAttribute('data-sold') === 'yes') {
            buttonContainer.classList.add('solded');
        } else {
            buttonContainer.classList.remove('solded');
        }
    });
});

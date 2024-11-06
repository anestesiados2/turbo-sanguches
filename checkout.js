document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('checkout-form');
    const modal = document.getElementById('confirmation-modal');
    const closeButton = document.querySelector('.close-button');
    const phoneInput = document.getElementById('phone');
    const countryCodeSelect = document.getElementById('country-code');

    // Función para mostrar el modal
    function showModal() {
        modal.style.display = 'block';
    }

    // Función para ocultar el modal y redirigir a la página principal
    function hideModal() {
        modal.style.display = 'none';
        window.location.href = 'index.php'; // Ajusta la ruta según tu estructura
    }

    form.addEventListener('submit', event => {
        event.preventDefault(); // Prevenir el envío real del formulario
        showModal(); // Mostrar el modal
    });

    closeButton.addEventListener('click', hideModal);

    window.addEventListener('click', event => {
        if (event.target === modal) {
            hideModal();
        }
    });

    // Inicializar el campo de teléfono con el prefijo seleccionado
    const updatePhoneInput = () => {
        const selectedPrefix = countryCodeSelect.value;
        const currentValue = phoneInput.value.replace(/^\+\d+/, ''); // Eliminar prefijo actual
        phoneInput.value = selectedPrefix + currentValue;
    };

    // Actualizar el campo de teléfono cuando el prefijo cambia
    countryCodeSelect.addEventListener('change', updatePhoneInput);

    phoneInput.addEventListener('input', function() {
        const selectedPrefix = countryCodeSelect.value;
        const currentValue = this.value.replace(/[^0-9+]/g, '');
        this.value = currentValue.startsWith(selectedPrefix)
            ? currentValue.substring(0, 15)
            : selectedPrefix + currentValue.substring(selectedPrefix.length, 15);
    });

    // Formatear el número de tarjeta
    document.getElementById('card-number').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').replace(/(.{4})/g, '$1 ').trim();
    });

    // Formatear la fecha de expiración
    document.getElementById('expiry-date').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').replace(/(.{2})/, '$1/').trim();
    });

    // Limitar el CVV a solo números
    document.getElementById('cvv').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });
});

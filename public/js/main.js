document.addEventListener('DOMContentLoaded', function() {
    const bookingForm = document.getElementById('booking-form');

    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const formMessage = document.getElementById('form-message');

            // Basic validation
            let valid = true;
            for (let field of formData.entries()) {
                if (form.querySelector(`[name="${field[0]}"]`).required && !field[1]) {
                    valid = false;
                    break;
                }
            }

            if (!valid) {
                formMessage.textContent = 'Please fill out all required fields.';
                formMessage.style.color = 'red';
                return;
            }

            fetch('booking_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formMessage.textContent = data.message;
                    formMessage.style.color = 'green';
                    form.reset();
                } else {
                    formMessage.textContent = data.message;
                    formMessage.style.color = 'red';
                }
            })
            .catch(error => {
                formMessage.textContent = 'An error occurred. Please try again.';
                formMessage.style.color = 'red';
            });
        });
    }
});
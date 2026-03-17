export function initContactForm() {
    const form = document.querySelector('#contactForm');
    const messageDiv = document.querySelector('#formMessage');

    if (!form || !messageDiv) {
        return;
    }

    function hideMessage() {
        messageDiv.classList.add('hidden');
    }

    async function handleSubmit(event) {
        event.preventDefault();

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('includes/send.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            const result = await response.json();

            messageDiv.classList.remove('hidden', 'success', 'error');
            messageDiv.classList.add(result.status);
            messageDiv.textContent = result.message;

            if (result.status === 'success') {
                form.reset();
                setTimeout(hideMessage, 5000);
            }
        } catch (error) {
            messageDiv.classList.remove('hidden', 'success');
            messageDiv.classList.add('error');
            messageDiv.textContent = 'Failed to send message. Please try again.';
            console.error('Form error:', error);
        }
    }

    form.addEventListener('submit', handleSubmit);
}
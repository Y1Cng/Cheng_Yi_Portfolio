// js/modules/formModule.js (ES6 Module)
export function initContactForm() {
    const form = document.getElementById('contactForm');
    const messageDiv = document.getElementById('formMessage');

    // Terminate if form or message container doesn't exist
    if (!form || !messageDiv) return;

    // Listen for form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault(); // Prevent traditional form submission

        // Get form data
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            // AJAX request (Fetch API)
            const response = await fetch('includes/send.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            const result = await response.json();

            // Display message
            messageDiv.classList.remove('hidden', 'success', 'error');
            messageDiv.classList.add(result.status);
            messageDiv.textContent = result.message;

            // Reset form on success and hide message after 5 seconds
            if (result.status === 'success') {
                form.reset();
                setTimeout(() => {
                    messageDiv.classList.add('hidden');
                }, 5000);
            }

        } catch (error) {
            // Handle network errors
            messageDiv.classList.remove('hidden', 'success');
            messageDiv.classList.add('error');
            messageDiv.textContent = "Failed to send message. Please try again.";
            console.error('Form error:', error);
        }
    });
}
const ticketSelect = document.querySelector('#ticket-select');
    const disputeTicketInput = document.querySelector('#dispute-ticket-id');
    const disputeBtn = document.querySelector('#dispute-btn');
    const disputeForm = document.querySelector('#dispute-form');
    const payForm = document.querySelector('#pay-form');

    // Pay form validation
    payForm.addEventListener('submit', (e) => {
        if (!ticketSelect.value) {
            e.preventDefault();
            alert('Please select a ticket first.');
        }
    });

    // Update dispute button state
    const updateDisputeButton = () => {
        const selectedOption = ticketSelect.selectedOptions[0];
        if (!selectedOption || selectedOption.value === '') {
            disputeBtn.disabled = true;
            return;
        }

        const lockDispute = selectedOption.dataset.lockDispute === 'true';
        disputeBtn.disabled = lockDispute;

        // Optional: change tooltip to show reason
        disputeBtn.title = lockDispute ? 'You cannot dispute this ticket' : '';
    };

    // Handle dispute submission
    disputeBtn.addEventListener('click', (e) => {
        const selectedOption = ticketSelect.selectedOptions[0];
        if (!selectedOption || selectedOption.value === '' || disputeBtn.disabled) {
            alert('You cannot file a dispute for this ticket.');
            e.preventDefault();
            return;
        }

        disputeTicketInput.value = selectedOption.value;
        disputeForm.submit();
    });

    // Listen for changes in selection
    ticketSelect.addEventListener('change', updateDisputeButton);

    // Initialize on page load
    updateDisputeButton();
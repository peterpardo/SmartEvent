const addEventForm = document.getElementById('addEventForm');
const addEventBtn = document.getElementById('addEventBtn');
const eventName = document.getElementById('eventName');
const eventDesc = document.getElementById('eventDesc');
const eventDate = document.getElementById('eventDate');
const addEventModal = document.getElementById('addEventModal');

addEventModal.addEventListener('show.bs.modal', e => {
    let button = e.relatedTarget;
    let action = button.getAttribute('data-bs-action');

    if(action == 'update') {
        // Get event id
        let eventId = button.getAttribute('data-bs-event-id');
        
        // Set event details
        eventName.value = button.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
        eventDesc.value = button.parentElement.parentElement.parentElement.parentElement.children[1].innerText;
        eventDate.value = button.parentElement.parentElement.parentElement.parentElement.children[2].innerText;

        // Set form attribute
        addEventForm.setAttribute('action', `/edit-event/${eventId}`);
    } else {
        // Set event details
        eventName.value = '';
        eventDesc.value = '';
        eventDate.value = '';

        // Set form attribute
        addEventForm.setAttribute('action', '/add-event');
    }
});

addEventBtn.addEventListener('click', (e) => {
    e.preventDefault();

    // Validations
    if(eventName.value === '') {
        let errorMsg = eventName.parentElement.querySelector('.invalid-feedback');
        eventName.classList.add('is-invalid');
        errorMsg.innerText = "Event name is required";
    } else {
        eventName.classList.remove('is-invalid');
    } 
    
    if (eventDesc.value == '') {
        let errorMsg = eventDesc.parentElement.querySelector('.invalid-feedback');
        eventDesc.classList.add('is-invalid');
        errorMsg.innerText = "Event description is required";
    } else {
        eventDesc.classList.remove('is-invalid');
    }

    if (eventDate.value == '') {
        let errorMsg = eventDate.parentElement.querySelector('.invalid-feedback');
        eventDate.classList.add('is-invalid');
        errorMsg.innerText = "Event Date is required";
    } else {
        eventDate.classList.remove('is-invalid');
    }

    // Submit form
    if(eventName.value !== '' && eventDesc.value !== '' && eventDate.value !== '') {
        addEventForm.submit();
    }

});
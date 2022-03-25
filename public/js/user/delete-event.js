const deleteEventModal = document.getElementById('deleteEventModal')
const deleteEventForm = document.getElementById('deleteEventForm');
const deleteEventBtn = document.getElementById('deleteEventBtn');

deleteEventModal.addEventListener('show.bs.modal', function (event) {
  let button = event.relatedTarget;
  let eventId = button.getAttribute('data-bs-event-id');

  deleteEventForm.setAttribute('action', `/delete-event/${eventId}`);
});

deleteEventBtn.addEventListener('click', e => {
    e.preventDefault();

    deleteEventForm.submit();
});
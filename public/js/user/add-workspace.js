const submitBtn = document.getElementById('submitBtn');
const addWorkspaceForm = document.getElementById('addWorkspaceForm');
const eventName = document.getElementById('name');

submitBtn.addEventListener('click', e => {
    e.preventDefault();

    if(eventName.value === '') {
        const errorMsg = eventName.parentElement.querySelector('.invalid-feedback');
        eventName.classList.add('is-invalid');
        errorMsg.innerText = "Event name is required";
    } else {
        eventName.classList.remove('is-invalid');
        addWorkspaceForm.submit();
    }
}); 
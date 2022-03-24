const createTaskForm = document.getElementById('createTaskForm');
const submitTaskFormBtn = document.getElementById('submitTaskFormBtn');
const addTaskModal = document.getElementById('addTaskModal');
const taskName = document.getElementById('taskName');
const taskDescription = document.getElementById('taskDescription');

addTaskModal.addEventListener('show.bs.modal', e => {
    // Button that triggered the modal
    let button = e.relatedTarget;

    // modify action attribute of form
    let listId = button.getAttribute('data-bs-list-id');
    createTaskForm.setAttribute('action', `/create-task/${listId}`);

    submitTaskFormBtn.addEventListener('click', e => {
        e.preventDefault();

        // Validations
        if(taskName.value === '') {
            let errorMsg = taskName.parentElement.querySelector('.invalid-feedback');
            taskName.classList.add('is-invalid');
            errorMsg.innerText = "Task name is required";
        } else {
            taskName.classList.remove('is-invalid');
        } 
        
        if (taskDescription.value == '') {
            let errorMsg = taskDescription.parentElement.querySelector('.invalid-feedback');
            taskDescription.classList.add('is-invalid');
            errorMsg.innerText = "Task description is required";
        } else {
            taskDescription.classList.remove('is-invalid');
        }

        // Submit form
        if(taskName.value !== '' && taskDescription.value !== '') {
            createTaskForm.submit();
        }
    });
});
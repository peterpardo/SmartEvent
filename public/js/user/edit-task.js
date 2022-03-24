const editTaskForm = document.getElementById('editTaskForm');
const submitTaskFormBtn = document.getElementById('submitTaskFormBtn');
const editTaskModal = document.getElementById('editTaskModal');
const taskName = document.getElementById('taskName');
const taskDescription = document.getElementById('taskDescription');

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
        editTaskForm.submit();
    }
});

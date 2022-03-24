const deleteTaskForm = document.getElementById('deleteTaskForm');
const confirmTaskDeleteBtn = document.getElementById('confirmTaskDeleteBtn');
const deleteTaskModal = document.getElementById('deleteTaskModal');

confirmTaskDeleteBtn.addEventListener('click', e => {
    e.preventDefault();
    deleteTaskForm.submit();
});



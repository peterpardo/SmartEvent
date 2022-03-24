const deleteBtn = document.getElementById('confirmWorkspaceDelete');
const deleteWorkspaceForm = document.getElementById('deleteWorkspaceForm');

deleteBtn.addEventListener('click', e => {
    e.preventDefault();

    deleteWorkspaceForm.submit();
});

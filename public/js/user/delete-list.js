const deleteListForm = document.getElementById('deleteListForm');
const confirmListDeleteBtn = document.getElementById('confirmListDeleteBtn');
const deleteListModal = document.getElementById('deleteListModal');

deleteListModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    let button = event.relatedTarget

    // modify action attribute of form
    let listId = button.getAttribute('data-bs-list-id')
    deleteListForm.setAttribute('action', `/delete-list/${listId}`);

    confirmListDeleteBtn.addEventListener('click', e => {
        e.preventDefault();
        deleteListForm.submit();
    });

  
});

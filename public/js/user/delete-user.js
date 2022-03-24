const deleteBtns = document.querySelectorAll('.deleteBtns');
const deleteForm = document.getElementById('deleteForm');

deleteBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        let userId = e.target.dataset.userId;
        deleteForm.setAttribute('action', `/delete-user/${userId}`)
    });
});
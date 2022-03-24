const moveTaskForm = document.getElementById('moveTaskForm');
const list = document.getElementById('list');
const moveTaskFormBtn = document.getElementById('moveTaskFormBtn');

moveTaskFormBtn.addEventListener('click', e => {
    e.preventDefault();

    if(list.value === '') {
        const errorMsg = list.parentElement.querySelector('.invalid-feedback');
        list.classList.add('is-invalid');
        errorMsg.innerText = "A list is required";
    } else {
        list.classList.remove('is-invalid');
        moveTaskForm.submit();
    }
});
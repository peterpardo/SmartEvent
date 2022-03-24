const createListForm = document.getElementById('createListForm');
const listName = document.getElementById('listName');
const submitListFormBtn = document.getElementById('submitListFormBtn');

submitListFormBtn.addEventListener('click', (e) => {
    e.preventDefault();

    if(listName.value === '') {
        const errorMsg = listName.parentElement.querySelector('.invalid-feedback');
        listName.classList.add('is-invalid');
        errorMsg.innerText = "List name is required";
    } else {
        listName.classList.remove('is-invalid');
        createListForm.submit();
    }
})
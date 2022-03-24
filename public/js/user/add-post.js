const addPostForm = document.getElementById('addPostForm');
const comment = document.getElementById('comment');

addPostForm.addEventListener('submit', e => {
    e.preventDefault();

    if(comment.value === '') {
        const errorMsg = comment.parentElement.querySelector('.invalid-feedback');
        comment.classList.add('is-invalid');
        errorMsg.innerText = "A comment is required";
    } else {
        comment.classList.remove('is-invalid');
        addPostForm.submit();
    }
});
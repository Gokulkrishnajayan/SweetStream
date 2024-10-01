document.addEventListener("DOMContentLoaded", function () {
    const editBtn = document.getElementById('edit-btn');
    const saveBtn = document.getElementById('save-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const formFields = document.querySelectorAll('.profile-form input, .profile-form textarea');

    editBtn.addEventListener('click', function () {
        formFields.forEach(field => field.disabled = false);
        editBtn.style.display = 'none';
        saveBtn.style.display = 'inline-block';
        cancelBtn.style.display = 'inline-block';
    });

    saveBtn.addEventListener('click', function () {
        // Add your save logic here
        formFields.forEach(field => field.disabled = true);
        editBtn.style.display = 'inline-block';
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
    });

    cancelBtn.addEventListener('click', function () {
        formFields.forEach(field => field.disabled = true);
        editBtn.style.display = 'inline-block';
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
    });
});
document.getElementById('ticketForm').addEventListener('submit', function (e) {
    e.preventDefault();

    clearErrors();

    var form = e.target;
    var btn = document.getElementById('submitBtn');
    var data = new FormData();
    data.append('name', form.name.value);
    data.append('phone', form.phone.value);
    data.append('email', form.email.value);
    data.append('subject', form.subject.value);
    data.append('body', form.body.value);

    var fileInput = form.querySelector('input[type="file"]');
    if (fileInput && fileInput.files.length > 0) {
        for (var i = 0; i < fileInput.files.length; i++) {
            data.append('files[]', fileInput.files[i]);
        }
    }

    btn.disabled = true;
    btn.textContent = 'Надсилання...';

    fetch('/api/tickets', {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: data,
    })
    .then(function (response) {
        return response.json().then(function (json) {
            return { status: response.status, body: json };
        });
    })
    .then(function (result) {
        if (result.status === 201) {
            form.style.display = 'none';
            show('successMsg');
        } else if (result.status === 422) {
            showFieldErrors(result.body.errors);
        } else {
            showError(result.body.message || 'Щось пішло не так. Спробуйте пізніше.');
        }
    })
    .catch(function () {
        showError('Помилка з\'єднання. Перевірте інтернет.');
    })
    .finally(function () {
        btn.disabled = false;
        btn.textContent = 'Надіслати';
    });
});

function clearErrors() {
    document.querySelectorAll('.field-error').forEach(function (el) { el.textContent = ''; });
    document.getElementById('errorMsg').style.display = 'none';
}

function showFieldErrors(errors) {
    for (var field in errors) {
        var el = document.getElementById('error-' + field);
        if (el) el.textContent = errors[field][0];
    }
}

function showError(msg) {
    var el = document.getElementById('errorMsg');
    el.textContent = msg;
    show('errorMsg');
}

function show(id) {
    document.getElementById(id).style.display = 'block';
}
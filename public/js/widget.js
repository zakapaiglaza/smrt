document.getElementById('ticketForm').addEventListener('submit', function (e) {
    e.preventDefault();

    clearErrors();

    var form = e.target;
    var btn = document.getElementById('submitBtn');
    var data = {
        name: form.name.value,
        phone: form.phone.value,
        email: form.email.value,
        subject: form.subject.value,
        body: form.body.value,
    };

    btn.disabled = true;
    btn.textContent = 'Надсилання...';

    fetch('/api/tickets', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(data),
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
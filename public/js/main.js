function ajaxRequest(url, method, data, callback) {
    fetch(url, {
        method: method,
        body: data
    })
        .then(function (response) {
            if (!response.ok) {
                //TODO Парсимо JSON з помилками
                throw new Error('Помилка при запиті ' + response.status);
            }
            const contentType = response.headers.get('Content-Type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else if (contentType && contentType.includes('text/html')) {
                return response.text();
            }
            throw new Error('Невідомий тип даних');
        })
        .then(function (data) {
            if (callback) {
                callback(null, data);
            }
        })
        .catch(function (error) {
            if (callback) {
                callback(error, null);
            }
        });
}

function sendFormData(form, url, callback) {
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        ajaxRequest(url, 'POST', formData, callback);
    });
}
function ajaxRequest(url, method, data, callback) {
    fetch(url, {
        method: method,
        body: data,
        credentials: 'same-origin'
    })
        .then(async function (response) {
            const contentType = response.headers.get('Content-Type');
            let parseData;
            if (contentType && contentType.includes('application/json')) {
                parseData = await response.json();
            } else if (contentType && contentType.includes('text/html')) {
                parseData = await response.text();
            }else{
                throw new Error('Невідомий тип даних');
            }
            if (!response.ok) {
                throw parseData;
            }
            return parseData;
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

function showPopup(btn, popUp, callback = null) {
    btn.addEventListener('click', function () {
        popUp.classList.remove('hide');
        if (callback){
            callback();
        }
    });
}

function hidePopup(btn, popUp) {
    btn.addEventListener('click', function () {
        popUp.classList.add('hide');
    });
}

/**
 * show success message from jason
 * @param message
 */
function showSuccessPopup(message) {
    const popup = document.getElementById('popup-success-message');
    popup.innerText = message;
    popup.style.display = 'block';
    popup.style.opacity = '1';

    setTimeout(function () {
        popup.style.opacity = '0';
        setTimeout(function () {
            popup.style.display = 'none';
        }, 500);
    }, 3000);
}

/**
 * show success message from session php
 */
setTimeout(function () {
    const msg = document.getElementById('success-message');
    msg.style.opacity = '0';
    setTimeout(() => {
        msg.remove();
    }, 1000);
}, 3000);

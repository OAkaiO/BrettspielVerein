function appendAlert(message, type) {
    const wrapper = document.createElement('div');
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible fade show d-flex align-items-center" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('')

    $('#alertContainer').append(wrapper);
}

function submitForm(target, form_id, texts) {
    $.post(target, $(`#${form_id}`).serialize(), (data, status, xhr) => {
        if (xhr.status === 204) {
            appendAlert(texts["success"], "success");
        }
        else {
            appendAlert(texts["warning"], "warning");
        }
    }).fail(() => appendAlert("Ein unerwarteter Fehler ist aufgetreten.", "danger"))
    .always(() => setTimeout(() => $(".alert").alert('close'), 3000));
}

$("#newsletter-form [type='submit']")[0].onclick = function (event) {
    event.preventDefault();
    let validForm = $("#newsletter-form")[0].reportValidity()
    let texts = {
        success: "Erfolgreich für den Newsletter registriert",
        warning: "Registrierung fehlgeschlagen. Bitte versuche es später erneut"
    }
    if (validForm) {
        submitForm("newsletter.php", "newsletter-form", texts);
    }
}

$('#register-form [type="submit"]')[0].onclick = function (event) {
    event.preventDefault();
    let validForm = $("#register-form")[0].reportValidity();
    let texts = {
        success: "Erfolgreich als Mitglied angemeldet",
        warning: "Registrierung fehlgeschlagen. Bitte versuche es später erneut"
    }
    if (validForm) {
        submitForm("register.php", "register-form", texts);
    }
}

$('#question-form [type="submit"]')[0].onclick = function (event) {
    event.preventDefault();
    let validForm = $("#question-form")[0].reportValidity();
    let texts = {
        success: "Deine Frage wurde geschickt. Wir melden uns bei dir!",
        warning: "Frage konnte nicht geschickt werden. Bitte versuche es später erneut"
    }
    if (validForm) {
        submitForm("question.php", "question-form", texts);
    }
}

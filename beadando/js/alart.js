function showAlert(message, alertType) {
    var alertDiv = document.createElement('div');
    alertDiv.classList.add('custom-alert', alertType);
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);
    setTimeout(function() {
        document.body.removeChild(alertDiv);
    }, 3000);
}

import './bootstrap';

window.Echo.channel('webhook-channel')
    .listen('WebhookReceived', (e) => {
        const statusElement = document.getElementById("status");
        statusElement.classList.add("complete");
    });
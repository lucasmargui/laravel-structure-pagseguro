import './bootstrap';

window.Echo.channel('webhook-channel')
    .listen('WebhookReceived', (e) => {
        console.log(e);  // Ou qualquer outra ação para exibir a notificação
    });

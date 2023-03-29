import { Notyf } from 'notyf';
import 'notyf/notyf.min.css'; // for React, Vue and Svelte

// Create an instance of Notyf
const notyf = new Notyf({
        duration: 3000,
        position: {
            x: 'right',
            y: 'top',
        },
        dismissible: true,
        types: [
            {
                type: 'info',
                background: '#00bfff',
                icon: false,
            },
            {
                type: 'warning',
                background: '#ffb700',
                icon: false,
            },
        ],
});

let messages = document.querySelectorAll('#notyf-message');

messages.forEach((message) => {
    if (message.classList.contains('info')) {
        notyf.open({
            type: 'info',
            message: message.textContent,
        });
    }
    if (message.classList.contains('warning')) {
        notyf.open({
            type: 'warning',
            message: message.textContent,
        });
    }
    if (message.classList.contains('success')) {
        notyf.success(message.textContent);
    }
    if (message.classList.contains('error')) {
        notyf.error(message.textContent);
    }
});
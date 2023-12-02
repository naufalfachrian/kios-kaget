import './bootstrap';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import { v4 as uuidv4 } from 'uuid';

window.Alpine = Alpine;
window.uuidv4 = uuidv4;
window.getSessionId = function () {
    const id = 'session_id';
    const sessionId = localStorage.getItem(id);
    if (sessionId === null || sessionId === '') {
        localStorage.setItem(id, uuidv4());
    }
    return localStorage.getItem(id);
}

Alpine.plugin(mask);
Alpine.start();

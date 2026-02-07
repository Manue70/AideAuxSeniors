import './bootstrap';
import '../css/app.css';
import '../css/login-page.css';
import '../css/onboarding.css';
import '../css/dashboard.css';
import '../css/info-pages.css';
import '../css/reminders.css';
import '../css/assistance.css';
import '../css/admin.css';
import '../css/header-footer.css';



document.addEventListener('DOMContentLoaded', () => {

    
    // =========================
    // ALERTES
    // =========================
    const alert = document.querySelector('.alert-success');

    if (alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';

            setTimeout(() => alert.remove(), 500);
        }, 5000);
    }
    


    // =========================
    // MENU MODAL
    // =========================
    const menuModal = document.getElementById('menuModal');
    if (menuModal) {
        const panel = menuModal.querySelector('.menu-panel');
        const desktopBtn = document.querySelector('.menu-btn.desktop');
        const burgerBtn = document.querySelector('.burger-btn.mobile');

        const openMenu = () => menuModal.classList.add('show');
        const closeMenu = () => menuModal.classList.remove('show');

        desktopBtn?.addEventListener('click', openMenu);
        burgerBtn?.addEventListener('click', openMenu);

        menuModal.addEventListener('click', (e) => {
            if (!panel.contains(e.target)) closeMenu();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeMenu();
        });
    }




    // =====================
    // MODALE RAPPELS
    // =====================
    (() => {
        const modal = document.getElementById('modal-reminder');
        if (!modal) return;

        const openBtns = document.querySelectorAll('.btn-open-reminder');
        const closeBtn = modal.querySelector('.modal-close');
        const hoursContainer = modal.querySelector('#hours-container');
        const addHourBtn = modal.querySelector('#add-hour');

        modal.style.display = 'none';

        openBtns.forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                modal.style.display = 'flex';
                const redirectInput = modal.querySelector('input[name="redirect_after"]');
                if (redirectInput) redirectInput.value = window.location.href;
            });
        });

        closeBtn?.addEventListener('click', () => modal.style.display = 'none');
        modal.addEventListener('click', e => {
            if (!modal.querySelector('.modal-content').contains(e.target)) modal.style.display = 'none';
        });

        if (hoursContainer && addHourBtn) {
            addHourBtn.addEventListener('click', e => {
                e.preventDefault();
                const div = document.createElement('div');
                div.className = 'hour-input';
                div.innerHTML = `
                    <input type="time" name="heure[]" required>
                    <button type="button" class="remove-hour btn btn-danger btn-sm">×</button>
                `;
                hoursContainer.appendChild(div);
            });

            hoursContainer.addEventListener('click', e => {
                if (e.target.classList.contains('remove-hour') && hoursContainer.children.length > 1) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.target.closest('.hour-input').remove();
                }
            });
        }
    })();

    // =====================
    // MODALE MEDICAMENTS
    // =====================
    (() => {
        const modal = document.getElementById('modal-medicament');
        if (!modal) return;

        const openBtns = document.querySelectorAll('.btn-open-medicament');
        const closeBtn = modal.querySelector('.modal-close');
        const form = document.getElementById('medication-form');
        const deleteBtn = document.getElementById('delete-medication');

        const idInput = document.getElementById('medication-id');
        const nomInput = document.getElementById('medication-nom');
        const dosageInput = document.getElementById('medication-dosage');
        const dailyInput = document.getElementById('medication-daily');
        const matinInput = document.getElementById('medication-matin');
        const midiInput = document.getElementById('medication-midi');
        const soirInput = document.getElementById('medication-soir');
        const methodInput = document.getElementById('form-method');
        const title = document.getElementById('modal-title');

        const btnOui = modal.querySelector('.btn-oui');
        const btnNon = modal.querySelector('.btn-non');
        const priseHoraires = modal.querySelector('.prise-horaires');

        modal.style.display = 'none';

        openBtns.forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                const med = btn.dataset;

                if (med.id) {
                    // Modifier
                    title.textContent = "Modifier médicament";
                    form.action = `/medicaments/${med.id}`;
                    methodInput.value = "PUT";
                    deleteBtn.style.display = "inline-block";

                    idInput.value = med.id;
                    nomInput.value = med.nom;
                    dosageInput.value = med.dosage;
                    dailyInput.checked = med.daily === "1";
                    matinInput.checked = med.matin === "oui";
                    midiInput.checked = med.midi === "oui";
                    soirInput.checked = med.soir === "oui";

                    priseHoraires.style.display = (matinInput.checked || midiInput.checked || soirInput.checked) ? 'block' : 'none';
                } else {
                    // Ajouter
                    title.textContent = "Nouveau médicament";
                    form.action = form.dataset.storeUrl;
                    methodInput.value = "POST";
                    deleteBtn.style.display = "none";

                    idInput.value = "";
                    nomInput.value = "";
                    dosageInput.value = "";
                    dailyInput.checked = false;
                    matinInput.checked = false;
                    midiInput.checked = false;
                    soirInput.checked = false;
                    priseHoraires.style.display = 'none';

                    const redirectInput = form.querySelector('input[name="redirect_after"]');
                    if (redirectInput) redirectInput.value = window.location.href;
                }

                modal.style.display = 'flex';
            });
        });

        // Fermer modale
        closeBtn?.addEventListener('click', () => modal.style.display = 'none');
        modal.addEventListener('click', e => {
            if (!modal.querySelector('.modal-content').contains(e.target)) modal.style.display = 'none';
        });

        // Supprimer
        deleteBtn?.addEventListener('click', () => {
            const id = idInput.value;
            if (!id) return;
            if (confirm("Voulez-vous vraiment supprimer ce médicament ?")) {
                fetch(`/medicaments/${id}`, {
                    method: 'DELETE',
                    credentials: 'same-origin', 
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                }).then(() => location.reload());
            }
        });

        // Oui / Non
        btnOui?.addEventListener('click', () => priseHoraires.style.display = 'block');
        btnNon?.addEventListener('click', () => {
            priseHoraires.style.display = 'none';
            matinInput.checked = false;
            midiInput.checked = false;
            soirInput.checked = false;
        });
    })();


    // =====================
    // MODALE CONTACTS
    // =====================
    (() => {
        const modal = document.getElementById('modal-contact');
        if (!modal) return;

        const openBtns = document.querySelectorAll('.btn-open-contact, .btn-edit-contact');
        const closeBtns = modal.querySelectorAll('.modal-close, .btn-close-contact');
        const form = document.getElementById('contact-form');
        const title = document.getElementById('modal-title');
        const methodInput = document.getElementById('form-method');
        const idInput = document.getElementById('contact-id');
        const deleteBtn = document.getElementById('btn-delete-contact');

        const nomInput = document.getElementById('contact-nom');
        const telInput = document.getElementById('contact-telephone');
        const lienInput = document.getElementById('contact-lien');
        const prioritaireInput = document.getElementById('contact-prioritaire');

        // Ouvrir la modale
        openBtns.forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();

                if (btn.classList.contains('btn-edit-contact')) {
                    // Modifier
                    const id = btn.dataset.id;
                    title.textContent = "Modifier le contact";
                    form.action = `/contacts/${id}`;
                    methodInput.value = 'PUT';
                    idInput.value = id;

                    nomInput.value = btn.dataset.nom || '';
                    telInput.value = btn.dataset.telephone || '';
                    lienInput.value = btn.dataset.lien || '';
                    prioritaireInput.checked = btn.dataset.prioritaire === "1" || btn.dataset.prioritaire === "true";

                    deleteBtn.style.display = 'inline-block';
                } else {
                    // Ajouter
                    title.textContent = "Ajouter un contact";
                    form.action = `/contacts`;
                    methodInput.value = '';
                    idInput.value = '';

                    nomInput.value = '';
                    telInput.value = '';
                    lienInput.value = '';
                    prioritaireInput.checked = false;

                    deleteBtn.style.display = 'none';
                }

                modal.style.display = 'flex';
            });
        });

        // Fermer modale
        closeBtns.forEach(btn => btn.addEventListener('click', () => modal.style.display = 'none'));
        modal.addEventListener('click', e => {
            if (!modal.querySelector('.modal-content').contains(e.target)) modal.style.display = 'none';
        });

        // Supprimer
        deleteBtn.addEventListener('click', () => {
            const id = idInput.value;
            if (!id) return;
            if (confirm("Voulez-vous vraiment supprimer ce contact ?")) {
                fetch(`/contacts/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                }).then(() => location.reload());
            }
        });
    })();


    // ===============================
    // Notifications (page parametres)
    // ===============================
    // MODALE NOTIFICATIONS
    (() => {
        const modal = document.getElementById('modal-notif');
        if (!modal) return;

        const openBtns = document.querySelectorAll('.btn-open-notif'); // bouton qui ouvre la modale
        const closeBtn = modal.querySelector('.modal-close');
        const inputEnabled = modal.querySelector('#notif-enabled');
        const btnOui = modal.querySelector('#notif-oui');
        const btnNon = modal.querySelector('#notif-non');
        const form = modal.querySelector('#notif-form');

        modal.style.display = 'none';

        // ouvrir la modale
        openBtns.forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                modal.style.display = 'flex';
            });
        });

        // fermer la modale
        closeBtn?.addEventListener('click', () => modal.style.display = 'none');
        modal.addEventListener('click', e => {
            if (!modal.querySelector('.modal-content').contains(e.target)) {
                modal.style.display = 'none';
            }
        });

        // bouton Oui
        btnOui?.addEventListener('click', () => {
            inputEnabled.value = 1;
            form.submit();
        });

        // bouton Non
        btnNon?.addEventListener('click', () => {
            inputEnabled.value = 0;
            form.submit();
        });
    })();




    
    // =========================
    // ACCESSIBILITÉ
    // =========================
    document.querySelector('.btn-text-larger-oui')?.addEventListener('click', () => {
        document.body.style.fontSize = '1.3rem';
    });
    document.querySelector('.btn-text-larger-non')?.addEventListener('click', () => {
        document.body.style.fontSize = '';
    });
    document.querySelector('.btn-contrast-oui')?.addEventListener('click', () => {
        document.body.style.filter = 'contrast(150%)';
    });
    document.querySelector('.btn-contrast-non')?.addEventListener('click', () => {
        document.body.style.filter = '';
    });

    // =========================
    // SUPPRESSION DE COMPTE
    // =========================
    const deleteAccountBtn = document.getElementById('delete-account-btn');
    const deleteModal = document.getElementById('delete-modal');
    const confirmDelete = document.getElementById('confirm-delete');
    const cancelDelete = document.getElementById('cancel-delete');
    const deleteForm = document.getElementById('delete-account-form');

    if (deleteAccountBtn) {
        deleteAccountBtn.addEventListener('click', () => {
            deleteModal.style.display = 'flex';
        });
        cancelDelete?.addEventListener('click', () => deleteModal.style.display = 'none');
        confirmDelete?.addEventListener('click', () => deleteForm.submit());
        deleteModal.addEventListener('click', e => {
            if (!deleteModal.querySelector('.modal-content').contains(e.target)) {
                deleteModal.style.display = 'none';
            }
        });
    }


    // =========================
    // Contacts dynamiques + redirect
    // =========================

    const contactsContainer = document.getElementById('contacts-container');
    const addContactBtn = document.getElementById('add-contact');
    const redirectContactInput = document.getElementById('contact_redirect_after');

    const createContactLine = () => {
        const div = document.createElement('div');
        div.className = 'contact-line';
        div.style.display = 'flex';
        div.style.gap = '0.5rem';
        div.style.marginBottom = '0.5rem';

        div.innerHTML = `
            <input type="text" name="nom[]" placeholder="Nom" required>
            <input type="text" name="telephone[]" placeholder="Téléphone" required>
            <button type="button" class="btn btn-danger btn-remove-contact">×</button>
        `;

        return div;
    };

    addContactBtn?.addEventListener('click', e => {
        if (redirectContactInput) {
            redirectContactInput.value = addContactBtn.dataset.redirect || '';
        }

        contactsContainer?.appendChild(createContactLine());    
        });

    contactsContainer?.addEventListener('click', e => {
        if (e.target.classList.contains('btn-remove-contact')) {
            e.target.closest('.contact-line').remove();
        }
    });



    // =========================
    // Assistant / Chatbot
    // =========================
    const sendBtn = document.getElementById('send-message');
    const userInput = document.getElementById('chat-message');
    const chatContent = document.querySelector('.assistant-content');

    if (!sendBtn || !userInput || !chatContent) return;

    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = tokenMeta ? tokenMeta.content : '';

    if (!csrfToken) {
        console.error('CSRF token manquant !');
        return;
    }

    // Fonction pour ajouter une bulle dans le chat
    const appendBubble = (message, type = 'assistant') => {
        const bubble = document.createElement('div');
        bubble.className = `chat-message ${type}`;
        bubble.innerHTML = `
            <img src="/images/icons/${type === 'assistant' ? 'avatar_bulle.png' : 'avatar_user.jpg'}" class="chat-avatar" alt="${type === 'assistant' ? 'Assistant' : 'Vous'}">
            <div class="chat-bubble">${message}</div>
        `;
        chatContent.appendChild(bubble);
        chatContent.scrollTop = chatContent.scrollHeight;
    };

    // 🔹 Charger les 10 derniers messages au chargement
    async function loadHistory() {
        try {
            const res = await fetch('/assistant/history'); // on créera cette route Laravel
            const data = await res.json();
            if (Array.isArray(data)) {
            data.forEach(msg => appendBubble(msg.content, msg.role));
            }
        } catch (err) {
            console.error('Erreur chargement historique:', err);
        }
    }

    loadHistory(); // appeler dès que la page se charge

    const sendMessage = async () => {
        const message = userInput.value.trim();
        if (!message) return;

        // Ajouter bulle utilisateur
        appendBubble(message, 'user');
        userInput.value = '';

        function containsSensitivePhrase(text) {
            const sensitiveKeywords = [
                'je me sens mal',
                'je suis triste',
                'je suis seul',
                'j’ai peur',
                'je n’y arrive plus',
                'je suis fatigué',
                'je vais mal',
                'je suis déprimé'
         ];
            const lower = text.toLowerCase();
            return sensitiveKeywords.some(k => lower.includes(k));
    }

            // 🚨 Détection phrase sensible (AVANT OpenAI)
        if (containsSensitivePhrase(message)) {
            const supportMessage =
                "Je suis désolé que vous vous sentiez ainsi. Vous n’êtes pas seul. " +
                "Souhaitez-vous que je vous aide ou que je prévienne un proche ?";

            appendBubble(supportMessage, 'assistant');
            speak(supportMessage);
        }


        try {
            const response = await fetch('/assistant', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ message })
            });

            // On lit le body une seule fois
            const rawText = await response.text();
            let data;

            try {
                data = JSON.parse(rawText); // parse JSON si possible
            } catch {
                // Sinon, affiche texte brut
                appendBubble(`Erreur serveur (non JSON): <pre style="white-space: pre-wrap;">${rawText}</pre>`, 'assistant');
                return;
            }

            // Ajouter bulle assistant
            appendBubble(data.reply || 'Pas de réponse', 'assistant');
            speak(data.reply || 'Pas de réponse');


        } catch (err) {
            console.error('Erreur fetch:', err);
            appendBubble(`Erreur fetch: ${err.message}`, 'assistant');
        }
    };

    sendBtn.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', e => {
        if (e.key === 'Enter') sendMessage();
    })   


                // =========================================
                // Voix – Speech to Text + Text to Speech
                // =========================================

    // =========================
    // Reconnaissance vocale
    // =========================
    const voiceBtn = document.getElementById('voice-btn');
    let recognition = null;
    const userName = "{{ auth()->user()->prenom ?? 'Utilisateur' }}";


    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SpeechRecognition =
            window.SpeechRecognition || window.webkitSpeechRecognition;

        recognition = new SpeechRecognition();
        recognition.lang = 'fr-FR';
        recognition.interimResults = false;
        recognition.continuous = false;

        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            userInput.value = transcript;
            sendMessage(); // 🔥 
        };

        recognition.onerror = (e) => {
            console.error('Erreur micro', e);
        };
    } else {
        if (voiceBtn) voiceBtn.style.display = 'none';
    }

    if (voiceBtn && recognition) {
        voiceBtn.addEventListener('click', () => {
        recognition.start();
        });
    }

    function speak(text) {
        if (!('speechSynthesis' in window)) return;

        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'fr-FR';
        utterance.rate = 0.85;   
        utterance.pitch = 1;

        speechSynthesis.cancel();
        speechSynthesis.speak(utterance);
    }

    const stopVoiceBtn = document.getElementById('stop-voice');

    if (stopVoiceBtn) {
        stopVoiceBtn.addEventListener('click', () => {
            if ('speechSynthesis' in window) {
                speechSynthesis.cancel();
            }
        });
    }

        // ON/Off voix
    const toggleVoiceBtn = document.getElementById('toggle-voice');
    let voiceEnabled = true;

    if (toggleVoiceBtn) {
        toggleVoiceBtn.addEventListener('click', () => {
            voiceEnabled = !voiceEnabled;
            toggleVoiceBtn.textContent = voiceEnabled ? '🔊' : '🔇';
            toggleVoiceBtn.setAttribute('data-enabled', voiceEnabled);
            if (!voiceEnabled && 'speechSynthesis' in window) {
                speechSynthesis.cancel();
            }
        });
    }


    // détection phrases sensibles
    const sensitiveKeywords = [
        'je me sens mal',
        'je suis triste',
        'je suis seul',
        'j’ai peur',
        'je n’y arrive plus',
        'je suis fatigué',
        'je vais mal',
        'je suis déprimé'
    ];

    function containsSensitivePhrase(text) {
        const lower = text.toLowerCase();
        return sensitiveKeywords.some(keyword => lower.includes(keyword));
    }

    //Réponse en focntion de l'heure
    function getTimeContext() {
        const hour = new Date().getHours();

        if (hour >= 6 && hour < 12) return 'morning';
        if (hour >= 12 && hour < 18) return 'afternoon';
        if (hour >= 18 && hour < 22) return 'evening';
        return 'night';
    }

    // Réponse du chat
    function timeGreeting() {
        const context = getTimeContext();

        switch (context) {
            case 'morning':
                return "Bonjour 😊 J’espère que vous avez bien dormi.";
            case 'afternoon':
                return "J’espère que votre après-midi se passe bien.";
            case 'evening':
                return "Bonsoir 🌙 Prenez le temps de vous reposer.";
            case 'night':
                return "Il est tard… je suis là si vous avez besoin de parler.";
        }
    }

    const greeting = timeGreeting();
    appendBubble(greeting, 'assistant');
    speak(greeting);

    // Prévenir un proche (exemple : numéro fixe)
    document.getElementById('alert-proche')?.addEventListener('click', () => {
        if (confirm("Voulez-vous appeler votre proche ?")) {
            window.location.href = "tel:+33123456789"; // remplacer par le numéro réel
        }
    });

    document.getElementById('call-voice')?.addEventListener('click', () => {
    // Simple appel téléphonique sur mobile
    window.location.href = "tel:+33xxxxxxxxx";
    });

    // ====================
    // MODALE hydratation
    // ====================
    document.querySelectorAll('.btn-open-hydratation').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = document.getElementById('modal-hydratation'); // <-- correspond à l'HTML
            if(modal) modal.style.display = 'flex'; // <-- pour garder le flex centré
        });
    });

    // fermer la modale
    document.querySelectorAll('#modal-hydratation .modal-close').forEach(span => {
        span.addEventListener('click', () => {
            span.closest('.modal').style.display = 'none';
        });
    });

    // fermer si clic en dehors
    window.addEventListener('click', e => {
        const modal = document.getElementById('modal-hydratation');
        if (e.target === modal) modal.style.display = 'none';
    });

});    
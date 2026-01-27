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

    // =========================
    // MODALES MÉDICAMENT, RAPPELS, NOTIFICATIONS
    // =========================

    const setupModal = (modalId, openBtnsSelector, closeSelector, extraOpenLogic) => {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        const openBtns = document.querySelectorAll(openBtnsSelector);
        const closeBtn = modal.querySelector(closeSelector);

        modal.style.display = 'none';

        openBtns.forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                modal.style.display = 'flex';
                extraOpenLogic?.();
            });
        });

        closeBtn?.addEventListener('click', () => modal.style.display = 'none');

        modal.addEventListener('click', e => {
            if (!modal.querySelector('.modal-content').contains(e.target)) {
                modal.style.display = 'none';
            }
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') modal.style.display = 'none';
        });
    };

    // Modale médicaments
    setupModal('modal-medicament', 'btn-oui-medicament', '.close', () => {
        const modal = document.getElementById('modal-medicament');
        const horaires = modal.querySelector('.prise-horaires');
        const btnOui = modal.querySelector('.btn-oui');
        const btnNon = modal.querySelector('.btn-non');
        const form = document.getElementById('medicament-form');

        horaires.style.display = 'none';
        btnOui.classList.remove('active');
        btnNon.classList.remove('active');

        btnOui?.addEventListener('click', () => {
            btnOui.classList.add('active');
            btnNon.classList.remove('active');
            horaires.style.display = 'block';
            document.getElementById('input-matin').value = 'oui';
        });

        btnNon?.addEventListener('click', () => {
            btnNon.classList.add('active');
            btnOui.classList.remove('active');
            horaires.style.display = 'none';
            document.getElementById('input-matin').value = 'non';
        });

       
    });

    // Modale rappels
    setupModal('modal-reminder', '#btn-oui-reminder, #btn-new-reminder', '.modal-close');


    // Modale notifications
    setupModal('modal-notif', '.btn-notif', '.close');


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
    // Contacts dynamiques
    // =========================
    const contactsContainer = document.getElementById('contacts-container');
    const addContactBtn = document.getElementById('add-contact');

    const createContactLine = () => {
        const div = document.createElement('div');
        div.className = 'contact-line';
        div.style.display = 'flex';
        div.style.gap = '0.5rem';
        div.style.marginBottom = '0.5rem';

        const nom = document.createElement('input');
        nom.type = 'text';
        nom.name = 'nom[]';
        nom.placeholder = 'Nom';
        nom.required = true;

        const tel = document.createElement('input');
        tel.type = 'text';
        tel.name = 'telephone[]';
        tel.placeholder = 'Téléphone';
        tel.required = true;

        const remove = document.createElement('button');
        remove.type = 'button';
        remove.className = 'btn btn-danger btn-remove-contact';
        remove.textContent = '×';
        remove.addEventListener('click', () => div.remove());

        div.append(nom, tel, remove);
        return div;
    };

    addContactBtn?.addEventListener('click', () => {
        contactsContainer.appendChild(createContactLine());
    });

    contactsContainer?.querySelectorAll('.btn-remove-contact').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            btn.closest('.contact-line').remove();
        });
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
    
    // Pour WebRTC VOIP, tu pourrais ouvrir un modal avec un appel WebRTC
    });
});

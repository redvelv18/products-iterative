/**
 * Vite JavaScript ielādes tests: pārlūka konsolē jāparādās ziņojumam
 * "Vite JS ielādēts" un <html> elementam jāsaņem data-js="loaded".
 */
document.addEventListener('DOMContentLoaded', () => {
    document.documentElement.dataset.js = 'loaded';

    console.info('Vite JS ielādēts');
});

/**
 * Dzēšanas veidlapu apstiprinājums. Apstiprinājuma teksts tiek nolasīts
 * no veidlapas data-confirm atribūta, tāpēc produkta nosaukums netiek
 * ievietots JavaScript kodā.
 */
document.addEventListener('submit', (event) => {
    const form = event.target.closest('form[data-confirm]');

    if (!form || window.confirm(form.dataset.confirm)) {
        return;
    }

    event.preventDefault();
});

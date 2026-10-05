// resources/js/theme.js

export function initThemeSwitcher() {
    // Clear any previous dark theme settings from localStorage
    try {
        localStorage.removeItem('theme');
    } catch (e) {}

    // Ensure dark class is completely removed from html and body
    document.documentElement.classList.remove('dark');
    document.body.classList.remove('dark');
    document.body.classList.add('light');

    // Remove any theme toggle buttons from the DOM if present
    const themeToggleBtns = document.querySelectorAll('#theme-toggle, [id="theme-toggle"]');
    themeToggleBtns.forEach(btn => btn.remove());
}
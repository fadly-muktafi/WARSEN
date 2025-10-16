import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const themeToggleButton = document.getElementById('theme-toggle-btn');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');

    // Function to set the icon visibility based on the current theme
    function setIconVisibility() {
        if (document.documentElement.classList.contains('dark')) {
            lightIcon.classList.add('hidden');
            darkIcon.classList.remove('hidden');
        } else {
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
        }
    }

    // Set initial icon visibility
    setIconVisibility();

    themeToggleButton.addEventListener('click', () => {
        // Toggle the dark class on the root element
        document.documentElement.classList.toggle('dark');

        // Update localStorage with the new theme preference
        if (document.documentElement.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }

        // Update the icon visibility
        setIconVisibility();
    });
});

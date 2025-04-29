import './bootstrap';
import { Dropdown } from 'bootstrap';

// Visualização da senha
window.togglePassword = function(fieldId, toggleIcon){
    const field = document.getElementById(fieldId);
    const icon = toggleIcon.querySelector('i');


    if(field.type === 'password'){
        field.type = 'text';
        icon.classList.remove('bi', 'bi-eye-slash-fill');
        icon.classList.add('bi', 'bi-eye-fill');
    } else{
        field.type = 'password';
        icon.classList.remove('bi', 'bi-eye-fill');
        icon.classList.add('bi', 'bi-eye-slash-fill');
    }
}

const dropdownToggle = document.getElementById('dropdownToggle');
// Seleciona o menu dropdown
const dropdownMenu = document.getElementById('dropdownToggle').nextElementSibling; // o próximo elemento que é o <ul>

// Cria a instância do dropdown do Bootstrap
const dropdown = new Dropdown(dropdownToggle);

// Caso queira ativar o dropdown programaticamente:
dropdownToggle.addEventListener('click', (event) => {
    dropdown.toggle(); // Alterna entre mostrar e esconder o menu
});


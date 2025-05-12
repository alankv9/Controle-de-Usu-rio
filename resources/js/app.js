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

// Seleciona o botão que ativa o dropdown
const dropdownToggle = document.getElementById('dropdownToggle');
// Seleciona o menu dropdown (o próximo elemento irmão <ul>)
const dropdownMenu = dropdownToggle.nextElementSibling;
// Cria a instância do dropdown do Bootstrap (importante: usa 'bootstrap.Dropdown')
const dropdown = new bootstrap.Dropdown(dropdownToggle);
// Alternar o dropdown ao clicar
dropdownToggle.addEventListener('click', (event) => {
    event.preventDefault(); // Evita o comportamento padrão do link
    dropdown.toggle();
});


// Função para mostrar o preview da imagem escolhida
function previewPhoto(event) {
    const input = event.target;
    const preview = document.getElementById('photo-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; // Exibe o preview
        };
        reader.readAsDataURL(input.files[0]);
    }
}


import './bootstrap';

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

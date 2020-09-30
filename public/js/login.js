const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('.password');

togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
;
    

(function () {
    


    if (document.body.contains(document.getElementById("cerrar"))) {
        let botonCerrra = document.getElementById("cerrar");
        let divError = document.getElementById("div-error");
        botonCerrra.addEventListener('click', function (e) {
            e.preventDefault();
            //divError.style.display="none";
            if (divError.classList.contains("error-contenedor")) {

                divError.classList.remove("error-contenedor");
                divError.classList.add("error-contenedor-esconder");
            }
        })

    } else {

    }

})();

function validar_campos() {

}
function send_form() {
    document.getElementById("frm-login").submit();
}

function stop_form() {
    const form = document.getElementById("frm-login");
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        
    })
}

function ValidarEmail(email) {

    let testEmail = new String(email);
    console.warn(testEmail);
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(testEmail)) {
        console.log(true);
        
        return true;
        
    }
    //alert("You have entered an invalid email address!")
    return false;

}

//evento click al boton de enviar
//Validacinde campos de login
const enviar = document.getElementById("enviar")
enviar.addEventListener('click', function (e) {

    const contra = document.getElementById("pass").value;
    const exampleInputEmail = document.getElementById("email").value;
    let pass_error = document.getElementById("pass-error");
    let email_error = document.getElementById("email-error");

    const str = new String(exampleInputEmail);

    let password_validated = null;
    let email_validated = null;


    if (exampleInputEmail.length < 1) {

        stop_form();

        email_error.classList.remove("email-error");
        email_error.innerHTML = "Ingresa tu email !";

    } else if (!ValidarEmail(str)) {
        stop_form();
        email_error.classList.remove("email-error");
        email_error.innerHTML = "Ingresa un formato valido !";
        console.log(email_error.classList);
    } else {

        email_error.classList.add("email-error");
        pass_error.innerHTML = "";
        email_validated = true;

    }

    if (contra.length < 1) {

        stop_form();
        pass_error.classList.remove("pass-error");
        pass_error.innerHTML = "Ingresa tu contraseña !";

    } else if (contra.length < 4) {
        stop_form();
        pass_error.classList.remove("pass-error");
        pass_error.innerHTML = "Contraeña debe de tener almnos 6 caracteres !"

    } else {
        pass_error.innerHTML = "";
        password_validated = true;
    }

    if (password_validated && email_validated) {
        send_form();
    }


})



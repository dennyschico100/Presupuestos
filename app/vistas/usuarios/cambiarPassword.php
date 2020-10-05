<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/main.css">

<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/util.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<?php require APP_ROOT .'/vistas/inc/head.php'; ?>

<div class="contact1">
    <div class="container-contact1 col-md-4 ">
        <div class="contact1-pic js-tilt" data-tilt>
            <!--
				<img src="images/img-01.png" alt="IMG">-->

        </div>

        <form method="POST" id="frm-login" action="<?php  echo URL_ROOT?>/usuarios/activarCuenta"
            class="contact1-form validate-form  col-md-12  ">
            <span class="contact1-form-title">
                <h3>Para activar tu cuenta primero, cambia tu contraseña</h3>
            </span>
            <!--
            <div class="wrap-input1 validate-input" data-validate="Name is required">
                <input class="input1" type="text" name="name" placeholder="Name">

			</div> -->


            <div id="frm" class="wrap-input1 validate-input">
                <input type="email" class="input1  form-control-user" id="email" name="email"
                    aria-describedby="emailHelp" placeholder="Ingresa tu  Email ...">
                <div style="border:px solid blue;" class="col-md-12">
                    <span>
                        <p id="email-error" class="email-error text-center text-danger help-block ">
                            </strong>
					
                        </p>
                </div>
            </div>
            
            
			<div class="form-group">
                                        <input type="password" name="password" class="input1  form-control-user password "
                                            id="pass" aria-describedby="password-constraints"
                                            placeholder="Ingresa tu Nueva Contraseña">
                                        <i class="far fa-eye" id="togglePassword"></i>
                                        <label for="" class="label-pass">Mostrar Contraseña</label>
                                        <div style="border:px solid blue;" class="col-md-12">
                                            <span>
                                                <p id="pass-error"
                                                    class="pass-error text-center text-danger help-block ">

                                                </p>

                                            </span>
                                        </div>
				</div>
									
            
			<div class="form-group">
				<input type="password" name="password2" class="input1  form-control-user password " 
				id="pass2"
                    aria-describedby="password-constraints" placeholder="Repite tu Nueva Contraseña">
				
				
                <div style="border:px solid blue;" class="col-md-12">
                    <span>
                        <p id="coincidir-error" class="pass-error text-center text-danger help-block ">

                        </p>

                    </span>
				</div>
				
            </div>

            <div class="container-contact1-form-btn">

                <button type="submit" id="enviar" class="contact1-form-btn btn-user " value="Log In">
                    <span>
                        Confirmar
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </span></button>


            </div>

        </form>
    </div>
</div>


<script src="<?php echo URL_ROOT.'/public/js/cambiarPassword.js';?>"></script>
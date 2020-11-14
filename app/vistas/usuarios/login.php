<?php require APP_ROOT . '/vistas/inc/head.php' ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div style="border:px solid red;" class="col-lg-6 d-none d-lg-block bg-login-imagen">
                        </div>

                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvenido !</h1>
                                </div>
                                <form class="user" id="frm-login" method="post"
                                    action="<?php  echo URL_ROOT?>/usuarios/login">
                                    <div id="div-error" class="error-contenedor">
                                        <?php echo "Hoy es " . date("Y-m-d H:i:s") . "<br>";
                                            if(!empty($data['errores']) ) { ; ?>
                                        
                                        <div class="alert alert-danger">
                                            <strong>

                                                <?php  echo  $data['errores'];  ?>

                                                <a style="position:absolute;right:4px;margin-top:-10px; " id="cerrar"
                                                    class=" close">&times</a>
                                            </strong>

                                        </div>
                                    </div>
                                    <?php   }?>
                                    <div id="frm" class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email"
                                            name="email" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address...">
                                        <div style="border:px solid blue;" class="col-md-12">
                                            <span>
                                                <p id="email-error"
                                                    class="email-error text-center text-danger help-block ">
                                                    </strong>

                                                </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password"
                                            class="form-control form-control-user password " id="pass"
                                            aria-describedby="password-constraints" placeholder="Password">
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
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <!--<label class="custom-control-label" for="customCheck">Remember Me</label>
                    -->
                                        </div>

                                    </div>


                                    <button type="submit" id="enviar"
                                        class="btn btn-primary btn-user btn-block fadeIn fourth" value="Log In">Iniciar
                                        Sesion</button>
                                    <hr>
                                    <!-- 
                <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Login with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                </a>-->
                                </form>
                                <hr>
                                <div class="text-center">
                                    <h3><a class="small" href="forgot-password.html">Olvidaste tu contraseña ?</a>
                                    </h3>
                                </div>
                                <div class="text-center">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<script src="<?php echo URL_ROOT.'/public/js/login.js';?>"></script>
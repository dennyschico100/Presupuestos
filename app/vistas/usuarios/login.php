<?php require APP_ROOT . '/vistas/inc/head.php' ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div style="border:px solid red;" class="col-lg-6 d-none d-lg-block bg-login-imagen"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvenido !</h1>
                                </div>
                                <form class="user" action="<?php  echo URL_ROOT?>/usuarios/login" >
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user password "
                                            id="exampleInputPassword" aria-describedby="password-constraints"
                                            placeholder="Password">
                                        <i class="far fa-eye" id="togglePassword"></i>
                                        <label for="" class="label-pass">Mostrar Contraseña</label>

                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <!--<label class="custom-control-label" for="customCheck">Remember Me</label>
                    -->
                                        </div>

                                    </div>
                                    <a href="index.html" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </a>
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
<div class="main-wrapper">

      <div class="preloader">
          <div class="lds-ripple">
              <div class="lds-pos"></div>
              <div class="lds-pos"></div>
          </div>
      </div>

      <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
          <div class="auth-box bg-dark border-top border-secondary" id="login-bg">
              <div id="loginform">
                  
                  <div class="text-center p-t-20 p-b-20">
                      <span class="db"><img src="vistas/assets/images/logo.png" alt="logo" style="width: 100%" /></span>
                  </div>
                  <br>
                  <div class="text-center p-t-20 p-b-20">
                        <h2 id="txtLogin">ADMINISTRACIÓN - CRM</h2>
                  </div>
                  <br>
                  <!-- Form -->
                  <form class="form-horizontal m-t-20" id="loginform" method="POST">
                      <div class="row p-b-30">
                          <div class="col-12">
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                  </div>
                                  <input type="email" class="form-control form-control-lg" placeholder="Correo" aria-label="Username" aria-describedby="basic-addon1" required="" name="ingEmail">
                              </div>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                  </div>
                                  <input type="password" class="form-control form-control-lg" placeholder="Contraseña" aria-label="Password" aria-describedby="basic-addon1" required="" name="ingPassword">
                              </div>
                          </div>
                      </div>
                      <br>
                      <div class="row border-top border-secondary">
                          <div class="col-12">
                              <div class="form-group">
                                  <div class="p-t-20">
                                 
                                      <button class="btn btn-success float-right" type="submit"><i class="fa fa-lock m-r-5"></i> Acceder</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                        <?php

                          $login = new ControladorAdministradores();
                          $login -> ctrIngresoAdministrador();

                        ?>
                  </form>
              </div>
           
          </div>
      </div>
  </div>

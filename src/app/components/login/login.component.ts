import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { LoginService } from '../../services/login.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  // Se definen las variables a utilizar
  public form:FormGroup;
  public error:string = "";
  public enviado:boolean = false;

  constructor(private service:LoginService) {

    // Creamos el formulario
    this.form=new FormGroup({
      correo:new FormControl("prueba@eml.com",[Validators.required,Validators.email]),
      contrasenia:new FormControl("12345678",[Validators.required])
    });
  }

  ngOnInit(): void {

    // Validamos que no exista la sesión si existe redireccionamos al modulo de usuarios
    if (localStorage.getItem('token')){

      window.location.href = "/usuarios";
    }
  }

  // Función que llama el servicio de iniciar sesión y valida el formulario
  login():void {

    this.enviado = true;

    if (this.form.status == "VALID" ) {

      this.service.login(this.form.value.correo,this.form.value.contrasenia)
      .subscribe((response) => {
        localStorage.setItem("token", response['token']);
        localStorage.setItem("Email", response['data']['email']);
        localStorage.setItem("fullname", response['data']['fullname']);

        window.location.href = "/usuarios";
      },
      (error) => {
        if (error.status == 422)
        {
          this.error = error.error.message;
        }
        else
        {
          this.error = "Hubo un error, por favor intente más tarde.";
        }
      });

    }
  }

}

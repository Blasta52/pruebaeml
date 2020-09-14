import { Component, OnInit } from '@angular/core';
import { UsuariosService } from '../../services/usuarios.service';

@Component({
  selector: 'app-usuarios',
  templateUrl: './usuarios.component.html',
  styleUrls: ['./usuarios.component.css']
})
export class UsuariosComponent implements OnInit {

  // Se definen las variables a utilizar
  public error:string = "";
  public Usuarios:any;
  public IsLoading:boolean= false;
  public userName = '-';
  public email = '-';

  constructor(private service:UsuariosService) { }

  ngOnInit(): void {

    // Se valida que exista la sesión o se redirecciona al home
    if (localStorage.getItem('token') == null){

      window.location.href = "/";
    }

    // Guardamos el nombre y el email del localStorage en las variables
    this.userName = localStorage.getItem('fullname')
    this.email = localStorage.getItem('Email')
    // Llamamos los usuarios
    this.getUsuarios()
  }

  // Función que consulta el servicio de usuarios
  getUsuarios(): void {

    this.IsLoading = true;

     this.service.getUsuarios().subscribe((response) => {

      this.IsLoading = false;

     this.Usuarios = response;

    },
    (error) => {

      this.IsLoading = false;

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
  Salir(){

    localStorage.clear();

    window.location.href = "/";

  }

}

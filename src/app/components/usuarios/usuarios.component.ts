import { Component, OnInit } from '@angular/core';
import { UsuariosService } from '../../services/usuarios.service';

@Component({
  selector: 'app-usuarios',
  templateUrl: './usuarios.component.html',
  styleUrls: ['./usuarios.component.css']
})
export class UsuariosComponent implements OnInit {

  public error:string = "";

  public Usuarios:any;

  public IsLoading:boolean= false;

  public userName = '-';
  public email = '-';



  constructor(private service:UsuariosService) { }

  ngOnInit(): void {

    if (localStorage.getItem('token') == null){

      window.location.href = "/";
    }
    this.userName = localStorage.getItem('fullname')
    this.email = localStorage.getItem('Email')
    this.getUsuarios()
  }
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

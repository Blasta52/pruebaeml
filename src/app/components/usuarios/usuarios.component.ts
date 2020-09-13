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




  constructor(private service:UsuariosService) { }

  ngOnInit(): void {

    if (localStorage.getItem('token') == null){

      window.location.href = "/";
    }

    this.getUsuarios()
  }
  getUsuarios(): void {

     this.service.getUsuarios().subscribe((response) => {

     this.Usuarios = response;

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

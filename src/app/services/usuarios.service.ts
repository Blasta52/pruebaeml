import { Injectable } from "@angular/core";
import { HttpClient, HttpHeaders } from "@angular/common/http";


import { map } from "rxjs/operators";

import { environment } from "../../environments/environment";

@Injectable({
  providedIn: "root",
})
export class UsuariosService {
  /* Define variables */
  private httpOptions = {
    headers: new HttpHeaders({
      "Authorization": localStorage.getItem("token") || '',
    }),
  };

  constructor(private http: HttpClient) {}

  getUsuarios() {

    return this.http
      .get(environment.apiBaseUrl+"usuarios",this.httpOptions)
      .pipe(map((data) => data));
  }
  CrearUsuario(nombres,apellidos,cedula,correo,telefono) {

    let form = new FormData();

    form.append('nombres',	nombres);
    form.append('apellidos',apellidos);
    form.append('cedula',cedula);
    form.append('correo',correo);
    form.append('telefono',telefono);
    

    return this.http
      .post(environment.apiBaseUrl+"crear-usuario",form ,this.httpOptions)
      .pipe(map((data) => data));
  }
  ActualizarUsuario(id,nombres,apellidos,cedula,correo,telefono) {

    let form = new FormData();

    form.append('id',	id);
    form.append('nombres',	nombres);
    form.append('apellidos',apellidos);
    form.append('cedula',cedula);
    form.append('correo',correo);
    form.append('telefono',telefono);
    

    return this.http
      .post(environment.apiBaseUrl+"actualizar-usuario",form ,this.httpOptions)
      .pipe(map((data) => data));
  }
  DeleteUsuario(id){

    let form = new FormData();

    form.append('id',	id);
    

    return this.http
      .post(environment.apiBaseUrl+"eliminar-usuario",form ,this.httpOptions)
      .pipe(map((data) => data));
  }

  }


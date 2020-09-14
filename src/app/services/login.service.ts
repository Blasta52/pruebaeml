import { Injectable } from "@angular/core";
import { HttpClient, HttpHeaders } from "@angular/common/http";


import { map } from "rxjs/operators";

import { environment } from "../../environments/environment";

@Injectable({
  providedIn: "root",
})
export class LoginService {
  /* Define variables */
  private httpOptions = {
    headers: new HttpHeaders({
      // "Content-Type": "application/json; charset=utf-8",
    }),
  };

  constructor(private http: HttpClient) {}

  // Función que llama el servicio login
  login(correo,contrasenia ) {

    let form = new FormData();

      form.append('email',correo);
      form.append('password',contrasenia);

    return this.http
      .post(environment.apiBaseUrl+"login",form , this.httpOptions)
      .pipe(map((data) => data));
  }

}

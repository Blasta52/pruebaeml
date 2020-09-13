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
      // "Content-Type": "application/json; charset=utf-8",
    }),
  };

  constructor(private http: HttpClient) {}

  getUsuarios() {

    return this.http
      .get(environment.apiBaseUrl+"usuarios",this.httpOptions)
      .pipe(map((data) => data));
  }
  // getUsuarios() {

  //   return this.http
  //     .get(environment.apiBaseUrl+"usuarios",this.httpOptions)
  //     .pipe(map((data) => data));
  // }

}
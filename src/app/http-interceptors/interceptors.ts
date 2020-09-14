import { Injectable, Inject } from "@angular/core";
import {
  HttpInterceptor,
  HttpRequest,
  HttpHandler,
  HttpEvent,
} from "@angular/common/http";
import { PLATFORM_ID } from "@angular/core";
import { isPlatformBrowser } from "@angular/common";

import { Observable } from "rxjs";
import { catchError } from "rxjs/operators";

import { ConfigService } from "../services/config.service";
import { environment } from "../../environments/environment";

@Injectable()
export class InterceptorsInterceptor implements HttpInterceptor {


  constructor(
    
  ) {
   
  }

  intercept(
    request: HttpRequest<any>,
    next: HttpHandler
  ): Observable<HttpEvent<any>> {

    return next.handle(request).pipe(
      (data) => data,
      catchError((err: any) => {
        if (err.status == 401)
        { 

          alert("Su sesión ha expirado");
          localStorage.clear();
          window.location.href = "/";
        }

        // var response = this.config.handleError(err);
        throw err;
      })
    );
  }
}

/*
Copyright 2017-2018 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/

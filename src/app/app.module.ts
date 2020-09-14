import { ConfigService } from './services/config.service';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule } from "@angular/common/http";
import { CommonModule } from '@angular/common'; 
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { ReactiveFormsModule } from '@angular/forms';
import { UsuariosComponent } from './components/usuarios/usuarios.component';
import { ModalcrearusuarioComponent } from './components/modalcrearusuario/modalcrearusuario.component';
import { ModaleditarusuarioComponent } from './components/modaleditarusuario/modaleditarusuario.component';
import { DeleteusuarioComponent } from './components/deleteusuario/deleteusuario.component';
import { LoadingComponent } from './components/loading/loading.component';
import { httpInterceptorProviders } from './http-interceptors';



@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    UsuariosComponent,
    ModalcrearusuarioComponent,
    ModaleditarusuarioComponent,
    DeleteusuarioComponent,
    LoadingComponent
  ],
  imports: [
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule,
    BrowserModule,
    CommonModule
  ],
  providers: [ConfigService, httpInterceptorProviders],
  bootstrap: [AppComponent]
})
export class AppModule { }

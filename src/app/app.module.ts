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


@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    UsuariosComponent,
    ModalcrearusuarioComponent
  ],
  imports: [
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule,
    BrowserModule,
    CommonModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-modalcrearusuario',
  templateUrl: './modalcrearusuario.component.html',
  styleUrls: ['./modalcrearusuario.component.css']
})
export class ModalcrearusuarioComponent implements OnInit {

  public form:FormGroup;
  public enviado:boolean = false;
  public error:string = "";

  constructor() {

    this.form=new FormGroup({

      nombres: new FormControl("",[Validators.required]),
      apellidos: new FormControl("",[Validators.required]),
      cedula: new FormControl("",[Validators.required]),
      correo: new FormControl("",[Validators.required,Validators.email]),
      telefono: new FormControl("",[Validators.required])


    });
  }

  ngOnInit(): void {

  }

  CrearUsuario() {

    console.log("dxd");
    this.enviado = true;

    if ( this.form.status == "VALID" ){

    }

    (error) => {
      if (error.status == 422)
      {
        this.error = error.error.message;
      }

    }
  }


}

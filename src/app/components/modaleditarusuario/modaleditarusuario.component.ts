import { Component, OnInit, Input, Output , EventEmitter} from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { UsuariosService } from './../../services/usuarios.service';

@Component({
  selector: 'app-modaleditarusuario',
  templateUrl: './modaleditarusuario.component.html',
  styleUrls: ['./modaleditarusuario.component.css']
})
export class ModaleditarusuarioComponent implements OnInit {

  @Output()
  public getUsers = new EventEmitter<any>();

  @Input()
  public data: any = {};
  public enviado:boolean = false;
  public error:string = "";
  public success:boolean=false;
  public form:FormGroup;

  constructor(private service:UsuariosService) { 
  }


  ngOnInit(): void {
    this.form = new FormGroup({
      id: new FormControl(this.data.id,[Validators.required]),
      nombres: new FormControl(this.data.nombres,[Validators.required]),
      apellidos: new FormControl(this.data.apellidos,[Validators.required]),
      cedula: new FormControl(this.data.cedula,[Validators.required,Validators.minLength(5), Validators.maxLength(12), Validators.pattern(/^[0-9\s]*$/)]),
      correo: new FormControl(this.data.correo,[Validators.required,Validators.email]),
      telefono: new FormControl(this.data.telefono,[Validators.required, Validators.pattern(/^[0-9\s]*$/), Validators.maxLength(10)])
    });
  }
  ActualizarUsuario(btnClose){

    this.enviado = true;
    this.error = "";
    this.success=false;

    if ( this.form.status == "VALID" ){

      this.service.ActualizarUsuario (this.form.value.id,this.form.value.nombres,this.form.value.apellidos,this.form.value.cedula,this.form.value.correo,this.form.value.telefono)
      .subscribe((response) => {

        this.success = true;

        this.enviado = false; 

        setTimeout(() => {
          btnClose.click();
          this.getUsers.emit();
        },3000);

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
}

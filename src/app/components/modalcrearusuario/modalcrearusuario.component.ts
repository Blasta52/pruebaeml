import { UsuariosService } from './../../services/usuarios.service';
import { Component, OnInit, Output, EventEmitter} from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';


@Component({
  selector: 'app-modalcrearusuario',
  templateUrl: './modalcrearusuario.component.html',
  styleUrls: ['./modalcrearusuario.component.css']
})
export class ModalcrearusuarioComponent implements OnInit {

  // Event emitter para reconsultar los usuarios en el componente usuarios
  @Output()
  public getUsers = new EventEmitter<any>();

  // Se definen las variables a utilizar
  public form:FormGroup;
  public enviado:boolean = false;
  public error:string = "";
  public success:boolean=false;

  constructor(private service:UsuariosService) {

    // Creamos el formulario
    this.form=new FormGroup({

      nombres: new FormControl("",[Validators.required]),
      apellidos: new FormControl("",[Validators.required]),
      cedula: new FormControl("",[Validators.required,Validators.minLength(5), Validators.maxLength(12), Validators.pattern(/^[0-9\s]*$/)]),
      correo: new FormControl("",[Validators.required,Validators.email]),
      telefono: new FormControl("",[Validators.required, Validators.pattern(/^[0-9\s]*$/), Validators.maxLength(10)])


    });
  }

  ngOnInit(): void {

  }

  // función que valida el formulario y crea el usuario
  CrearUsuario(btnClose) {

    this.enviado = true;
    this.error = "";
    this.success=false;

    if ( this.form.status == "VALID" ){

      this.service.CrearUsuario (this.form.value.nombres,this.form.value.apellidos,this.form.value.cedula,this.form.value.correo,this.form.value.telefono)
      .subscribe((response) => {

        this.success = true;

        this.form.reset();

        this.enviado = false; 

        this.getUsers.emit();

        setTimeout(() => {
          btnClose.click();
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

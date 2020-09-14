import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { UsuariosService } from './../../services/usuarios.service';


@Component({
  selector: 'app-deleteusuario',
  templateUrl: './deleteusuario.component.html',
  styleUrls: ['./deleteusuario.component.css']
})
export class DeleteusuarioComponent implements OnInit {

  @Output()
  public getUsers = new EventEmitter<any>();
  @Input()
  public data: any = {};
  public error:string = "";

  constructor(private service:UsuariosService) { }

  ngOnInit(): void {
  }
  DeleteUser(btnClose){

    this.service.DeleteUsuario (this.data.id)
      .subscribe((response) => {

        btnClose.click();
        this.getUsers.emit();
      
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

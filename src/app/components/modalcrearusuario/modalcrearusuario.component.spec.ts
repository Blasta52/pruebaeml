import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalcrearusuarioComponent } from './modalcrearusuario.component';

describe('ModalcrearusuarioComponent', () => {
  let component: ModalcrearusuarioComponent;
  let fixture: ComponentFixture<ModalcrearusuarioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModalcrearusuarioComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalcrearusuarioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

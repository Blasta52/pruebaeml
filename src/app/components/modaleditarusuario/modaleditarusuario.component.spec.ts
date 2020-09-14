import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModaleditarusuarioComponent } from './modaleditarusuario.component';

describe('ModaleditarusuarioComponent', () => {
  let component: ModaleditarusuarioComponent;
  let fixture: ComponentFixture<ModaleditarusuarioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModaleditarusuarioComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ModaleditarusuarioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

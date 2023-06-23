import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { MovementsComponent } from './movements.component';



@NgModule({
  declarations: [
    MovementsComponent
  ],
  imports: [
    CommonModule,
    FormsModule
  ],
  exports: [
    MovementsComponent
  ]
})
export class MovementsModule { }

import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { SalaryComponent } from './salary.component';



@NgModule({
  declarations: [
    SalaryComponent
  ],
  imports: [
    FormsModule,
    CommonModule
  ],
  exports: [SalaryComponent]
})
export class SalaryModule { }

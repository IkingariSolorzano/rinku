import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { EmployeesComponent } from './employees.component';
import { AddEmployeeComponent } from './add-employee/add-employee.component';
import { MovementsModule } from '../movements/movements.module';
import { SalaryModule } from '../salary/salary.module';
import { HttpClientModule } from '@angular/common/http';



@NgModule({
  declarations: [
    EmployeesComponent,
    AddEmployeeComponent,
  ],
  imports: [
    CommonModule,
    SalaryModule,
    MovementsModule,
    FormsModule,
    HttpClientModule
  ],

  exports: [EmployeesComponent, AddEmployeeComponent]
})
export class EmployeesModule { }

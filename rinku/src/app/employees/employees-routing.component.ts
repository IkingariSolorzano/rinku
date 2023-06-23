import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { EmployeesComponent } from './employees.component';

const ruotes: Routes = [
  {
    path: '',
    component: EmployeesComponent,
    children: [
      {
        path: 'add-employee',
        component: CreateEmployeeComponent,

      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})

export class EmployeesRoutingModule { }

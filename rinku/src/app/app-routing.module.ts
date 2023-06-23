import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
// import { AppComponent } from './app.component';
import { EmployeesComponent } from './employees/employees.component';
import { MovementsComponent } from './movements/movements.component';
import { SalaryComponent } from './salary/salary.component';

const routes: Routes = [
  {
    path: '',
    redirectTo: '/employees',
    pathMatch: 'full',
  },
  {
    path: 'employees',
    component: EmployeesComponent
  },
  {
    path: 'movements',
    component: MovementsComponent
  },
  {
    path: 'salary',
    component: SalaryComponent
  },


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

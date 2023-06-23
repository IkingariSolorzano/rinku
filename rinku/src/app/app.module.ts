import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { SalaryComponent } from './salary/salary.component';
import { AppRoutingModule } from './app-routing.module';
import { MovementsModule } from './movements/movements.module';
import { EmployeesModule } from './employees/employees.module';
import { SalaryModule } from './salary/salary.module';

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    MovementsModule,
    EmployeesModule,
    SalaryModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

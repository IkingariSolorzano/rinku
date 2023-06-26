import { Component, OnInit } from '@angular/core';
import { Employee } from '../models/employee.model';
import { EmployeeService } from './employee.service';

@Component({
  selector: 'app-employees',
  templateUrl: './employees.component.html',
  styleUrls: ['./employees.component.scss']
})
export class EmployeesComponent implements OnInit {
  location: string = 'home';
  employees: Employee[] = [];
  movements: any[] = []

  constructor(private employeeService: EmployeeService) { }

  ngOnInit() {
    this.getEmployees();
    this.getMovements();

  }

  getEmployees() {
    this.employeeService.getEmployees().subscribe(
      response => {
        this.employees = response;
      },
      error => {
        console.log('Error al obtener la lista de empleados:', error);
      }
    );
  }

  getMovements() {
    this.employeeService.getEmployeeMovements().subscribe(
      response => this.movements = response
    )
  }
}

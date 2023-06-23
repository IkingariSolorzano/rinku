
import { Component, OnInit } from '@angular/core';
import { Employee } from '../models/employee.model';
import { EmployeeService } from '../employees/employee.service';
import { MovementService } from './movement.service';

@Component({
  selector: 'app-movements',
  templateUrl: './movements.component.html',
  styleUrls: ['./movements.component.scss']
})
export class MovementsComponent implements OnInit {
  employees: Employee[] = [];
  selectedEmployee: string = '';
  selectedEmployeeNumber: string = '';
  selectedEmployeeRole: string = '';
  selectedMonth: number = 0;

  entregas: number = 0;

  constructor(private employeeService: EmployeeService, private movementService: MovementService) { }

  ngOnInit(): void {
    this.loadEmployees();
  }

  loadEmployees(): void {
    this.employeeService.getEmployees().subscribe((employees: Employee[]) => {
      this.employees = employees;
    });
  }

  onEmployeeChange(): void {
    const selectedEmployee = this.employees.find(employee => employee.id == this.selectedEmployee);
    if (selectedEmployee) {
      this.selectedEmployeeNumber = selectedEmployee.no_empleado;
      this.selectedEmployeeRole = selectedEmployee.role;
    } else {
      this.selectedEmployeeNumber = '';
      this.selectedEmployeeRole = '';
    }
  }

  onSubmit(): void {
    const movementData = {
      employee_id: this.selectedEmployee,
      mes: this.selectedMonth,
      cantidad_entregas: this.entregas
    };

    this.movementService.getMovementsByEmployee(parseInt(movementData.employee_id)).subscribe(
      response => {
        console.log(response);
      }
    );

    this.movementService.createMovement(movementData).subscribe(response => {
      if (response) {
        alert('El movimiento se ha registrado correctamente.');
        window.location.reload();
      }
    }, error => {
      console.log(error);
    });
  }
}

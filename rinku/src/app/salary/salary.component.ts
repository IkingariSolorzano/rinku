import { Component, OnInit } from '@angular/core';
import { EmployeeService } from '../employees/employee.service';

@Component({
  selector: 'app-salary',
  templateUrl: './salary.component.html',
  styleUrls: ['./salary.component.scss']
})
export class SalaryComponent implements OnInit {
  employees: any[] = [];
  selectedEmployeeId: number = 0;
  selectedEmployee: any = null;
  employeeMovements: any[] = [];
  additionalSalary: number = 0;
  selectedEmployeeRole: 'Chofer' | 'Auxiliar' | 'Cargador' | undefined = undefined;
  totalSalary: number = 0;
  salaryDetails: string[] = [];

  constructor(private employeeService: EmployeeService) { }

  ngOnInit(): void {
    this.loadEmployees();
  }

  loadEmployees(): void {
    this.employeeService.getEmployees().subscribe(
      (response: any) => {
        this.employees = response;
      },
      (error: any) => {
        console.error('Error occurred while retrieving employees:', error);
      }
    );
  }

  onEmployeeChange(): void {
    const selectedEmployee = this.employees.find(employee => employee.id == this.selectedEmployee);
    if (selectedEmployee) {
      this.selectedEmployeeId = selectedEmployee.no_empleado;
      this.selectedEmployeeRole = selectedEmployee.role;
      this.loadEmployeeMovements();
      this.calculateAdditionalSalary();
    } else {
      this.selectedEmployeeId = 0;
      this.selectedEmployeeRole = undefined;
      this.employeeMovements = [];
      this.additionalSalary = 0;
    }
  }

  loadEmployeeMovements(): void {
    if (this.selectedEmployeeId !== 0) {
      this.employeeService.getEmployeeMovements(this.selectedEmployeeId).subscribe(
        (response: any) => {
          this.employeeMovements = response;
        },
        (error: any) => {
          console.error('Error occurred while retrieving employee movements:', error);
        }
      );
    } else {
      this.employeeMovements = [];
    }
  }

  calculateAdditionalSalary(): void {
    if (this.selectedEmployeeId !== 0) {
      this.employeeService.calculateAdditionalSalary(this.selectedEmployeeId).subscribe(
        (response: any) => {
          this.additionalSalary = response.additional_salary;
        },
        (error: any) => {
          console.error('Error occurred while calculating additional salary:', error);
        }
      );
    } else {
      this.additionalSalary = 0;
    }
  }
}

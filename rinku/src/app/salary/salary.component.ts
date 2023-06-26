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

  onEmployeeChange() {

  }

}

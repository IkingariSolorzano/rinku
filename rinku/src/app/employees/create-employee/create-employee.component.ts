import { Component } from '@angular/core';
import { EmployeeService } from 'src/app/employee.service';
import { Employee } from 'src/app/models/employee.model';

@Component({
  selector: 'app-create-employee',
  templateUrl: './create-employee.component.html',
  styleUrls: ['./create-employee.component.scss']
})
export class CreateEmployeeComponent {
  employee: any;

  constructor(private employeeService: EmployeeService) { }

  saveEmployee() {
   /*  this.employeeService.saveEmployee(this.employee).subscribe(
      (response) => {
        // Manejar la respuesta del servicio si es necesario
        console.log('Empleado guardado:', response);
      },
      (error) => {
        // Manejar el error del servicio si es necesario
        console.error('Error al guardar el empleado:', error);
      }
    ); */
  }
}

import { Component } from '@angular/core';
import { EmployeeService } from '../employee.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-add-employee',
  templateUrl: './add-employee.component.html',
  styleUrls: ['./add-employee.component.scss']
})
export class AddEmployeeComponent {
  employee = {
    nombre: '',
    no_empleado: '',
    role: ''
  };

  constructor(
    private employeeService: EmployeeService,
    private router: Router
  ) {

  }

  onSubmit() {
    this.employeeService.createEmployee(this.employee).subscribe(response => {
      if (response) {
        alert('¡El empleado se ha dado de alta exitosament!');
        window.location.reload();
        // Redirige a la página principal
      }
    }, error => {
      if (error.error.message.includes('Duplicate')) {
        alert('Ese numero de empleado ya ha sido registrado.');
      } else {
        console.log(); // Muestra los errores en la consola

      }
    });
  }

}

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
        alert('¡El empleado se ha dado de alta exitosamente!');
        window.location.reload();
        // Redirige a la página principal
      }
    }, error => {
      if (error.error.message.includes('Duplicate')) {
        alert('Ese numero de empleado ya ha sido registrado.');
      } else {
        console.log(error.error.message);
        let firstSlice = error.error.message
        console.log(firstSlice);
        let indice = firstSlice.includes('(')
        let indexF = indice < 0 ? indice = 0 : indice = firstSlice.indexOf('(');
        console.log('IndexF ', indexF);
        let end = firstSlice.length - indice
        console.log(end);
        let secondSlice = firstSlice.slice(0, -end)
        alert(secondSlice)

      }
    });
  }

}

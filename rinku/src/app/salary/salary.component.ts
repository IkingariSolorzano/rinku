import { Component, OnInit } from '@angular/core';
import { EmployeeService } from '../employees/employee.service';
import { SalaryService } from './salary.service';

@Component({
  selector: 'app-salary',
  templateUrl: './salary.component.html',
  styleUrls: ['./salary.component.scss']
})
export class SalaryComponent implements OnInit {
  employees: any[] = [];
  selectedEmployee: string = '';
  employeeMovements: any[] = [];
  movements: any[] = [];
  currentDate: Date = new Date();
  recibo = {
    mes: '',
    nombre: '',
    no_empleado: '',
    puesto: '',
    horas: '',
    base: '',
    bono: '',
    entregas: '',
    pagoEntregas: '',
    salarioBruto: '',
    salarioNeto: '',
    efectivo: '',
    vales: ''
  }
  salary: any;
  meses: string[] = [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre',
  ]

  constructor(private employeeService: EmployeeService, private salaryService: SalaryService) { }

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
    this.salaryService.getMovements(this.selectedEmployee).subscribe(movements => {
      this.movements = movements
    })
    this.recibo = {
      mes: '',
      nombre: '',
      no_empleado: '',
      puesto: '',
      horas: '',
      base: '',
      bono: '',
      entregas: '',
      pagoEntregas: '',
      salarioBruto: '',
      salarioNeto: '',
      efectivo: '',
      vales: ''
    }
  }

  calcular(info: any) {
    this.salaryService.calcularSalario(this.selectedEmployee, info.mes).subscribe(salary => {
      this.salary = salary;
      this.recibo.mes = this.meses[info.mes - 1];
      this.recibo.nombre = info.nombre;
      this.recibo.no_empleado = info.no_empleado;
      this.recibo.puesto = info.role;
      this.recibo.entregas = info.cantidad_entregas;
      this.recibo.base = this.salary.salario_base;
      this.recibo.bono = this.salary.bono;
      this.recibo.horas = this.salary.horas_base;
      this.recibo.pagoEntregas = this.salary.pago_entregas;
      this.recibo.salarioBruto = this.salary.salario_bruto;
      this.recibo.salarioNeto = this.salary.salario_neto;
      this.recibo.efectivo = this.salary.pago_efectivo;
      this.recibo.vales = this.salary.pago_vales;
    })
  }

}

import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { EmployeeService } from '../employees/employee.service';
import { Observable } from 'rxjs';
import { Employee } from '../models/employee.model';

@Injectable({
  providedIn: 'root'
})
export class SalaryService {

  private apiSalary = 'http://localhost/rinku/rinku_api/public/api'

  constructor(private http: HttpClient) { }

  getMovements(id: string): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiSalary}/employees/movements?employee_id=${id}`);
  }

  calcularSalario(id: string, mes: string) {
    return this.http.get<any[]>(`${this.apiSalary}/salary/calculate?employee_id=${id}&mes=${mes}`);
  }

}

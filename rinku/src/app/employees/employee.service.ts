import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EmployeeService {
  private apiUrl = 'http://localhost/rinku/rinku_api/public/api/employees'; // Reemplaza con la URL correcta de tu API

  constructor(private http: HttpClient) { }

  getEmployee(id: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/${id}`);
  }

  createEmployee(employeeData: any): Observable<any> {
    return this.http.post(`${this.apiUrl}`, employeeData);
  }

  updateEmployee(id: number, employeeData: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/update/${id}`, employeeData);
  }

  deleteEmployee(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/delete/${id}`);
  }
}

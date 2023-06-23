import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class MovementService {
  private apiUrl = 'http://localhost/rinku/rinku_api/public/api'; // Reemplaza con la URL correcta de tu API

  constructor(private http: HttpClient) { }

  getMovementsByEmployee(employeeId: any): Observable<any> {
    return this.http.get(`${this.apiUrl}/employee/movements`, employeeId);
  }

  createMovement(movementData: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/movements`, movementData);
  }

  updateMovement(id: number, movementData: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/update/${id}`, movementData);
  }

  deleteMovement(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/delete/${id}`);
  }
}

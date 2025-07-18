import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '@environments/environment';
import { Task } from '@shared/models/task.model';

@Injectable({
  providedIn: 'root'
})
export class TaskService {
  constructor(private http: HttpClient) {}

  getTasks(): Observable<Task[]> {
    return this.http.get<Task[]>(`${environment.apiUrl}${environment.endpoints.tasks.getAll}`);
  }

  getTask(id: number): Observable<Task> {
    return this.http.get<Task>(`${environment.apiUrl}${environment.endpoints.tasks.getOne(id)}`);
  }

  createTask(task: Omit<Task, 'id'>): Observable<Task> {
    return this.http.post<Task>(`${environment.apiUrl}${environment.endpoints.tasks.create}`, task);
  }

  updateTask(id: number, task: Partial<Task>): Observable<Task> {
    return this.http.put<Task>(`${environment.apiUrl}${environment.endpoints.tasks.update(id)}`, task);
  }

  deleteTask(id: number): Observable<void> {
    return this.http.delete<void>(`${environment.apiUrl}${environment.endpoints.tasks.delete(id)}`);
  }
}
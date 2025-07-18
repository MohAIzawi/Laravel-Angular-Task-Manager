import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { MatSnackBar } from '@angular/material/snack-bar';
import { TaskService } from '@core/services/task.service';
import { Task } from '@shared/models/task.model';

@Component({
  selector: 'app-task-list',
  templateUrl: './task-list.component.html',
  styleUrls: ['./task-list.component.scss']
})
export class TaskListComponent implements OnInit {
  tasks: Task[] = [];
  isLoading = false;
  displayedColumns: string[] = ['title', 'description', 'actions'];

  constructor(
    private taskService: TaskService,
    private router: Router,
    private snackBar: MatSnackBar
  ) {}

  ngOnInit(): void {
    this.loadTasks();
  }

  loadTasks(): void {
    this.isLoading = true;
    this.taskService.getTasks().subscribe({
      next: (tasks: Task[]) => {
        this.tasks = tasks;
        this.isLoading = false;
      },
      error: (error: any) => {
        this.snackBar.open('Error loading tasks', 'Close', {
          duration: 3000
        });
        this.isLoading = false;
      }
    });
  }

  deleteTask(id: number): void {
    if (confirm('Are you sure you want to delete this task?')) {
      this.taskService.deleteTask(id).subscribe({
        next: () => {
          this.tasks = this.tasks.filter(task => task.id !== id);
          this.snackBar.open('Task deleted successfully', 'Close', {
            duration: 3000
          });
        },
        error: (error: any) => {
          this.snackBar.open('Error deleting task', 'Close', {
            duration: 3000
          });
        }
      });
    }
  }

  editTask(id: number): void {
    this.router.navigate(['/tasks/edit', id]);
  }

  createTask(): void {
    this.router.navigate(['/tasks/create']);
  }
}
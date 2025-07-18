import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { map, tap, catchError } from 'rxjs/operators';
import { environment } from '@environments/environment';
import { User } from '@shared/models/user.model';

interface LoginCredentials {
  email: string;
  password: string;
}

interface RegisterData {
  firstName: string;
  lastName: string;
  email: string;
  password: string;
  password_confirmation: string;
}

interface AuthResponse {
  user: User;
  token: {
    token: string;
    type: string;
    abilities: string[];
  };
}

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private currentUserSubject = new BehaviorSubject<User | null>(null);
  private isAuthenticatedSubject = new BehaviorSubject<boolean>(this.hasValidToken());
  
  currentUser$ = this.currentUserSubject.asObservable();
  isAuthenticated$ = this.isAuthenticatedSubject.asObservable();

  constructor(private http: HttpClient) {
    this.checkAndUpdateAuthStatus();
  }

  login(credentials: LoginCredentials): Observable<User> {
    return this.http.post<AuthResponse>(`${environment.apiUrl}${environment.endpoints.auth.login}`, credentials)
      .pipe(
        tap(response => {
          localStorage.setItem(environment.tokenKey, response.token.token);
          this.currentUserSubject.next(response.user);
          this.isAuthenticatedSubject.next(true);
        }),
        map(response => response.user)
      );
  }

  register(userData: RegisterData): Observable<User> {
    return this.http.post<AuthResponse>(`${environment.apiUrl}${environment.endpoints.auth.register}`, userData)
      .pipe(
        tap(response => {
          localStorage.setItem(environment.tokenKey, response.token.token);
          this.currentUserSubject.next(response.user);
          this.isAuthenticatedSubject.next(true);
        }),
        map(response => response.user)
      );
  }

  logout(): Observable<void> {
    return this.http.post<void>(`${environment.apiUrl}${environment.endpoints.auth.logout}`, {})
      .pipe(
        tap(() => {
          localStorage.removeItem(environment.tokenKey);
          this.currentUserSubject.next(null);
          this.isAuthenticatedSubject.next(false);
        })
      );
  }

  loadCurrentUser(): Observable<User> {
    return this.http.get<User>(`${environment.apiUrl}${environment.endpoints.auth.currentUser}`)
      .pipe(
        tap(user => this.currentUserSubject.next(user)),
        catchError((error: any) => {
          // If loading current user fails, clear the token and set as unauthenticated
          if (error.status === 401) {
            localStorage.removeItem(environment.tokenKey);
            this.currentUserSubject.next(null);
            this.isAuthenticatedSubject.next(false);
          }
          throw error;
        })
      );
  }

  private checkAndUpdateAuthStatus(): void {
    if (this.hasValidToken()) {
      this.isAuthenticatedSubject.next(true);
      // Only load current user if explicitly requested, not on service initialization
      // this.loadCurrentUser().subscribe();
    }
  }

  private hasValidToken(): boolean {
    const token = localStorage.getItem(environment.tokenKey);
    return !!token;
  }

  getToken(): string | null {
    return localStorage.getItem(environment.tokenKey);
  }
}
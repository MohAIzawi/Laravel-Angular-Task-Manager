export const environment = {
    production: false,
    apiUrl: 'http://localhost:8000/api',
    tokenKey: 'auth_token',
    endpoints: {
      auth: {
        login: '/auth/login',
        register: '/auth/register',
        logout: '/auth/logout',
        currentUser: '/auth/current-user'
      },
      tasks: {
        base: '/tasks',
        getAll: '/tasks',
        getOne: (id: number) => `/tasks/${id}`,
        create: '/tasks',
        update: (id: number) => `/tasks/${id}`,
        delete: (id: number) => `/tasks/${id}`
      }
    }
  };
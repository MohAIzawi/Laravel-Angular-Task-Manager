export const environment = {
    production: true,
    apiUrl: 'https://your-production-api-url.com/api',
    tokenKey: 'auth_token',
    endpoints: {
      auth: {
        login: '/auth/login',
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
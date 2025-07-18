export interface User {
    id: number;
    firstName: string;
    lastName: string;
    email: string;
    createdAt?: string;
    updatedAt?: string;
}

// Optional helper functions
export const getFullName = (user: User): string => {
    return `${user.firstName} ${user.lastName}`.trim();
};

export const createEmptyUser = (): User => {
    return {
        id: 0,
        firstName: '',
        lastName: '',
        email: ''
    };
};
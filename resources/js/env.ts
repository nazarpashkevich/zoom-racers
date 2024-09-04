export function env(variable: string, defaultValue: string = ''): string {
    return import.meta.env[variable] || defaultValue;
}

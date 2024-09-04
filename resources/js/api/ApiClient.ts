import axios, { AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios';
import { env } from "@/env";

export default class ApiClient {
    private axiosClient: AxiosInstance;

    constructor(baseURL: string, defaultParams?: Record<string, string>) {
        this.axiosClient = axios.create({
            baseURL,
            params: defaultParams,
        });
    }

    public static make(params: Record<string, string> = []): ApiClient {
        return new ApiClient(env('API_URL'), params);
    }

    public async get(url: string, config?: AxiosRequestConfig): Promise<AxiosResponse> {
        return this.axiosClient.get<T>(url, config);
    }

    public async post(url: string, data?: any, config?: AxiosRequestConfig): Promise<AxiosResponse> {
        return this.axiosClient.post(url, data, config);
    }

    public async put(url: string, data?: any, config?: AxiosRequestConfig): Promise<AxiosResponse> {
        return this.axiosClient.put(url, data, config);
    }

    public async delete(url: string, config?: AxiosRequestConfig): Promise<AxiosResponse> {
        return this.axiosClient.delete(url, config);
    }
}

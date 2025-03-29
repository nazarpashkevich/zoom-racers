import axios, { AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios';
import { env } from '@/env';

class ApiClient {
  private axiosClient: AxiosInstance;

  constructor(baseURL: string) {
    this.axiosClient = axios.create({
      baseURL,
    });
  }

  public async get(
    url: string,
    config?: AxiosRequestConfig
  ): Promise<AxiosResponse> {
    return this.axiosClient.get<T>(url, config);
  }

  public async post(
    url: string,
    data?: any,
    config?: AxiosRequestConfig
  ): Promise<AxiosResponse> {
    return this.axiosClient.post(url, data, config);
  }

  public async put(
    url: string,
    data?: any,
    config?: AxiosRequestConfig
  ): Promise<AxiosResponse> {
    return this.axiosClient.put(url, data, config);
  }

  public async delete(
    url: string,
    config?: AxiosRequestConfig
  ): Promise<AxiosResponse> {
    return this.axiosClient.delete(url, config);
  }
}

export default new ApiClient(env('API_URL'));

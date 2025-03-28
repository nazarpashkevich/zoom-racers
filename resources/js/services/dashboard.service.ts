import ApiClient from "@/api/api.client";
import { StatisticData } from "@/types/dashboard";

class DashboardService {
    constructor(protected client: ApiClient) {
    }

    public async newUsers(): Promise<StatisticData> {
        return await this.client.get(route(`dashboard.new-users`))
            .then(res => res.data);
    }

    public async totalUsers(): Promise<StatisticData> {
        return await this.client.get(route(`dashboard.total-users`))
            .then(res => res.data);
    }

    public async revenue(): Promise<StatisticData> {
        return await this.client.get(route(`dashboard.revenue`))
            .then(res => res.data);
    }

    public async orders(): Promise<StatisticData> {
        return await this.client.get(route(`dashboard.orders`))
            .then(res => res.data);
    }
}

export default new DashboardService(ApiClient);

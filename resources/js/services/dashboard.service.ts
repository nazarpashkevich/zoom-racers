import ApiClient from "@/api/api.client";
import { NewUsersStatistic } from "@/types/dashboard";

class DashboardService {
    constructor(protected client: ApiClient) {
    }

    public async newUsers(): Promise<NewUsersStatistic> {
        return await this.client.get(route(`dashboard.new-users`))
            .then(res => res.data)
            .then(d => d.data);
    }
}

export default new DashboardService(ApiClient);

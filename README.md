# 🎉 Virtual Event Platform with Video Chat

A comprehensive platform for organizing and hosting virtual events, such as conferences, workshops, exhibitions, and
meetings. This platform allows users to rent virtual spaces, sell tickets, interact in real-time via video chat, and
access premium features for additional revenue.

## 🛠️ Technologies Used

### Backend

- **[Laravel](https://laravel.com/):** Web framework for managing users, events, ticket sales, and payments.
- **[WebSockets](https://laravel.com/docs/10.x/broadcasting#broadcasters):** Real-time communication for video chat and
  interactions between participants.
- **[Redis](https://redis.io/):** Caching, queues, and real-time data management.
- **[MySQL/PostgreSQL](https://www.mysql.com/):** Relational database for storing user, event, ticket, and transaction
  data.
- **[Elasticsearch](https://www.elastic.co/elasticsearch/):** Search and filtering of events, organizers, and services.
- **[GraphQL](https://graphql.org/)** (Optional): Flexible API querying for the frontend.

### Frontend

- **[Vue.js](https://vuejs.org/) + [Inertia.js](https://inertiajs.com/):** Building a dynamic single-page application (
  SPA) with reactive UI.
- **[TypeScript](https://www.typescriptlang.org/):** Static typing for JavaScript, ensuring code reliability and
  maintainability.
- **[Tailwind CSS](https://tailwindcss.com/):** Utility-first CSS framework for responsive and customizable UI design.
- **[WebRTC](https://webrtc.org/):** Real-time video chat and streaming for event participants.
- **[PWA](https://web.dev/progressive-web-apps/):** Progressive Web App support for offline access and mobile usability.

## 📐 Architecture

### Event Creation and Management

- **Event Types:** Organizers can create various types of events (webinars, conferences, meetings), set up programs, and
  manage participants.
- **Ticket Sales:** Create free or paid events, including ticket sales and access management through payment
  integration.

### Virtual Spaces

- **Virtual Rooms:** Rent virtual rooms, halls, and exhibition booths that can be customized based on event type.
- **Personalization:** Customize virtual spaces with visual and interactive elements.

### Video Chat and Streaming

- **Multi-user Video Chat:** Support for multi-user video chat for event participants with options to switch between
  different "rooms".
- **Event Streaming:** Live streaming and recording of events for participants who couldn't attend in real-time.

### Ticketing and Monetization

- **Ticket Sales:** Main revenue stream through ticket sales for events with different access levels (general, VIP,
  etc.).
- **Payment Integration:** Support for payment systems like Stripe and PayPal for transaction processing.
- **Premium Features:** Premium features such as enhanced streaming, more participants, or access to exclusive content.

### Networking and Interaction

- **Networking Zones:** Participants can interact with each other through direct messaging, video chat, or dedicated
  networking zones.
- **Interactive Features:** Polls, chats, and Q&A sessions to engage participants.

### Organizer Marketplace

- **Marketplace:** Platform for purchasing additional services and products for events, such as marketing materials,
  advertising, decorations, etc.
- **Service Packages:** Organizers can offer their services and packages through the built-in marketplace.

## 🚀 Getting Started

### Prerequisites

- Docker installed on your local machine.
- Node.js and npm for frontend development.
- Composer for managing PHP dependencies.

### Installation

#### Dev mode

1. **Clone the repository:**

 ```bash
 git clone https://github.com/yourusername/virtual-racing-platform.git
 cd virtual-racing-platform
  ```

2. **Install backend dependencies:**

  ```bash
  composer install
  ```

3. **Install frontend dependencies:**

  ```bash
  npm install
  ```

4. **Set up environment variables:**

  ```bash
  cp .env.example .env
  php artisan key:generate
  ```

5. **Run Docker containers:**

  ```bash
  sail up
  ```

6. **Migrate the database:**

  ```bash
  sail artisan migrate
  ```

#### Prod mode

1. **Clone ``docker-compose-prod.yml`` as docker-compose.yml**

2. **Setup .env variables**

3. **Up application**

    ```bash
    docker-compose up
   ```
4. **For update use next command:**
    ```bash
     docker-compose pull 
    ```

## Usage

Access the platform at http://localhost.
Register or log in to start customizing your car and racing with friends!

## 🎯 Roadmap

Implement friend system and messaging.
Add more customization options for cars.
Expand race track options with different environments.
Develop mobile app version using PWA.
Introduce leaderboards and global tournaments.

## 🤝 Contributing

We welcome contributions from the community! Please read our Contributing Guide for details on our code of conduct, and
the process for submitting pull requests.

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 📧 Contact

For any inquiries or suggestions, please contact us.

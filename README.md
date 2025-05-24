# Advanced Real-Time Sales Analytics System

A Laravel 10 project built to manage and analyze sales data in **real-time**, with AI-assisted recommendations and external API integration. This system emphasizes **manual development**, using **raw SQL**, **native WebSockets**, and **lightweight SQLite**, and limits reliance on prebuilt packages.

---

## Features

- Add new orders via API
- View real-time analytics:
  - Total revenue
  - Top-selling products
  - Revenue/orders in the last minute
- AI-generated product recommendations OpenAI
- Weather-based promotions and dynamic pricing (OpenWeather API)
- Real-time WebSocket updates for new orders & analytics
- Raw SQLite queries – no ORM or Eloquent used

---

## AI-Assisted Parts (30%)

> The following parts were **assisted by ChatGPT**, but integrated manually:

1. **AI Prompt Design & Endpoint Logic** – `/recommendations`  
   ChatGPT helped design the structure of prompts sent to the AI model using real sales data.
   
2. **OpenWeather Integration Strategy** – `/weather-pricing` logic  
   The AI was consulted on how to combine weather conditions with product categories.

> All code from AI was reviewed and rewritten/refactored manually where needed.

---

## Manual Implementation Details (70%)

- **All database operations** use raw SQL via Laravel’s DB facade and SQLite.
- **Real-time functionality** implemented using WebSockets without Laravel Echo.
- **Frontend uses vanilla JS** and WebSocket for live updates.
- **Analytics calculations** done manually from SQL queries.

---

## How to Run the Project

### 1. Clone the repository

```bash
git clone https://github.com/your-username/salesAnalyticsSystem.git
cd salesAnalyticsSystem
```
```
composer install
```
```
cp .env.example .env
```
Update .env
```
DB_CONNECTION=sqlite
DB_DATABASE=./database/database.sqlite
OPENAI_API_KEY=your_openai_key
OPENWEATHER_API_KEY=your_openweather_key
```

```
touch database/database.sqlite
php artisan migrate
```

```
php artisan serve
```
```
php artisan websocket:serve
```


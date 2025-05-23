class SalesWebSocket {
    constructor() {
        this.socket = new WebSocket(`ws://${window.location.hostname}:8080`);
        this.setupEventListeners();
    }

    setupEventListeners() {
        this.socket.onopen = () => {
            console.log('Connected to WebSocket server');
        };

        this.socket.onmessage = (event) => {
            const data = JSON.parse(event.data);
            this.handleMessage(data);
        };

        this.socket.onclose = () => {
            console.log('Disconnected from WebSocket server');
        };
    }

    handleMessage(data) {
        switch(data.event) {
            case 'order_created':
                this.updateOrderDisplay(data.data);
                break;
            case 'analytics_updated':
                this.updateAnalytics(data.data);
                break;
        }
    }

    updateOrderDisplay(order) {
        // Update UI with new order
        console.log('New order:', order);
        // Implement your specific UI update logic here
    }

    updateAnalytics(analytics) {
        // Update analytics dashboard
        console.log('Updated analytics:', analytics);
        // Implement your specific analytics display logic here
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new SalesWebSocket();
});

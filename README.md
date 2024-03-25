# Microservices Message Bus
An application with 2 microservices that communicate via message bus
1. Service "users" has an endpoint POST /users and on request with body {"email","firstName","lastName"}, stores the submitted data in a database.
2. When the submitted data is saved, an event is generated and it is sent through a message broker to the "notifications" service. In "notifications" service the event is consumed and the sent data is saved in a log file.

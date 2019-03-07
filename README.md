# StreamerEventViewer (SEV)
## Assumptions
I haven't made much assumptions while creating the application as the specifications were pretty much clear.
On the front-end I have used `Bootstrap` with a color scheme similar to Twitch. I have also used `Vue.js` to give the application a SPA touch and `Laravel Echo` for listening to broadcasted events over the channels.
On the back-end I have used `Laravel Socialite` to handle the Twitch Oauth 2 authentication flow. For broadcasting the events to the clients, I have used `Pusher` rather than creating my own websocket to handle event broadcasting.
## Demo
The live demo of this application can be found on http://ec2-52-10-243-103.us-west-2.compute.amazonaws.com/streamereventviewer/public/
## Deployment on AWS
For 100 reqs/day (assuming that the requests include both user requests & Twitch WebHub requests) we just need an EC2 instance where we can deploy the application along side with the database as there would be very less data to store.
Now for the scaling this application to handle 900MM reqs/day we would have first migrate the database to RDS and add a load balancer behind which multiple EC2 intances will be running. We would need to do a load test on a single EC2 instance type to determine how many instances we would need.
We would also need another EBS behind which multiple EC2 instances will be running to handle Twitch WebHub callback requests. Again, we would need to do a load test on a single EC2 instance type to determine how many instances we would need.
As I'm using Pusher to broadcast events to the clients, we might also need to upgrade the account to handle all message deliveries.
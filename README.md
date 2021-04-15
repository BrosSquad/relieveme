# FON Hackathon 2021 - Winning Application

### About

We built this app over the weekend during the 8th annual FON Hackathon in Belgrade, Serbia, lasting from 9th to 11th of April, 2021. We ended up winning the first prize after hours of sleeplessness and hours and hours of coding and tonnes of coffee and energy drinks.

Written in React Native +  Laravel, the app's main purpose is to help people during dangerous and unpredictable natural disasters such as floods, earthquakes, fires, etc... You're welcome to take a look at the code and copy it and change it to your liking and even distribute your modified versions as long as you comply with the license agreement outlined in the LICENSE file.

### Technologies

#### Backend

Backend application is fully dockerirized for development purposes.

1. **Laravel**
2. Pusher API (WebSockets)
3. Postgres with **PostGIS** extension
4. **Redis** for Queues
5. Laravel Queues
6. Laravel Task Scheduler
7. **Docker**

#### Frontend

1. React Native
2. Expo

### Getting Started

1. Setup docker environment
```sh
$ doker-compose up -d
```
2. Add to hosts file
```sh
$ sudo echo '\n127.0.0.1  relieveme.test\n' >> /etc/hosts 
```
3. Run Database migrations
```sh
$ cd relieveme-back && ./exec php artisan migrate --seed && cd ..
```
4. Copy ```.env.example``` to ```.env```
```sh
$ cp relieveme-back/.env.example relieveme-back/.env
```
5. Create Application Key
```sh
$ cd relieveme-back/ && ./exec php artisan key:generate && cd ..
```

6. Add Pusher API Credentials to ```.env```

### Licensing

The source code is licensed under the terms of the GNU Affero General Public License, either version 3 of the license or, at your option, any later version.

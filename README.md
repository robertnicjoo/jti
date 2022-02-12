# Installation

1. Clone this repository to your local/server
2. Do your local enviroment setup (depend on your local OS)
3. Run following command in local repository path `composer install`
4. Run following command in local repository path `npm install && npm run dev`
5. Set your database info in `.env` file.
6. Run following command in local repository path `php artisan migrate --seed`
7. login with following credentials 

```
Email: admin@admin.com
Password: password
```


### Important

We're using `Pusher` for real time notifications,

1. Make sure your `BROADCAST_DRIVER` in `.env` file is set to `pusher`
2. Set your pusher data in `.env` file

```
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1
```

### Note:

- [x] All functionalities are `Ajax` base so beside several acts such as login or switching between pages the rest are happening real time with no refreshing.
- [x] Editing data are inline just click on each number or provider and change your data (changes are instantly)
- [x] This app is **for education and testing purpose only**, there are some works that could be done in different ways such as:

    - Using livewire instead of jQuery/JavaScript  (not recommended for big scale projects)
    - Using VueJs instead of blades (for this project as it is for study purpose only it wasn't justified to go through whole VueJs implementation)
    - Using Socket.io instead of Pusher (cost effective talking!)


## Contact Info

- [Email Me](mailto:robert@irando.co.id)
- [Website](https://irando.co.id)
- [WhatsApp](https://api.whatsapp.com/send?phone=628111026606&text=Hello%20I\'m%20contacting%20from%20your%20GitHub%20account)
- [Telegram](https://t.me/cvirandoOfficial)

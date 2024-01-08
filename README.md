# CatFinder

## 📑 Table of Contents

-   [General Info](#general-information)
-   [Technologies Used](#technologies-used)
-   [Setup](#setup)
-   [Application Users](#application-users)

## 📄 General Information

A simple CRUD app for adopting cats 🐱. The application is divided into 3 layers:

-   **Guest** 👥: A guest can send a contact message, and also has the ability to login and register.
-   **User** 🙋‍♂️: A user can adopt cats, as well as add, delete, and update cat profiles.
-   **Admin** 👮‍♀️: An admin has the ability to add, delete, and update cat profiles. Additionally, an admin can approve adoptions.

## 💻 Technologies Used

-   Laravel - version 10.0
-   Pest - version 2.0
-   Tailwind CSS - version 3.0
-   Pint - version 1.0
-   Larastan - version 2.0

## ⚙️ Setup

```bash
~ cd catfinder/
~ mv .env.example .env
~ docker-compose up --build -d
~ composer install && npm install
~ docker-compose exec app php artisan migrate:fresh --seed
~ docker-compose exec app php artisan storage:link
~ npm run dev
```

The app should be accessible at [localhost](http://localhost/)

## 🚀 Application Users

The application starts with two users:

1. **Admin User** 👩‍💼

    - Email: `admin@admin.com`
    - Password: `admin`

2. **Regular User** 👤
    - Email: `user@user.com`
    - Password: `user`
